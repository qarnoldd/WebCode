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
        <title>Animal Listings</title>
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
            <section class="banner" id="searchBanner">
                    <section class="bannerText">
                    <h2>FIND YOUR NEW BUDDY</h2>
                </section>
            </section>
            <section class="searchBar">
                <form id="search" method="post">
                    <label for="name">Name: </label>
                    <input type = "text" name="name" id="name">
                
                    <label for ="species">Species: </label>
                    <input type ="checkbox" name="species[]" id="dog" value="Dog"><label for = "dog">Dog</label>
                    <input type ="checkbox" name="species[]" id="cat" value="Cat"><label for = "cat">Cat</label>
                    <input type ="checkbox" name="species[]" id="bird" value="Bird"><label for = "bird">Bird</label>
                    <input type ="checkbox" name="species[]" id="horse" value="Horse"><label for = "horse">Horse</label>
                    <input type ="checkbox" name="species[]" id="rabbit" value="Rabbit"><label for = "rabbit">Rabbit</label>
                    
                    <label for="status">Adoption Status: </label>
                    <select name="status" size="1">
                        <option value="both">Both</option>
                        <option value="Available">Available</option>
                        <option value="Adoption Pending">Pending</option>
                    </select>

                    <label for="state">State: </label>
                    <select name="state" size="1">
                        <option value="none"> None </option>
                        <option value="NSW">New South Wales</option>
                        <option value="VIC">Victoria</option>
                        <option value="QLD">Queensland</option>
                        <option value="ACT">Australian Capital Territory</option>
                    </select>

                    <input type="submit" name ="submit">
                </form>
            </section>
            <section class="display">
                    <section class="rescues">
                        <?php 
                        require_once("dbconn.php");
                        
                        $name = isset($_POST['name']) ? $dbConn->escape_string($_POST['name']) : '';
                        $species = isset($_POST['species']) ? $_POST['species'] : array();
                        $status = isset($_POST['status']) ? $dbConn->escape_string($_POST['status']) : 'both';
                        $state = isset($_POST['state']) ? $dbConn->escape_string($_POST['state']) : 'none';

                        if (empty($name) && empty($species) && $status == 'both' && $state == 'none') {
                            $sql = "SELECT * FROM pets";
                        } else {
                            $conditions = array();
                
                            if (!empty($name)) {
                                $conditions[] = "name LIKE '%$name%'";
                            }
                
                            if (!empty($species)) {
                                $species = implode("', '", $species);
                                $conditions[] = "species IN ('$species')";
                            }
                
                            if ($status != 'both') {
                                $conditions[] = "status = '$status'";
                            }

                            if ($state != 'none') {
                                $conditions[] = "state = '$state'";
                            }
                
                            $conditions = implode(" AND ", $conditions);
                            $sql = "SELECT * FROM pets WHERE $conditions";
                        }

                        $results = $dbConn->query($sql)
                            or die ('Problem with query: ' . $dbConn->error);                        
                        while($row = $results->fetch_assoc())
                        { ?>
                        <a href="petDetails.php?pet_id=<?php echo $row['pet_id']; ?>"><section class="rescueBox">
                            <img src="<?php 
                            if(realpath($row["image_path"]))
                                echo $row["image_path"];
                            else
                                echo "images/no_image_available.png";
                            ?>">
                            <h4><?php echo $row["name"]?></h4>
                            <h5><?php echo $row["suburb"]?> <?php echo $row["state"]?></h5>
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