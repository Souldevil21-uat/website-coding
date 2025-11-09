<!-- pilot-application.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pilot Application | Red Horizon Mars Tours</title>
    <!-- Link the shared CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <div class="logo">Red Horizon Mars Tours</div>
    <!-- Navigation menu -->
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="pilot-application.php" class="active">Pilot Application</a></li>
        </ul>
    </nav>
</header>

<main class="container">
    <h1>Mars Tour Pilot Application</h1>

    <!-- Short introduction for applicants -->
    <p>
        Please fill out this application completely. Use accurate information so we can review
        your eligibility for interplanetary pilot training.
    </p>

    <!-- 
        FORM SECTION
        - Uses POST to send data to application-success.php
        - "novalidate" disables HTML5 validation so our custom JS runs
    -->
    <form id="pilotApplicationForm" action="application-success.php" method="post" novalidate>

        <!-- TEXT INPUT for full name -->
        <label for="fullName">Full Name (required)</label>
        <input type="text" id="fullName" name="fullName" placeholder="Your full legal name">
        <span class="error" id="fullNameError"></span>

        <!-- EMAIL INPUT -->
        <label for="email">Email Address (required)</label>
        <input type="email" id="email" name="email" placeholder="example@domain.com">
        <span class="error" id="emailError"></span>

        <!-- NUMBER INPUT for age -->
        <label for="age">Age (required, 21–60)</label>
        <input type="number" id="age" name="age" min="18" max="80" placeholder="Enter your age">
        <span class="error" id="ageError"></span>

        <!-- NUMBER INPUT for total flight hours -->
        <label for="flightHours">
            Total Flight Hours (minimum 1000 required)
        </label>
        <input type="number" id="flightHours" name="flightHours" placeholder="e.g., 2500">
        <span class="error" id="flightHoursError"></span>

        <!-- DROPDOWN for experience type -->
        <label for="experienceLevel">Highest Level of Space / Flight Experience</label>
        <select id="experienceLevel" name="experienceLevel">
            <option value="">-- Select one --</option>
            <option value="commercial_pilot">Commercial Airline Pilot</option>
            <option value="test_pilot">Test Pilot</option>
            <option value="military_pilot">Military Pilot</option>
            <option value="space_agency">Former Astronaut</option>
            <option value="simulator_only">Simulator Only</option>
        </select>
        <span class="error" id="experienceLevelError"></span>

        <!-- RADIO BUTTONS for readiness rating -->
        <label>Physical &amp; Mental Readiness (1 = Low, 5 = Elite)</label>
        <div class="radio-group">
            <label><input type="radio" name="readiness" value="1"> 1</label>
            <label><input type="radio" name="readiness" value="2"> 2</label>
            <label><input type="radio" name="readiness" value="3"> 3</label>
            <label><input type="radio" name="readiness" value="4"> 4</label>
            <label><input type="radio" name="readiness" value="5"> 5</label>
        </div>
        <span class="error" id="readinessError"></span>

        <!-- DROPDOWN for relocation -->
        <label for="relocate">Willing to Relocate to Lunar Training Facility?</label>
        <select id="relocate" name="relocate">
            <option value="">-- Select one --</option>
            <option value="yes">Yes, immediately</option>
            <option value="maybe">Maybe, depends on contract</option>
            <option value="no">No</option>
        </select>
        <span class="error" id="relocateError"></span>

        <!-- TEXTAREA for motivation -->
        <label for="motivation">
            Why should you be trusted to fly tourists to Mars?
        </label>
        <textarea id="motivation" name="motivation" rows="4"
                  placeholder="Explain your mindset, leadership, and decision-making under pressure."></textarea>
        <span class="error" id="motivationError"></span>

        <!-- OPTIONAL call sign input -->
        <label for="callSign">Preferred Call Sign (optional)</label>
        <input type="text" id="callSign" name="callSign" placeholder="e.g., Red Comet">

        <!-- SUBMIT BUTTON -->
        <button type="submit" class="primary-btn">Submit Application</button>
    </form>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Red Horizon Mars Tours.</p>
</footer>

<!-- JavaScript Validation file -->
<script src="validation.js"></script>
</body>
</html>
