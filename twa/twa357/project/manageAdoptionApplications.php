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
        <title>Manage Adoption Applications</title>
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
            <h3 class="smallTitle">Manage Adoption Applications</h3>
            <section class="display">
                <section class="rescues">
                    <?php 
                    require_once("dbconn.php");

                    $sql ="SELECT * FROM adoptions";
                    $applicationResults = $dbConn->query($sql)
                        or die ('Problem with query: ' . $dbConn->error); 

                    while($applications = $applicationResults->fetch_assoc())
                    { 
                        $sql = "SELECT * FROM pets WHERE pet_id = ".$applications["pet_id"];
                        $results = $dbConn->query($sql)
                            or die ('Problem with query: ' . $dbConn->error);
                        $petRow = $results->fetch_assoc();
                        $sql = "SELECT * FROM users WHERE user_id = ".$applications["user_id"];
                        $results = $dbConn->query($sql)
                            or die ('Problem with query: ' . $dbConn->error); 
                        $userRow = $results->fetch_assoc();
                        ?>
                    <section class="rescueBox">
                        <img src="<?php 
                        if(realpath("images/" . $petRow["image"]))
                            echo "images/" . $petRow["image"];
                        else
                            echo "images/no_image_available.png";
                        ?>">
                        <h4><?php echo $petRow["name"];?></h4>
                        <h5><?php echo $petRow["suburb"]?> <?php echo $petRow["state"];?></h5>
                        <h5>Application Status: <?php echo $applications["application_status"];?></h5>
                        <h5>Requested by: <?php echo $userRow["first_name"]." ". $userRow["last_name"];?></h5>
                        <h5>Application Date: <?php echo $applications["application_date"];?></h5>
                        <h5>Application Notes:</h5>
                        <p><?php echo $applications["application_notes"];?></p>
                        <?php if($applications["adoption_date"] != NULL) {?>
                        <h5>Date Adopted: <?php $applications["adoption_date"];?></h5>
                        <?php } ?> 
                        <form method="post" action="updateForm.php" id="manageAdoption" name="manageAdoption">
                        </select>
                            <input type="hidden" name="application_id" value="<?php echo $applications["application_id"]; ?>">
                            <button type="submit" name="accept">Accept</button>
                            <button type="submit" name="reject">Reject</button>
                        </form>
                    </section>
                        <?php } 
                        if($results->num_rows == 0)
                            echo "<br>No results found.";
                    $dbConn->close();
                    ?>
                </section>
            </section>

            </section>
        </main>  
        <footer>
            <p>Western Sydney University<br><br>By 20732093 Arnold Quiocho<br>Technologies for Web Applications<br>Copyright 2023 (not really).</p>
        </footer>
    </body>
</html>