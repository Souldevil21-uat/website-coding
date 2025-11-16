<!-- next-launch.php -->
<?php
// ===== SERVER-SIDE (PHP) LOGIC =====
// Use your course/host timezone so server and JS agree
date_default_timezone_set('America/Chicago');

// A simple schedule of launch windows (could be edited anytime)
// CONTROL STRUCTURES: we'll loop to find the first future launch.
$launchWindows = [
    '2025-12-01 09:00:00',
    '2026-01-15 10:00:00',
    '2026-03-02 14:30:00',
];

$now = new DateTime();
$nextLaunch = null;

foreach ($launchWindows as $window) { // LOOP
    $candidate = new DateTime($window);
    if ($candidate > $now) {           // IF/ELSE CONTROL STRUCTURE
        $nextLaunch = $candidate;
        break;
    }
}

// Fallback: if all dates passed, schedule a default 30 days out
if (!$nextLaunch) { // IF/ELSE CONTROL STRUCTURE
    $nextLaunch = (clone $now)->modify('+30 days')->setTime(9, 0, 0);
}

// Pre-format values for initial render & JS handoff
$nextLaunchIso = $nextLaunch->format('c');                  // ISO 8601 for JS
$nextLaunchHuman = $nextLaunch->format('F j, Y g:i A T');   // Nice human format

// Initial message (server-side) for no-JS fallback, mirrors the client logic
$diff = $now->diff($nextLaunch);
$daysLeft = (int)$diff->format('%r%a'); // signed days
if ($daysLeft < 0) {
    $serverMessage = "🚀 This flight has already launched. Check back for the next window.";
} elseif ($daysLeft < 1) {
    $serverMessage = "🚨 Less than 24 hours! Report to the launch site.";
} elseif ($daysLeft < 7) {
    $serverMessage = "🧳 Less than a week — pack your bags!";
} elseif ($daysLeft < 30) {
    $serverMessage = "✅ Finalize your training and medical checks.";
} else {
    $serverMessage = "📅 Plenty of time — review the flight manual and itinerary.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Next Launch | Red Horizon Mars Tours</title>
    <link rel="stylesheet" href="styles.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
<!-- ===== HEADER + NAV (Professional-looking shared menu) ===== -->
<header>
    <div class="logo">Red Horizon Mars Tours</div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="pilot-application.php">Pilot Application</a></li>
            <li><a class="active" href="next-launch.php">Next Launch</a></li>
        </ul>
    </nav>
</header>

<main class="container">
    <h1>Next Mars Departure</h1>

    <!-- Launch card for clear UX -->
    <section class="launch-card">
        <!-- Human-readable fixed departure time (from PHP) -->
        <p class="launch-time">
            <strong>Departure Time:</strong> <?php echo $nextLaunchHuman; ?>
        </p>

        <!-- Live countdown (JS updates every minute). We pass PHP time via data attribute -->
        <div id="countdown"
             class="countdown-grid"
             data-launch-iso="<?php echo htmlspecialchars($nextLaunchIso); ?>">
            <!-- These values are filled by JS -->
            <div class="countdown-block">
                <div id="dd" class="count-val">--</div>
                <div class="count-label">Days</div>
            </div>
            <div class="countdown-block">
                <div id="hh" class="count-val">--</div>
                <div class="count-label">Hours</div>
            </div>
            <div class="countdown-block">
                <div id="mm" class="count-val">--</div>
                <div class="count-label">Minutes</div>
            </div>
        </div>

        <!-- Dynamic status message (also has server-side fallback for no JS) -->
        <p id="statusMsg" class="status-badge">
            <?php echo $serverMessage; ?>
        </p>

        <!-- Helpful actions -->
        <div class="actions">
            <a class="primary-btn" href="pilot-application.php">Apply to be a Pilot</a>
            <a class="secondary-btn" href="index.php">Back to Home</a>
        </div>
    </section>

    <!-- Accessibility note -->
    <p class="note">
        The countdown updates automatically every minute. If you use a screen reader, this section
        is marked as a live region so updates are announced politely.
    </p>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Red Horizon Mars Tours.</p>
</footer>

<!--COUNTDOWN LOGIC -->
<script>
// Updates the countdown every minute using the launch ISO time from PHP.
document.addEventListener("DOMContentLoaded", function () {
    const el = document.getElementById("countdown");
    if (!el) return;

    // Grab launch time passed from PHP in ISO 8601 format
    const launchIso = el.getAttribute("data-launch-iso");
    const launchDate = new Date(launchIso); // Browser parses ISO safely

    const dd = document.getElementById("dd");
    const hh = document.getElementById("hh");
    const mm = document.getElementById("mm");
    const statusMsg = document.getElementById("statusMsg");

    // For accessibility, announce updates without being overly chatty
    el.setAttribute("aria-live", "polite");

    // Compute and render remaining time
    function render() {
        const now = new Date();
        let ms = launchDate - now;

        // If launch time has passed, handle
        if (ms <= 0) {
            dd.textContent = "0";
            hh.textContent = "0";
            mm.textContent = "0";
            statusMsg.textContent = "🚀 This flight has already launched. Check back for the next window.";
            return;
        }

        // Convert remaining ms -> days/hours/minutes
        const minutes = Math.floor(ms / 60000);
        const days = Math.floor(minutes / (60 * 24));
        const hours = Math.floor((minutes % (60 * 24)) / 60);
        const mins = minutes % 60;

        // Update UI
        dd.textContent = String(days);
        hh.textContent = String(hours);
        mm.textContent = String(mins);

        // Friendly status messages based on thresholds (mirrors PHP)
        // CONTROL STRUCTURE: if/else ladder
        if (days < 1) {
            statusMsg.textContent = "🚨 Less than 24 hours! Report to the launch site.";
        } else if (days < 7) {
            statusMsg.textContent = "🧳 Less than a week — pack your bags!";
        } else if (days < 30) {
            statusMsg.textContent = "✅ Finalize your training and medical checks.";
        } else {
            statusMsg.textContent = "📅 Plenty of time — review the flight manual and itinerary.";
        }
    }

    // Initial render right away
    render();
    // and then update every minute on the minute.
    setInterval(render, 60 * 1000);
});
</script>
</body>
</html>
