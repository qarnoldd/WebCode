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
        <title>Manage Listing</title>
        <link href="css/master.css" type="text/css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mogra&family=Roboto+Slab&display=swap" rel="stylesheet">
        <script src="javascript/validation.js"></script>
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
           <?php
            $pet_id = $_GET['pet_id'];
            require_once("dbconn.php");
            $sql = "SELECT * FROM pets WHERE pet_id = '$pet_id'";
            $results = $dbConn->query($sql)
                or die ('Problem with query: ' . $dbConn->error); 
            $row = $results->fetch_assoc();
            ?>
            <section class="description">
                <form class="updateListingForm" method="post" onsubmit="return validateUpdate(this);">
                    <section>
                    <img src="<?php  if(realpath("images/" . $row["image"]))
    echo "images/" . $row["image"];
else
    echo "images/no_image_available.png";
?>">
                    </section>
                    <section>
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" value="<?php echo $row["name"]?>"><p class="required">*</p>
                    </section>
                    <section>
                    <label for="species">Species:</label>
                        <select name="species" size="1">
                            <option value="Dog" <?php if ($row["species"] === "Dog") echo "selected"; ?>>Dog</option>
                            <option value="Cat" <?php if ($row["species"] === "Cat") echo "selected"; ?>>Cat</option>
                            <option value="Bird" <?php if ($row["species"] === "Bird") echo "selected"; ?>>Bird</option>
                            <option value="Horse" <?php if ($row["species"] === "Horse") echo "selected"; ?>>Horse</option>
                            <option value="Rabbit" <?php if ($row["species"] === "Rabbit") echo "selected"; ?>>Rabbit</option>
                        </select>
                    </section>
                    <section>
                    <label for="age">Age: </label>
                    <input type="number" name="age" id="age" value="<?php echo $row["age"]?>"><p class="required">*</p>
                    </section>
                    <section>
                    <label for="gender">Gender: </label>
                    <select name="gender" size="1">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select><p class="required">*</p>
                    </section> 
                    <section>
                        <label for="breed">Breed: </label>
                        <input type="text" id="breed" value="<?php echo $row["breed"]?>" name="breed"><p class="required">*</p>
                    </section>
                    <section>
                    <label for="description">Description: </label><p class="required">*</p>
                    </section>
                    <section>
                    <textarea name="description" id="descriptionBox" rows="10"cols="100"><?php echo $row["description"]?></textarea>
                    </section>
                    <section>
                        <label for="suburb">Suburb: </label>
                        <input type="text" name="suburb" id="suburb" value="<?php echo $row["suburb"]?>"><p class="required">*</p>
                    </section>
                    <section>
                        <label for="state">State: </label>
                        <select name="state" id="state" value="<?php echo $row["state"]?>">
                            <option value="NSW" <?php if ($row["state"] === "NSW") echo "selected"; ?>>New South Wales</option>
                            <option value="VIC" <?php if ($row["state"] === "VIC") echo "selected"; ?>>Victoria</option>
                            <option value="QLD" <?php if ($row["state"] === "QLD") echo "selected"; ?>>Queensland</option>
                            <option value="ACT" <?php if ($row["state"] === "ACT") echo "selected"; ?>>Australian Capital Territory</option>
                        </select><p class="required">*</p>
                    </section>
                    <section>
                        <label for="fee">Fee: </label>
                        <input type="number" name="fee" id="fee" value="<?php echo $row["fee"]?>"><p class="required">*</p>
                    </section>
                    <section>
                        <input type="submit">
                    </section>
                    <p id="formError" style="color:red; display:none;">All fields must not be empty.</p>
                    <p id="formPass" style="display: none;">Details Updated!</p>
                </form>
            </section>  
        </main>  
        <footer>
            <p>Western Sydney University<br><br>By 20732093 Arnold Quiocho<br>Technologies for Web Applications<br>Copyright 2023 (not really).</p>
        </footer>
    </body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $dbConn->escape_string($_POST['name']);
    $species = $dbConn->escape_string($_POST['species']);
    $age = $dbConn->escape_string($_POST['age']);
    $gender = $dbConn->escape_string($_POST['gender']);
    $breed = $dbConn->escape_string($_POST['breed']);
    $description = $dbConn->escape_string($_POST['description']);
    $suburb = $dbConn->escape_string($_POST['suburb']);
    $state = $dbConn->escape_string($_POST['state']);
    $fee = $dbConn->escape_string($_POST['fee']);

    $sql = "UPDATE pets SET name='$name', species='$species', breed='$breed', age='$age', gender='$gender', description='$description', suburb='$suburb', state='$state', fee='$fee'
    WHERE pet_id = '$pet_id'";
    $results = $dbConn->query($sql)
        or die ('Problem with query: ' . $dbConn->error);     
}
$dbConn->close();
?>