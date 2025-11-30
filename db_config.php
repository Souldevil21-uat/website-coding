<?php
// db_config.php
// Central place to manage the database connection for the Mars tourism site.

// Change these if your local setup is different.
$DB_HOST = 'localhost';
$DB_USER = 'root';       // XAMPP default user
$DB_PASS = '';           // XAMPP default has empty password
$DB_NAME = 'mars_tourism';

// Create a new MySQLi connection object.
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Check for a connection error and stop the script if it fails.
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
