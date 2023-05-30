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
        <title>Form Updated</title>
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
                    <img src="images/LOGO.png" id="logo"></img>
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
                <h3>Form has been updated.</h3>
                <p>You will now return back</p>
                <?php
                require_once("dbconn.php");
                
                if ($_SERVER['REQUEST_METHOD'] == 'POST') 
                {
                    if (isset($_POST['accept'])) 
                    {
                        $date = date("Y-m-d H:i:s");
                        $application_id = $_POST['application_id'];
                        $sql = "UPDATE adoptions SET application_status = 'Approved', adoption_date = '$date' WHERE application_id = $application_id";
                        $result = $dbConn->query($sql)
                            or die ('Problem with query: ' . $dbConn->error); 
                    } 
                    else if (isset($_POST['reject'])) 
                    {
                        $application_id = $_POST['application_id'];
                        $sql = "UPDATE adoptions SET application_status = 'Rejected' WHERE application_id = $application_id";
                        $result = $dbConn->query($sql)
                            or die ('Problem with query: ' . $dbConn->error); 
                    }
                }
                header("refresh:3; url=manageAdoptionApplications.php");
                $dbConn->close();?>
            </section>
        </main>  
        <footer>
            <p>Western Sydney University<br><br>By 20732093 Arnold Quiocho<br>Technologies for Web Applications<br>Copyright 2023 (not really).</p>
        </footer>
    </body>
</html>