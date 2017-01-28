<!DOCTYPE html>
<html>

<head>
    <title>Most Popular Genre</title>
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
//            $servername = "localhost:3306";
//            $username = "root";
//            $password = "root";
//            $dbname = "myDB";

//            // Create connection
//            $conn = new mysqli($servername, $username, $password, $dbname);
//            // Check connection
//            if ($conn->connect_error) {
//                die("Connection failed: " . $conn->connect_error);  
//            } 
        try {
                $conn = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // function below returns actor_id, from 1degree.php
        
            $sql = "SELECT genre , count(*) as MaxCount
            FROM movies_genres
            GROUP BY genre
            HAVING count(genre) = 
                (select count(genre) 
                from movies_genres
                group by genre 
                order by count(genre) desc
                LIMIT 1)";
        
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        
            echo '<table><th>Genre</th><th>#</th></tr>';
            $index = 0;
                // output data of each row
                
            while($row = $stmt->fetch()) {
                    echo '<tr><td>' . $row["genre"]. '</td><td>' . $row["MaxCount"] . '</td></tr>';
                    $index++;
                }
            if($index == 0){
                echo '<tr><td> No results</td><td> No results</td></tr>';
            }
           } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
            echo '</table>';
            $conn=null;
?>
    </div>
</body>

</html>