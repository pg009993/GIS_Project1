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
                // query below returns movies in which actor has appeared in
                $query = "SELECT a.first_name, a.last_name FROM actors AS a
                          WHERE (a.first_name, a.last_name)  
	                      IN (SELECT d.first_name, d.last_name
                          FROM directors AS d 
                          WHERE a.first_name = d.first_name 
                          AND a.last_name = d.last_name)
                          ORDER BY a.first_name ASC, a.last_name ASC"
    
            
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                echo '<table><tr><th>#</th><th>Actors and Directors</th><th>Year</th></tr>';
                $index = 1;
                // loop below prints results in html, in table form
                while ($row = $stmt->fetch()) {
                    echo '<tr><td>' . $index . '</td><td>' . $row["name"] . '</td></tr>';
                    $index++;
                }
                echo '</table>';
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
            $conn = null;
            ?>
            <p>A table showing actors who were also directors.</p>
    </div>
</body>

</html>