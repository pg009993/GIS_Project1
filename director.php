<!DOCTYPE html>
<html>

<head>
    <title>Actors who were also directors.</title>
    <meta charset="utf-8" />
    <!-- Link to your CSS file that you should edit -->
    <link href="bacon.css" type="text/css" rel="stylesheet" /> </head>

<body>
    <div id="banner">
        <!--            Same as index.php file, banner style taken from bacon.css-->
        <a href="homepage.php"> </div>
    <div id="content">
        <!--            Style for id=content taken from bacon.css-->
        <?php
        include 'common.php';
//        $servername = "localhost:3306";
//        $username = "root";
//        $password = "root";
//        $dbname = "myDB";

        try {
            $conn = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            


        $sql = "SELECT a.first_name, a.last_name FROM actors AS a
                WHERE (a.first_name, a.last_name)  
                IN (SELECT d.first_name, d.last_name
                FROM directors AS d 
                WHERE a.first_name = d.first_name 
                AND a.last_name = d.last_name)
                ORDER BY a.first_name ASC, a.last_name ASC";
        
        $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        echo '<table><th>Directors that are actors</th>';
        $index = 0;
            // output data of each row
            while($row = $stmt->fetch()) {  
                echo '<tr><td>'. $row["first_name"].' ' . $row["last_name"]. "</td></tr>";
                $index++;
            }
         if($index == 0) {
            echo "0 results";   
        }
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
        $conn = null;
        echo '</table>';
?>
            <p>A table showing actors who were also directors.</p>
    </div>
</body>

</html>