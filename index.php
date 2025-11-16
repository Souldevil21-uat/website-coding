<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Red Horizon Mars Tours</title>
    <!-- Link shared CSS for consistent styling -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<!-- ===== HEADER SECTION ===== -->
<header>
    <!-- Company name / logo -->
    <div class="logo">Red Horizon Mars Tours</div>

    <!-- Navigation menu to switch pages -->
    <nav>
    <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="pilot-application.php">Pilot Application</a></li>
        <li><a href="next-launch.php">Next Launch</a></li>
    </ul>
</nav>

</header>

<!-- ===== MAIN CONTENT ===== -->
<main class="container">
    <h1>Welcome to Red Horizon Mars Tours</h1>

    <!-- Company description paragraph -->
    <p>
        Red Horizon Mars Tours is the first luxury interplanetary tourism company dedicated to
        safe, breathtaking journeys to the Red Planet. Our guests experience Martian sunrise over
        Olympus Mons, glide above Valles Marineris, and relax in zero-g observation lounges.
    </p>
    <p>
        To make that possible, we are recruiting an elite squadron of Mars Tour Pilots.
        Do you have the courage to join the mission?
    </p>

    <!-- Button leading to the application form -->
    <a class="primary-btn" href="pilot-application.php">Apply to be a Mars Tour Pilot</a>
</main>

<!-- ===== FOOTER ===== -->
<footer>
    <p>&copy; <?php echo date("Y"); ?> Red Horizon Mars Tours. All rights reserved.</p>
</footer>
</body>
</html>

