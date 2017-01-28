<!DOCTYPE html>
<html>
    <head>
        <title>My Movie Database (MyMDb)</title>
        <meta charset="utf-8" />

        <!-- Link to your CSS file that you should edit -->
        <link href="bacon.css" type="text/css" rel="stylesheet" />
    </head>

    <body>
        <div id="frame">
            <div id="banner">
<!--                This div tag uses style from css file with id=banner-->
                    <a href="index.php"><img src="mymdb.png" alt="banner logo" /></a>
            Database
            </div>

            <div id="main">
                <!-- form to search for movies where a given actor was with Kevin Bacon-->
                <h1>The Six Degrees of Kevin Bacon</h1>
                <p>Kevin Bacon is everywhere!</p>
                <p><img src="kevin_bacon.jpg" alt="Kevin Bacon" /></p>
                <form action="1degree.php" method="get">
                    <fieldset>
                        <legend>One Degree Of Seperation From Kevin Bacon</legend>
                        <div>
                            <input name="firstname" type="text" size="12" placeholder="first name" /> 
                            <input name="lastname" type="text" size="12" placeholder="last name" /> 
                            <input type="submit" value="go" />
                        </div>
                    </fieldset>
                </form>
                <br>
                <!-- form to search for actors who have two degrees of seperation from Kevin Bacon -->
                 <form action="2degrees.php" method="get">
                    <fieldset>
                        <legend>Two Degrees Of Seperation From Kevin Bacon</legend>
                        <div>
                            <input name="firstname" type="text" size="12" placeholder="first name" /> 
                            <input name="lastname" type="text" size="12" placeholder="last name" /> 
                            <input type="submit" value="go" />
                        </div>
                    </fieldset>
                </form>
                <br>
                  <!-- button to display most popular genre--> 
                 <form action="1genre.php" method="get">
                    <fieldset>
                        <legend>Most Popular Genre</legend>
                        <div>
                            <input type="submit" value="Show Result" />
                        </div>
                    </fieldset>
                </form> 
                <br>
                <!-- form to display showing actors with max number of movies of user-given genre--> 
                 <form action="2genre.php" method="get">
                    <fieldset>
                        <legend>Two Genre</legend>
                        <div>
                            <select name="genre">
                            <option value="">Select a Genre</option>
                                <option value="Action">Action</option>
                                <option value="Adventure">Adventure</option>
                                <option value="Animation">Animation</option>
                                <option value="Comedy">Comedy</option>
                                <option value="Crime">Crime</option>
                                <option value="Drama">Drama</option>
                                <option value="Family">Family</option>
                                <option value="Fantasy">Fantasy</option>
                                <option value="Horror">Horror</option>
                                <option value="Music">Music</option>
                                <option value="Musical">Musical</option>
                                <option value="Mystery">Mystery</option>
                                <option value="Romance">Romace</option>
                                <option value="Sci-fi">Sci-Fi</option>
                                <option value="Thriller">Thriller</option>
                                <option value="War">War</option>
                                
                            
                            </select> 
                            <input type="submit" value="Submit" />
                        </div>
                    </fieldset>
                </form>
                <br>
                 <!-- button to display a table of who was an actor and director--> 
                 <form action="director.php" method="get">
                    <fieldset>
                        <legend>Actors Who Were Also Directors</legend>
                        <div>
                            <input type="submit" value="Show Results" />
                        </div>
                    </fieldset>
                </form>
                <br>
              
            </div> <!-- end of #main div -->

        </div> <!-- end of #frame div -->
    </body>
</html>