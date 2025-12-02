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

// Fetch data for charts
$data = [];
$totalCount = 0;
$sql = "SELECT water_quality, COUNT(*) AS count FROM water_quality_data GROUP BY water_quality";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
    $totalCount += $row['count']; // Calculate the total number of entries
}
$conn->close();
?>

<h2>Dashboard</h2>
<div class="dashboard-content">
    <!-- Pie Chart Container -->
    <div class="chart-container" style="width: 50%; margin: auto;">
        <canvas id="waterQualityChart"></canvas>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data preparation
    const data = <?php echo json_encode($data); ?>;
    const totalCount = <?php echo $totalCount; ?>;
    const labels = data.map(d => d.water_quality);
    const values = data.map(d => d.count);
    const percentages = values.map(value => ((value / totalCount) * 100).toFixed(2)); // Calculate percentages

    // Chart Configuration
    const ctx = document.getElementById('waterQualityChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie', // Chart type
        data: {
            labels: labels, // Water quality categories
            datasets: [{
                label: 'Water Quality Classification',
                data: values, // Count values for each category
                backgroundColor: [
                    '#06A736', // Green for Good
                    '#FFCE56', // Yellow for Moderate
                    '#FF6384'  // Red for Poor
                ],
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top', // Legend position
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const percentage = percentages[context.dataIndex]; // Fetch percentage
                            return `${label}: ${percentage}%`; // Display only percentage
                        }
                    }
                }
            }
        }
    });
</script>

<style>
    /* Styling for dashboard */
    .dashboard-content {
        text-align: center;
        margin-top: 20px;
    }

    .chart-container {
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
</style>
