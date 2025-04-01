<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "ewsd";
$port = "3306";

$con = new mysqli($host, $username, $password, $db, $port);
if ($con->connect_errno) {
    echo "Connection Failed";
}

// Faculty Contribution Percentage Query
$fac_cont_perc_q = "SELECT
                        f.faculty_name,
                        (COUNT(a.article_id) * 100.0 / (SELECT COUNT(*) FROM articles WHERE YEAR(created_at) = 2025)) AS contribution_percentage
                    FROM articles a
                    JOIN users u ON a.user_id = u.id
                    JOIN faculties f ON u.faculty_id = f.id
                    WHERE YEAR(a.created_at) = 2025
                    GROUP BY f.faculty_name;";

$fac_cont_perc_res = $con->query($fac_cont_perc_q);

// Prepare data points for faculty contribution chart
$fac_dataPoints = [];
while ($row = $fac_cont_perc_res->fetch_assoc()) {
    $fac_dataPoints[] = array("label" => $row['faculty_name'], "y" => (float)$row['contribution_percentage']);
}

// Percentage of students who submitted at least one article
$sub_percent_q = "SELECT 
                    (COUNT(DISTINCT a.user_id) * 100.0 / NULLIF(COUNT(u.id), 0)) AS percentage_students_submitted
                  FROM users u
                  LEFT JOIN articles a ON u.id = a.user_id
                  WHERE u.faculty_id = 1;";

$sub_percent_res = $con->query($sub_percent_q);
$sub_percent_row = $sub_percent_res->fetch_assoc();
$sub_percent = $sub_percent_row['percentage_students_submitted'] ?? 0; // Default to 0 if NULL

// Prepare data points for student submission chart
$student_dataPoints = [
    array("label" => "Students Submitted Articles", "y" => (float)$sub_percent),
    array("label" => "Students Not Submitted", "y" => 100 - (float)$sub_percent)
];
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .chart-containers {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .chart-container {
            flex: 1 1 45%;
            /* Allow two charts per row on large screens */
            max-width: 600px;
            /* Prevent excessive stretching */
            min-width: 300px;
            /* Prevent charts from getting too small */
            height: 400px;
            /* Set a fixed height */
        }

        @media (max-width: 768px) {
            .chart-container {
                flex: 1 1 100%;
            }
        }

        .canvasjs-chart-credit {
            display: none !important;
        }
    </style>

</head>

<body>
    <div class="chart-containers">
        <div id="facultyChartContainer" class="chart-container"></div>
        <div id="studentChartContainer" class="chart-container"></div>
    </div>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
<script>
    // Faculty Contribution Percentage
    window.onload = function() {

        // Faculty contribution chart
        var facultyChart = new CanvasJS.Chart("facultyChartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            credit: false, // Disable the credit link
            title: {
                text: "Faculty Article Contribution Percentage (2025)"
            },
            data: [{
                type: "pie",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 14,
                indexLabel: "{label} - #percent%",
                yValueFormatString: "#,##0.##%",
                dataPoints: <?php echo json_encode($fac_dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });

        // Student submission chart
        var studentChart = new CanvasJS.Chart("studentChartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            credit: false, // Disable the credit link
            title: {
                text: "Student Article Submission Percentage"
            },
            data: [{
                type: "pie",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 14,
                indexLabel: "{label} - #percent%",
                yValueFormatString: "#,##0.##%",
                dataPoints: <?php echo json_encode($student_dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });

        // Make the charts responsive
        function resizeCharts() {
            facultyChart.options.width = document.getElementById("facultyChartContainer").clientWidth;
            facultyChart.options.height = document.getElementById("facultyChartContainer").clientHeight;
            facultyChart.render();

            studentChart.options.width = document.getElementById("studentChartContainer").clientWidth;
            studentChart.options.height = document.getElementById("studentChartContainer").clientHeight;
            studentChart.render();
        }


        window.addEventListener("resize", resizeCharts);
        facultyChart.render();
        studentChart.render();

    }
</script>

</html>