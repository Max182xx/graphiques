<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphiques</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart); 
        
        function drawChart() {
            // On prépare les structures de données côté JavaScript
            var data1 = new google.visualization.DataTable();
            data1.addColumn('string', 'Matière');
            data1.addColumn('number', 'Moyenne des notes');

            var data2 = new google.visualization.DataTable();
            data2.addColumn('string', 'Matière');
            data2.addColumn('number', 'Moyenne des notes');

            <?php
            $db_host = 'localhost';
            $db_user = 'root';
            $pwd = '';
            $db_name = 'gestion_students';

            $conn = new mysqli($db_host, $db_user, $pwd, $db_name);
            if ($conn->connect_error) {
                die('Erreur de connexion : ' . $conn->connect_error);
            }

            $sql = "SELECT subjects.name AS subject, AVG(students.grade) AS average_grade
                    FROM students
                    INNER JOIN subjects ON students.subject_id = subjects.id
                    GROUP BY subjects.name";

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                echo 'data1.addRows([';
                while ($row = $result->fetch_assoc()) {
                    echo "['" . $row['subject'] . "', " . $row['average_grade'] . '],';
                }
                echo ']);';

                // Requête relancée pour data2 (car $result est déjà lu)
                $result2 = $conn->query($sql);
                echo 'data2.addRows([';
                while ($row2 = $result2->fetch_assoc()) {
                    echo "['" . $row2['subject'] . "', " . $row2['average_grade'] . '],';
                }
                echo ']);';
            }

            $conn->close();
            ?>

            var options = {
                title: "Moyenne des notes par matière",
                fontName: 'Poppins'
            };

            var chart1 = new google.visualization.PieChart(document.getElementById("chart_div1"));
            chart1.draw(data1, options);

            var chart2 = new google.visualization.BarChart(document.getElementById("chart_div2"));
            chart2.draw(data2, options);
        }
    </script>
</head>
<body>
    <div id="chart_div1" style="width: 600px; height: 400px;"></div>
    <div id="chart_div2" style="width: 600px; height: 400px;"></div>
</body>
</html>
