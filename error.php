<!DOCTYPE html>
<html>
    <head>
        <title>Error</title>
    </head>
    <body>
        <?php

            if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['button'] == "Login") {
                header('Location: login.php');
            }

        ?>
    <div style= "text-align:center";>
        
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            
        <label>Under Construction. Go to </label>
            <input type="submit" value="Login" name="button"> 
        <label> Page</label>
        </form>

       



    </body>
</html>