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
                <a href="index.php"></a>
            Database
            </div>

            <div id="main">
                <!-- form to search for movies where a given actor was with Kevin Bacon-->
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
                            <input name="firstname" type="text" size="12" placeholder="first name" /> 
                            <input name="lastname" type="text" size="12" placeholder="last name" /> 
                            <input type="submit" value="go" />
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
                <!-- display any common code that is shared between pages--> 
                 <form action="common.php" method="get">
                    <fieldset>
                        <legend>Common Code</legend>
                        <div>
                            <input type="submit" value="Show Results" />
                        </div>
                    </fieldset>
                </form>
            
            </div> <!-- end of #main div -->

        </div> <!-- end of #frame div -->
    </body>
</html>