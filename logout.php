<?php
// logout.php
// Ends the current session and sends the user back to the login screen.

session_start();
session_unset();  // Remove all session variables
session_destroy(); // Completely destroy the session

// Redirect to the login page.
header("Location: login.php");
exit;
