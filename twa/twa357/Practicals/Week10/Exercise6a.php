<!DOCTYPE html>
<html lang="en">
    <body>
        <?php
        session_start();
        $user = $_SESSION["who"];
        $hobby = $_SESSION["hobby"];
        echo "<p>Hello ".$user.". Your hobby is ".$hobby."</p>";
        ?>
        <a href="exercise6.html">Return to form</a>
    </body>
</html>
