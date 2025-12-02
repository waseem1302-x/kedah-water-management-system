<?php
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password
$dbname = "water_quality";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
// Add this after the database connection in resource_management.php
$sql_total = "SELECT SUM(value) AS total_consumption FROM water_consumption";
$result_total = $conn->query($sql_total);
$total_consumption = $result_total->fetch_assoc()['total_consumption'];

$sql_avg = "SELECT AVG(value) AS avg_consumption FROM water_consumption";
$result_avg = $conn->query($sql_avg);
$avg_consumption = $result_avg->fetch_assoc()['avg_consumption'];

// Display results in HTML
echo "<p>Total Water Consumption: " . number_format($total_consumption) . " m³</p>";
echo "<p>Average Yearly Consumption: " . number_format($avg_consumption) . " m³</p>";
