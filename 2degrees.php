<!DOCTYPE html>
<html>

<head>
    <title>Two Degrees Of Seperation</title>
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
                // this query will select the actors that are a bridge between kevin bacon and 
                // the actor given from user input. It will first do 1st degree search with 
                // the actor given and actors who are in movies that kevin bacon is not in.
                // then it will find the actor that has a movie with kevin bacon and the movie
                // that the actor w/ kevin bacon has with the user given actor. If the selection table
                // is populated, then we know that there is 2 degrees of separation. If it is not populated
                // then there is no 2 degree of separation. 
                $query = "select distinct a.id, a.first_name, a.last_name, m.name
                from movies m
                join roles r on m.id=r.movie_id
                join actors a on a.id=r.actor_id
                join roles rr on rr.movie_id =m.id
                join roles aa on aa.actor_id=rr.actor_id
                where rr.actor_id='".$kevinsid."'
                and r.actor_id IN(
                select a.id
                from movies m
                join roles r on m.id=r.movie_id
                join actors a on a.id=r.actor_id
                join roles rr on rr.movie_id =m.id
                join actors aa on aa.id=rr.actor_id
                where r.movie_id=rr.movie_id
                and rr.actor_id='".$actorid."'
                and r.movie_id NOT IN(
                select m1.id from movies m1, roles r1, actors a1
                where m1.id=r1.movie_id and r1.actor_id=a1.id
                and r1.actor_id='".$kevinsid."')
                and r.actor_id not in(select distinct m2.id from movies m2, roles r2, actors a2
                where m2.id=r2.movie_id and r2.actor_id=a2.id
                and r2.actor_id='".$kevinsid."'));";


                
                $stmt= $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $numRows = $stmt->rowCount();
                if($numRows==0){    
                echo 'There is no 2 degree of separation.';
                } 
                else{
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