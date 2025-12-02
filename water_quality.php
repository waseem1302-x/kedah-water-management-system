<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "water_quality";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch water quality data
$sql = "SELECT id, ph, hardness, solids, chloramines, potability, water_quality FROM water_quality_data LIMIT 25";
$result = $conn->query($sql);

// Add legend for water quality
echo "<div style='margin-bottom: 20px;'>
        <p><span style='color: green; font-weight: bold;'>Good</span> = High Quality</p>
        <p><span style='color: orange; font-weight: bold;'>Moderate</span> = Medium Quality</p>
        <p><span style='color: red; font-weight: bold;'>Poor</span> = Low Quality</p>
      </div>";

echo "<h2>Water Quality Data</h2>";

// Generate the table
if ($result && $result->num_rows > 0) {
    echo "<table style='width: 100%; border-collapse: collapse;'>
            <thead>
                <tr style='background-color: #f2f2f2;'>
                    <th style='padding: 10px; border: 1px solid #ddd;'>ID</th>
                    <th style='padding: 10px; border: 1px solid #ddd;'>pH</th>
                    <th style='padding: 10px; border: 1px solid #ddd;'>Hardness</th>
                    <th style='padding: 10px; border: 1px solid #ddd;'>Solids</th>
                    <th style='padding: 10px; border: 1px solid #ddd;'>Chloramines</th>
                    <th style='padding: 10px; border: 1px solid #ddd;'>Potability</th>
                    <th style='padding: 10px; border: 1px solid #ddd;'>Water Quality</th>
                </tr>
            </thead>
            <tbody>";
    while ($row = $result->fetch_assoc()) {
        // Determine the color class for water quality
        $textClass = strtolower($row['water_quality']); // Convert to lowercase for consistency
        $color = match ($textClass) {
            'good' => 'green',
            'moderate' => 'orange',
            'poor' => 'red',
            default => 'black'
        };

        // Render table rows
        echo "<tr>
                <td style='padding: 10px; border: 1px solid #ddd; text-align: center;'>{$row['id']}</td>
                <td style='padding: 10px; border: 1px solid #ddd; text-align: center;'>{$row['ph']}</td>
                <td style='padding: 10px; border: 1px solid #ddd; text-align: center;'>{$row['hardness']}</td>
                <td style='padding: 10px; border: 1px solid #ddd; text-align: center;'>{$row['solids']}</td>
                <td style='padding: 10px; border: 1px solid #ddd; text-align: center;'>{$row['chloramines']}</td>
                <td style='padding: 10px; border: 1px solid #ddd; text-align: center;'>" . ($row['potability'] ? "Potable" : "Non-Potable") . "</td>
                <td style='padding: 10px; border: 1px solid #ddd; text-align: center; color: {$color}; font-weight: bold;'>{$row['water_quality']}</td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>No data available.</p>";
}

$conn->close();
?>
