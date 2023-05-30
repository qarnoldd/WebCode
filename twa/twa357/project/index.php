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
        <title>Annie's Animal Adoptions</title>
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
            <section class="banner" id="indexBanner">
                    <section class="bannerText">
                    <h2>WE RESCUE FAMILY.</h2>
                </section>
            </section>

            <section class="selection">
                <a href="petListings.php">Pet Listings</a>
                <a href="registrationPage.php">Register</a>
                <a href="login.php">Login</a>
            </section>
            
            <section class="innerSection">
                <h3>Who are we?</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse egestas finibus sem, consectetur sodales velit iaculis in. Etiam pellentesque blandit nulla quis fermentum. Maecenas et mollis justo, ac faucibus orci. Proin feugiat dolor eget elementum imperdiet.</p>
                <h3>What is our mission?</h3>
                <p>Nam a nisl vel tortor accumsan congue. Quisque et felis lacinia, posuere diam ut, auctor justo. Nullam pretium pellentesque tellus, non pulvinar turpis pulvinar in. Phasellus eget nibh sed odio ultrices cursus et eu felis. Donec tincidunt nisi in metus faucibus tincidunt. Suspendisse tincidunt ipsum in iaculis fermentum. Pellentesque eget mi eu erat porta dictum.</p>
                <h3>How can you help?</h3>
                <p>Nulla ac sodales arcu. Nulla et varius felis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi a nulla vitae massa eleifend ultrices non in lectus. Mauris felis dui, hendrerit ut lobortis id, euismod sed libero. Donec et massa ac nisi pellentesque dignissim. Curabitur sed tincidunt leo, id consequat metus. In varius aliquam tellus nec rutrum. Mauris nec luctus sapien. Maecenas non nunc ante.</p>
            </section>
            <section class="display">
                <h3>Here are some of our rescues</h3> <!-- randomly select 4 pets to display with basic info -->
                    <section class="rescues">
                        <?php 
                        require_once("dbconn.php");
                        $sql = "SELECT * 
                            FROM pets 
                            WHERE image_path IS NOT NULL
                            AND name IS NOT NULL
                            AND age IS NOT NULL
                            AND breed IS NOT NULL
                            AND description IS NOT NULL
                            AND status IS NOT NULL
                            AND suburb IS NOT NULL
                            AND state IS NOT NULL
                            ORDER BY RAND() LIMIT 6"; 
                        $results = $dbConn->query($sql)
                            or die ('Problem with query: ' . $dbConn->error);                        

                        while($row = $results->fetch_assoc())
                        { ?>
                        <a><section class="rescueBox">
                            <img src="<?php 
                            if(realpath($row["image_path"]))
                                echo $row["image_path"];
                            else
                                echo "images/no_image_available.png";
                            ?>">
                            <h4><?php echo $row["name"]?></h4>
                            <h5><?php echo $row["suburb"]?> <?php echo $row["state"]?></h5>
                        </section>
                            <?php } ?>
                        <?php
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