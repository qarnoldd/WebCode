<!--BY STUDENT 20732093 ARNOLD QUIOCHO-->
<?php
session_start();
if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
} else {
    $login = false;
}
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = null;
}
if (isset($_SESSION['is_admin'])) {
    $is_admin = $_SESSION['is_admin'];
} else {
    $is_admin = false;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link href="css/master.css" type="text/css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mogra&family=Roboto+Slab&display=swap" rel="stylesheet">
    </head>
    <body>
    <header>
            <a href="index.php">
                <section class="titleBar">
                    <h1>Annie's Animal Adoptions</h1>
                    <img src="images/LOGO.png" id="logo" alt="logo"></img>
                    <h2>Rescues of all shapes and sizes</h2>
                </section>
            </a>
            <section class="topNav" >
				<section id="leftNav">
					<a href="petListings.php" class="navmenu">Pet Listings</a>
				</section>
				<section id="RightNav">
                    <?php if($is_admin == 1)
                    {?>
                    <a href="manageAdoptionApplications.php" class="navmenu">Manage Adoption Applications</a>
                        <a href="managePetListings.php" class="navmenu">Manage Pet Listings</a>
                    <?php
                    }
                    if($login == true)
                    { ?>
                        <a href="logout.php" class="navmenu">Logout</a>
                    <?php 
                    }
                    else if ($login == false)
                    {?>
                    <a href="registrationPage.php" class="navmenu">Register</a>
					<a href="login.php" class="navmenu">Login</a>
                    <?php 
                    }?>
				</section>
			</section>
        </header>
        <main>
            <section class="login">
                <h3>Login</h3>
                <form id="login" method="post">
                    <label for="email">Email: </label>
                    <input type="text" name="email" size="15">
                    <label for="password">Password: </label>
                    <input type="text" name="password" size="15"><br><br>
                    <input type="submit">
                    <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST")
                        {
                            require_once("dbconn.php");
                            if (isset($_POST['email']) || isset($_POST['password'])) 
                            {
                                $email = $dbConn->escape_string($_POST['email']);
                                $password = $dbConn->escape_string($_POST['password']);
                                // Using empty() function
                                if (empty($email) || empty($password) || $email === '' || $password === '')
                                    echo "<p class=\"warning\">Both input fields must not be empty.</p>";
                                else
                                {
                                    
                                    $sql = "SELECT * FROM users WHERE email = '$email'";
                                    $results = $dbConn->query($sql)
                                        or die ('Problem with query: ' . $dbConn->error);     

                                    if ($results->num_rows == 0) 
                                    {
                                        echo "<p class=\"warning\">Login details are incorrect.</p>";
                                    } 
                                    else 
                                    {
                                        $row = $results->fetch_assoc();
                                        
                                        $hashPassword = hash('sha256', $password);
                                            
                                        if ($row["password"] == $hashPassword)
                                        {
                                            $_SESSION['login'] = true;
                                            $_SESSION['user_id'] = $row["user_id"];
                                            $_SESSION['is_admin'] = $row["is_admin"];
                                            echo "<p>Hello " . $row["first_name"] . "!</p>";
                                            
                                            header("refresh:3; url=index.php");
                                        }
                                        else
                                        {
                                            echo "<p class=\"warning\">Login details are incorrect.</p>";
                                        }
                                    }
                                }
                            }
                            $dbConn->close();
                        }
                    ?>
                </form>
            </section>
        </main>  
        <footer>
            <p>Western Sydney University<br><br>By 20732093 Arnold Quiocho<br>Technologies for Web Applications<br>Copyright 2023 (not really).</p>
        </footer>
    </body>
</html>