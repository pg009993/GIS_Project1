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

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);  
            } 
        
            $sql = "SELECT genre , count(*) as MaxCount
            FROM movies_genres
            GROUP BY genre
            HAVING count(*) = 
                (select count(*) 
                from movies_genres
                group by genre 
                order by count(*) desc
                LIMIT 1)";
        
            $result = $conn->query($sql);

        
            echo '<table><th>Genre</th><th>#</th></tr>';
            if ($result->num_rows > 0) {
                // output data of each row
                
                while($row = $result->fetch_assoc()) {
                    echo '<tr><td>' . $row["genre"]. '</td><td>' . $row["MaxCount"] . '</td></tr>';
                }
            } else {
                echo '<tr><td> No results</td><td> No results</td></tr>';
            }
            echo '</table>';
            $conn->close();
?>
    </div>
</body>

</html>