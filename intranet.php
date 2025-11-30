<?php
// intranet.php
// This page is only visible to logged-in employees.

session_start();

// If the user is not logged in, send them back to the login page.
if (empty($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

// Get the employee name from the session for a friendly greeting.
$employeeName = $_SESSION['employee_name'] ?? 'Crew Member';

require_once 'db_config.php';

// Example: get some fun stats from the database to display on the intranet.
// Here we count how many employees and spacecraft exist.
$employeeCount = 0;
$spacecraftCount = 0;

$result = $conn->query("SELECT COUNT(*) AS c FROM employees");
if ($row = $result->fetch_assoc()) {
    $employeeCount = (int)$row['c'];
}

$result = $conn->query("SELECT COUNT(*) AS c FROM spacecraft");
if ($row = $result->fetch_assoc()) {
    $spacecraftCount = (int)$row['c'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Intranet | Red Horizon Mars Tours</title>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header>
    <div class="logo">Red Horizon Mars Tours</div>
    <!-- Same navigation, but show Login as just another link and maybe highlight here -->
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="pilot-application.php">Pilot Application</a></li>
            <li><a href="next-launch.php">Next Launch</a></li>
            <li><a class="active" href="intranet.php">Employee Intranet</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<main class="container">
    <h1>Welcome, <?php echo htmlspecialchars($employeeName); ?></h1>
    <p>
        You are now logged into the Red Horizon Mars Tours crew intranet.
        Review your mission briefings, HR forms, and upcoming launch details below.
    </p>

    <!-- Dashboard cards for a nicer UX -->
    <section class="dashboard-grid">
        <article class="dash-card">
            <h2>Flight Operations</h2>
            <p><strong>Active Crew Members:</strong> <?php echo $employeeCount; ?></p>
            <p><strong>Certified Spacecraft:</strong> <?php echo $spacecraftCount; ?></p>
            <p><strong>Next Scheduled Launch:</strong> See the <a href="next-launch.php">Next Launch</a> dashboard.</p>
        </article>

        <article class="dash-card">
            <h2>HR / Safety Forms</h2>
            <ul>
                <li><a href="#">Zero-G Workplace Safety Acknowledgment</a></li>
                <li><a href="#">Interplanetary Liability Waiver</a></li>
                <li><a href="#">“I Will Not Steal a Spaceship” Agreement</a></li>
                <li><a href="#">Time-Off Request for Post-Mars Recovery</a></li>
            </ul>
        </article>

        <article class="dash-card">
            <h2>Mission Briefing</h2>
            <p>
                Remember: all crew must report to the Lunar Gateway 48 hours before launch.
                Check your personal comms channel for individualized flight assignments
                and simulator schedules.
            </p>
        </article>
    </section>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Red Horizon Mars Tours.</p>
</footer>
</body>
</html>
