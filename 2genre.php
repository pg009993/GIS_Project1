<!DOCTYPE html>
<html>

<head>
    <title>Two Genre</title>
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

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $genre = $_GET["genre"];
        //N E E D T O S T I L L I M P L E M E N T
        $sql = "select a.first_name, a.last_name, count(*) as MaxNum
        from actors a, roles r, movies m, movies_genres mg
        where m.id=mg.movie_id AND mg.genre='". $genre."' AND
        r.actor_id=a.id AND r.movie_id=m.id
        GROUP BY first_name, last_name
        HAVING MaxNum= (select count(r.actor_id) actorid
        from actors a, roles r, movies m, movies_genres mg
        where m.id=mg.movie_id AND mg.genre='" . $genre . "' AND r.actor_id=a.id AND r.movie_id=m.id
        GROUP BY r.actor_id
        ORDER BY actorid DESC
        LIMIT 1);
        ";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table><th>Name</th><th>Max num of movies in Genre</th>';
        // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<tr><td>' . $row["first_name"] . ' ' .$row["last_name"] . '</td><td>' . $row["MaxNum"] . 
                                       '</td></tr>';
                }
            }
        else {
            echo "There are no results currently with the genre: ". $genre;
            }
        echo '</table>';
            
        $conn->close();
        ?>
        <p>A table showing actors with the max number of movies for a specified genre.</p>
    </div>
</body>
</html>