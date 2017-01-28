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

$sql = "SELECT a.first_name, a.last_name FROM actors AS a
                          WHERE (a.first_name, a.last_name)  
	                      IN (SELECT d.first_name, d.last_name
                          FROM directors AS d 
                          WHERE a.first_name = d.first_name 
                          AND a.last_name = d.last_name)
                          ORDER BY a.first_name ASC, a.last_name ASC";
        
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["first_name"]. " " . $row["last_name"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
        
            <p>A table showing actors who were also directors.</p>
    </div>
</body>

</html>