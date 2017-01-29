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
            <h1>Results For Two Degrees Away From Kevin Bacon </h1>
            <?php
            include 'common.php';           
            // Create connection
            try {
                $conn = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                // query below returns list of actors who have 2 degrees of separation from Kevin Bacon
                $query = "select first_name, last_name from actors";
                    
     
                    /*
                    "select a1.first_name, a1.last_name, m.name, m.year
                from movies m join roles r on r.movie_id=m.id
                join actors a   on r.actor_id=a.id 
                join roles r1 on r1.movie_id=m.id
                join actors a1 on r1.actor_id=a1.id
                where ((r.movie_id=r1.movie_id)AND(r.actor_id='22591') and (r1.actor_id IN
                (select r2.actor_id from movies m1, roles r2
                where r2.movie_id=(Select m3.id from movies m3, roles r4
                where m3.id=r4.movie_id and r4.actor_id='44737'))));";
                */ 
                    
                    
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $numRows = $stmt->rowCount();
                
                if($numRows > 0){
                echo '<table><tr><th>First Name</th><th>Last Name</th></tr>';
                // loop below prints out results in html
                    while ($row = $stmt->fetch()) {
                      echo '<tr><td>' . $row["first_name"] . '</td><td>' . $row["last_name"] . '</td></tr>';
                    }
                 echo '</table>';
                echo '<p>A table showing actors who have 2 degrees of separation from Kevin Bacon.</p>';
                } else{
                    echo 'No results.';
                }
               
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
            $conn = null;
            ?>
        </div>
    </body>
</html>