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
        <title>Registration Page</title>
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
                    <a href="manageAdoptionApplications.php" class="navmenu">Manage Applications</a>
                        <a href="managePetListings.php" class="navmenu">Manage Listings</a>
                    <?php
                    }
                    if($login == true)
                    { ?>
                        <a href="logout.php" class="navmenu">Logout</a>
                    <?php 
                    }
                    else if ($login == false)
                    { ?>
                    <a href="registrationPage.php" class="navmenu">Register</a>
					<a href="login.php" class="navmenu">Login</a>
                    <?php 
                    } ?>
				</section>
			</section>
        </header>
        <main>
            <section class="login">
                <h3>Login</h3>
                <form id="login" class="adoptionForm" method="post">
                    <section>
                        <label for="first_name">First Name: </label>
                        <input type="text" name="first_name" size="15"><p class="required">*</p>
                    </section>
                    <section>
                        <label for="last_name">Last Name: </label>
                        <input type="text" name="last_name" size="15"><p class="required">*</p>
                    </section>
                    <section>
                        <label for="email">Email: </label>
                        <input type="text" name="email" size="15"><p class="required">*</p>
                    </section>
                    <section>
                        <label for="mobile">Mobile: </label>
                        <input type="text" name="mobile" size="15"><p class="required">*</p>
                    </section>
                    <section>
                        <label for="password">Password: </label>
                        <input type="text" name="password" size="15"><p class="required">*</p>
                    </section>
                    <section>
                        <label for="confirm">Confirm Password: </label>
                        <input type="text" name="confirm" size="15"><p class="required">*</p><br><br>
                    </section>
                    <input type="submit">
                    <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST")
                        {
                            require_once("dbconn.php");
                            if (isset($_POST['email']) || isset($_POST['password']) || isset($_POST['first_name']) || isset($_POST['last_name'])) 
                            {
                                $first_name = $dbConn->escape_string($_POST['first_name']);
                                $last_name = $dbConn->escape_string($_POST['last_name']);
                                $mobile = $dbConn->escape_string($_POST['mobile']);
                                $email = $dbConn->escape_string($_POST['email']);
                                $password = $dbConn->escape_string($_POST['password']);
                                $confirm = $_POST['confirm'];
                                if ($password != $confirm)
                                    echo "<p class=\"warning\">Passwords do not match.</p>";
                                else if (empty($email) || empty($password) || empty($first_name) || empty($last_name)  || $email === '' || $password === '' || $first_name === '' || $last_name === '')
                                    echo "<p class=\"warning\">All input fields must not be empty.</p>";
                                else
                                {
                                    $sql = "SELECT * FROM users WHERE email = '$email'";
                                    $results = $dbConn->query($sql)
                                        or die ('Problem with query: ' . $dbConn->error);     

                                    if ($results->num_rows != 0) 
                                    {
                                        echo "<p class=\"warning\">An account with this email already exists.</p>";
                                    } 
                                    else 
                                    {
                                        $hashPassword = hash('sha256', $password);
                                        $date = date("Y-m-d H:i:s");
                                        $sql = "INSERT INTO users (first_name, last_name, email, mobile, password, is_admin, date_registered) VALUES ('$first_name', '$last_name','$email','$mobile','$hashPassword','0','$date');";
                                        $results = $dbConn->query($sql)
                                            or die ('Problem with query: ' . $dbConn->error);  
                                        echo "<p>Account has been created! You must login again.</p>";
                                        
                                        header("refresh:3; url=index.php");
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