<!DOCTYPE html>
<html>
    <head>
        <title>One Degree Of Seperation</title>
        <meta charset="utf-8" />

        <!-- Link to your CSS file that you should edit -->
        <link href="bacon.css" type="text/css" rel="stylesheet" />
    </head>

    <body>
        <div id="banner">
            <a href="index.php"></a>
        </div>
        <div id="content">
            <h1>Results for <?php echo $_GET['firstname'] . ' ' . $_GET['lastname']; ?> (one degree of Kevin Bacon) </h1>
            <?php
//            Line below connects to database, done in 1degree.php
            include 'common.php';
//            Lines below set user input to variables $firstname and $lastname
            $firstname = $_GET['firstname'];
            $lastname = $_GET['lastname'];
            // Create connection
            try {
                $conn = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // function below returns actor_id, from 1degree.php
                $actorid = get_actor_id($firstname, $lastname);
                if ($actorid === -1) {
                    echo "Actor " . $firstname . " " . $lastname . " not found";
                    exit;
                }
                // query below returns list of movies in which Kevin Bacon and other actor has starred in
                $query = "SELECT * FROM movies m JOIN roles r ON r.movie_id = m.id JOIN actors a ON r.actor_id = a.id JOIN roles rr ON rr.movie_id = m.id JOIN actors aa ON rr.actor_id = aa.id WHERE r.movie_id = rr.movie_id AND r.actor_id = '" . $actorid . "' AND rr.actor_id = " . $kevinsid . " ORDER BY m.year DESC, m.name ASC";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                //$numberOfRows = $stmt->fetch(PDO::FETCH_NUM);
                $numRows = $stmt->rowCount();
                
                if($numRows > 0){
                echo '<table><tr><th>#</th><th>Title</th><th>Year</th></tr>';
                $index = 1;
                // loop below prints out results in html
                    while ($row = $stmt->fetch()) {
                      echo '<tr><td>' . $index . '</td><td>' . $row["name"] . '</td><td>' . $row['year'] . '</td></tr>';
                        $index++;
                    }
                 echo '</table>';
                echo '<p>A table showing movies that this actor has starred in that also starred Kevin Bacon.</p>';
                } else{
                    echo 'No results for ' . $firstname. ' ' . $lastname . '.';
                }
               
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
            $conn = null;
            ?>

        </div>
    </body>
</html>