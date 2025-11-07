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
        
        function drawChart(){
            <?php
            $db_host= 'localhost';
            $db_user= 'root';
            $pwd= '';
            $db_name= 'gestion_students';
            $conn = new mysqli(db_host, db_user, pwd, db_name );

            if($conn-> connect_error){
                die("Erreur de conn". $conn-> connect_error ); 
            }
            ?>

        }
    </script>

</head>
<body>


    
</body>
</html>