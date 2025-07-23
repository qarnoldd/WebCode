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
        <title>Manage Listings</title>
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
            <h3 class="smallTitle">Manage Pet Listings</h3>
            <p class="smallTitle">Click on the pet's icon to manage their listing.</p>
            <section class="selection">
                <a href="newListing.php">Create a new listing</a>
            </section>
            <section class="display">
                <section class="rescues">
                    <?php 
                    require_once("dbconn.php");

                    $sql = "SELECT * FROM pets";
                    $results = $dbConn->query($sql)
                        or die ('Problem with query: ' . $dbConn->error);


                    while($petRow = $results->fetch_assoc())
                    { 
                        ?>
                    <a href="manageListing.php?pet_id=<?php echo $petRow['pet_id']; ?>"><section class="rescueBox">
                        <img src="<?php 
                        if(realpath("images/" . $petRow["image"]))
                            echo "images/" . $petRow["image"];
                        else
                            echo "images/no_image_available.png";
                        ?>">
                        <h4><?php echo $petRow["name"];?></h4>
                        <h5><?php echo $petRow["suburb"]?> <?php echo $petRow["state"];?></h5>
                    </section></a>
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