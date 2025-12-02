<?php
// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<p>You must log in to view reported issues.</p>";
    echo '<a href="login.php">Go to Login</a>'; // Provide a link to the login page
    exit();
}

// Connect to the database
$conn = new mysqli("localhost", "root", "", "water_quality");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all columns from the reported_issues table
$sql = "SELECT name, address, location, problem, phone_number, email, description, reported_at FROM reported_issues ORDER BY reported_at DESC";
$result = $conn->query($sql);

// Display the reported issues
echo "<h2>Reported Issues</h2>";
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr>
            <th>Name</th>
            <th>Address</th>
            <th>Location</th>
            <th>Problem</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Description</th>
            <th>Reported At</th>
        </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['address']) . "</td>
                <td>" . htmlspecialchars($row['location']) . "</td>
                <td>" . htmlspecialchars($row['problem']) . "</td>
                <td>" . htmlspecialchars($row['phone_number']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['description']) . "</td>
                <td>" . htmlspecialchars($row['reported_at']) . "</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No issues reported yet.</p>";
}

// Close the database connection
$conn->close();
?>
