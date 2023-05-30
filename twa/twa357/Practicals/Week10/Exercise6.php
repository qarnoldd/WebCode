<!DOCTYPE html>
<html lang="en">
    <body>
        <?php
        session_start();
        $user = $_POST["personName"];
        $_SESSION["hobby"] = $_POST["hobby"];
        $_SESSION["who"] = $user;
        //etc etc
        ?>
        <a href="Exercise6a.php">Let's go to the next page.</a>
    </body>
</html>
