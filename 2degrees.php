<!DOCTYPE html>
<html>

<head>
    <title>One Degree Of Seperation</title>
    <meta charset="utf-8" />
    <!-- Link to your CSS file that you should edit -->
    <link href="bacon.css" type="text/css" rel="stylesheet" /> </head>

<body>
    <div id="banner">
        <a href="index.php"></a>
    </div>
    <div id="content">
        <h1>Results for <?php echo $_GET['firstname'] . ' ' . $_GET['lastname']; ?> (two degrees of Kevin Bacon) </h1>
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
                $query = "select distinct a1.first_name, a1.last_name, m.name, m.year
                from movies m join roles r on r.movie_id=m.id
                join actors a on r.actor_id=a.id 
                join roles r1 on r1.movie_id=m.id
                join actors a1 on r1.actor_id=a1.id
                where ((r.movie_id=r1.movie_id)AND(r.actor_id='".$kevinsid."')
                and (r1.actor_id IN
                (select r2.actor_id from movies m1, roles r2
                where r2.movie_id=(Select m3.id from movies m3, roles r4
                where m3.id=r4.movie_id and r4.actor_id='".$actorid."')))
                )
                limit 1;";
                
                $query2 =  "SELECT * FROM movies m JOIN roles r ON r.movie_id = m.id JOIN actors a ON r.actor_id = a.id JOIN roles rr ON rr.movie_id = m.id JOIN actors aa ON rr.actor_id = aa.id WHERE r.movie_id = rr.movie_id AND r.actor_id = '" . $actorid . "' AND rr.actor_id = " . $kevinsid . " ORDER BY m.year DESC, m.name ASC";
                
                $stmt2 = $conn->prepare($query2);
                $stmt2->execute();
                $result2 = $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                $numRows2 = $stmt2->rowCount();
                
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $numRows = $stmt->rowCount();
                if($numRows2 > 0){
                    
                    echo 'There is no 2 degree of separation.';
                    } else{
                    while($row = $stmt->fetch()){
                            echo ''.$firstname. ' '. 
                         $lastname. ' is within 2 degrees of
                                separation with KB!';     
                    }
            }
                
                
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
            $conn = null;
            ?>
    </div>
</body>

</html>