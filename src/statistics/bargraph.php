<?php
session_start();

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'ewsd';
$port = '3306';

$con = new mysqli($host, $username, $password, $db, $port);
if ($con->connect_errno) {
    echo "Connection Failed";
}
$arti_by_fac_q = "SELECT f.faculty_name, COUNT(a.article_id) AS total_articles_by_faculty
                  FROM articles a
                  JOIN users u ON a.user_id = u.id
                  JOIN faculties f ON u.faculty_id = f.id
                  GROUP BY f.faculty_name;";

$arti_by_fac_res = $con->query($arti_by_fac_q);

// Prepare data for the chart
$dataPoints = array();

while ($row = $arti_by_fac_res->fetch_assoc()) {
    $dataPoints[] = array("label" => $row['faculty_name'], "y" => (int)$row['total_articles_by_faculty']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Articles by Faculty</title>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* .charts-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        } */

        #chartContainer {
            width: 100%;
            height: auto;
            margin: 2px;
            padding: 2px;
        }

        .canvasjs-chart-credit {
            display: none !important;
        }
    </style>
</head>

<body>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>

    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // Choose between light1, light2, dark1, dark2
                title: {
                    text: "Total Articles by Faculty"
                },
                axisY: {
                    includeZero: true
                },
                data: [{
                    type: "column", // Type of chart: column (bar chart)
                    indexLabel: "{y}", // Shows the count on top of each bar
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside", // Places the count above the bar
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
    </script>
    <div id="chartContainer"></div>

</body>

</html>