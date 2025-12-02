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

// Data Query Without Filters
$sql = "SELECT state, sector, date, value FROM water_consumption";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resource Management</title>
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    
    <!-- Styling -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .content {
            margin: 20px auto;
            padding: 20px;
            max-width: 90%;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            font-size: 28px;
            color: #4CAF50;
        }
        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #2c3e50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="content">
        <h2>Resource Management</h2>

        <!-- Data Table -->
        <table id="resourceTable" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #4CAF50; color: white; text-align: center;">
                    <th style="padding: 10px;">STATE</th>
                    <th style="padding: 10px;">SECTOR</th>
                    <th style="padding: 10px;">DATE</th>
                    <th style="padding: 10px;">CONSUMPTION (M³)</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr style="text-align: center; border-bottom: 1px solid #ddd;">
                            <td style="padding: 10px;"><?= htmlspecialchars($row['state']); ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($row['sector']); ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($row['date']); ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars(number_format($row['value'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr style="text-align: center;">
                        <td colspan="4" style="padding: 10px; color: #f00; font-weight: bold;">No data available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <footer>
        Water Management © 2025 | All Rights Reserved
    </footer>

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function() {
            $('#resourceTable').DataTable({
                responsive: true,
                scrollX: true
            });
        });
    </script>
</body>
</html>
