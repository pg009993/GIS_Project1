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
        $servername = "localhost:3306";
        $username = "root";
        $password = "root";
        $dbname = "myDB";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
    
        //N E E D T O S T I L L I M P L E M E N T
        $sql = "SELECT * FROM directors_genres ";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                echo $row["genre"]. " " . "<br>";
                }
            } 
        else {
            echo "0 results";
            }
            
        $conn->close();
        ?>
        <p>A table showing actors who were also directors.</p>
    </div>
</body>
</html>