<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Page avec form</title>
    </head>

    <body>
        <div id="main_wrapper">
            <form method="POST" action="target.php">
                <p>éléments de notre formulaire</p>
                <br>
                <label for="firstname">Prénom</label>: <input type="text" name="firstname" id="firstname" value="ben">
                <br>
                <textarea name="aboutyou" id="aboutyou" cols="50" rows="10">bla bla bla bla bla not xss protected..</textarea>
                <br>
                <textarea name="protected" id="protected" cols="50" rows="10">xss protected</textarea>
                <br>                
                <label for="country">Pays</label>: 
                <select name="country" id="country">
                    <option value="fr">France</option>
                    <option value="en">England</option>
                    <option value="de">Deutschland</option>
                </select>
                <br>
                <input type="checkbox" name="xboxcheck" id="xboxcheck"> <label for="xboxcheck">Xbox</label> <br>
                <input type="checkbox" name="pscheck" id="pscheck"> <label for="pscheck">Playstation</label> <br>
                <input type="checkbox" name="dscheck" id="dscheck"> <label for="dscheck">Nintendo DS</label> <br>
                <br>
                    Tu préfères : <input type="radio" name="sex" id="wsex" value="les filles"> <label for="wsex">les filles</label>
                    <input type="radio" name="sex" id="msex" value="les gars"> <label for="msex">les gars</label>
                <br>
                <input type="hidden" name="pseudo" id="pseudo" value="k.so.6.dev"> 
                <br>

                <input type="submit" value="post">
            </form>
        </div>
    </body>
</html>