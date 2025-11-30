<?php
// login.php
// Handles employee login: shows the form and checks credentials on POST.

session_start(); // Start the session to store login state
require_once 'db_config.php'; // Include DB connection

// Variable for error messages to show under the form, if any.
$loginError = "";

// If the form was submitted via POST, process the credentials.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the userid and password from the POST body, trimming whitespace.
    $userid   = trim($_POST['userid'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Only query the DB if both fields were provided (JS should also check this).
    if ($userid !== '' && $password !== '') {

        // Use a prepared statement to avoid SQL injection.
        $sql = "SELECT employee_id, first_name, last_name 
                FROM employees 
                WHERE userid = ? AND password = ?
                LIMIT 1";

        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameters to the placeholders.
            $stmt->bind_param("ss", $userid, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            // If we got exactly one row, the credentials are valid.
            if ($row = $result->fetch_assoc()) {
                // Set session flags so other pages know the user is logged in.
                $_SESSION['logged_in']   = true;
                $_SESSION['employee_id'] = $row['employee_id'];
                $_SESSION['employee_name'] = $row['first_name'] . ' ' . $row['last_name'];
                $_SESSION['userid']      = $userid;

                // Redirect to the intranet page.
                header("Location: intranet.php");
                exit;
            } else {
                // Invalid userid/password combination.
                $loginError = "Invalid userid or password. Please try again.";
            }

            $stmt->close();
        } else {
            $loginError = "Database error. Please contact the administrator.";
        }
    } else {
        // This is a fallback; normally JS will stop empty submissions.
        $loginError = "Please enter both userid and password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Login | Red Horizon Mars Tours</title>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header>
    <div class="logo">Red Horizon Mars Tours</div>
    <!-- Shared navigation menu -->
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="pilot-application.php">Pilot Application</a></li>
            <li><a href="next-launch.php">Next Launch</a></li>
            <li><a class="active" href="login.php">Employee Login</a></li>
        </ul>
    </nav>
</header>

<main class="container">
    <h1>Employee Intranet Login</h1>
    <p>
        Authorized personnel only. Use your assigned userid and password to access the crew intranet.
    </p>

    <!-- Login form. JavaScript will validate before submit. -->
    <form id="loginForm" action="login.php" method="post" novalidate>
        <!-- Userid input -->
        <label for="userid">User ID</label>
        <input type="text" id="userid" name="userid" placeholder="e.g., erodriguez">
        <span class="error" id="useridError"></span>

        <!-- Password input -->
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Your password">
        <span class="error" id="passwordError"></span>

        <!-- Server-side PHP error message (wrong credentials, etc.) -->
        <?php if ($loginError !== ""): ?>
            <p class="error server-error"><?php echo htmlspecialchars($loginError); ?></p>
        <?php endif; ?>

        <button type="submit" class="primary-btn">Log In</button>
    </form>

    <p class="note">
        If you have trouble logging in, contact Mission Control IT for a credential reset.
    </p>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Red Horizon Mars Tours.</p>
</footer>

<!-- JavaScript validation for the login form -->
<script src="login-validation.js"></script>
</body>
</html>
