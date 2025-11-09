<!-- application-success.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Received | Red Horizon Mars Tours</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <div class="logo">Red Horizon Mars Tours</div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="pilot-application.php">Pilot Application</a></li>
        </ul>
    </nav>
</header>

<main class="container">
    <h1>Application Received</h1>
    <p>Thank you for applying to join the Red Horizon Mars Tour Pilot Program!</p>

    <?php
    // Retrieve data safely using htmlspecialchars() to prevent XSS
    $fullName    = htmlspecialchars($_POST['fullName'] ?? '');
    $email       = htmlspecialchars($_POST['email'] ?? '');
    $age         = htmlspecialchars($_POST['age'] ?? '');
    $flightHours = htmlspecialchars($_POST['flightHours'] ?? '');
    $experience  = htmlspecialchars($_POST['experienceLevel'] ?? '');
    $readiness   = htmlspecialchars($_POST['readiness'] ?? '');
    $relocate    = htmlspecialchars($_POST['relocate'] ?? '');
    $motivation  = htmlspecialchars($_POST['motivation'] ?? '');
    $callSign    = htmlspecialchars($_POST['callSign'] ?? '');
    ?>

    <!-- Display the information entered -->
    <section class="summary-card">
        <h2>Pilot Candidate Summary</h2>
        <p><strong>Name:</strong> <?php echo $fullName; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Age:</strong> <?php echo $age; ?></p>
        <p><strong>Total Flight Hours:</strong> <?php echo $flightHours; ?></p>
        <p><strong>Experience Level:</strong> <?php echo $experience; ?></p>
        <p><strong>Readiness Rating:</strong> <?php echo $readiness; ?></p>
        <p><strong>Relocation Willingness:</strong> <?php echo $relocate; ?></p>
        <p><strong>Motivation Statement:</strong><br><?php echo nl2br($motivation); ?></p>
        <?php if ($callSign): ?>
            <p><strong>Preferred Call Sign:</strong> <?php echo $callSign; ?></p>
        <?php endif; ?>
    </section>

    <p>Our team will contact qualified applicants for further evaluation. Good luck, Pilot!</p>
    <a class="primary-btn" href="pilot-application.php">Submit Another Application</a>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Red Horizon Mars Tours.</p>
</footer>
</body>
</html>
