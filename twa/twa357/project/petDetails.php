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
        <title>Pet Page</title>
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
           $sql = "SELECT * FROM pets WHERE pet_id = $pet_id";
           $results = $dbConn->query($sql)
                or die ('Problem with query: ' . $dbConn->error); 
            $row = $results->fetch_assoc();

            $sql = "SELECT * FROM users WHERE user_id='$user_id'";
            $results = $dbConn->query($sql)
                or die ('Problem with query: ' . $dbConn->error); 
            $userRow = $results->fetch_assoc();
           ?>
            <section class="description">
                <section>
                    <h3><?php echo $row["name"];?></h3>
                    <p><?php echo $row["species"]?></p>
                    <img src="<?php  if(realpath($row["image_path"]))
                                    echo $row["image_path"];
                                else
                                    echo "images/no_image_available.png";?>">
                    <p><?php echo $row["age"]?> Year Old <?php echo $row["gender"]?> <?php echo $row["breed"]?></p>
                    <h3>About Me</h3>
                    <p><?php echo $row["description"]?></p><br>
                    <p><?php echo $row["status"]?></p>
                    <p><?php echo $row["suburb"]?> <?php echo $row["state"]?></p>
                    <p>ADOPTION FEE: <?php echo $row["fee"]?></p>
                    <p><?php echo $row["date_added"]?></p>
                </section>

                <section class="adoptionForm">
                    <?php if ($login ==true) { ?>
                    <form class ="adoptionForm" method="post" onsubmit="return validate(this);">
                        <h3>Adopt Me!</h3>
                        <section>
                            <label for="firstName">First Name </label>
                            <input type="text" name="firstName" id="firstName" size="20" value="<?php echo $userRow["first_name"];?>"><p class="required">*</p>
                    </section>
                    <section>
                            <label for="lastName">Last Name </label>
                            <input type="text" name="lastName" id="lastName"size="20" value="<?php echo $userRow["last_name"];?>"><p class="required">*</p>
                    </section>
                    <section>
                        <label for="email">Email </label>
                        <input type="text" name="email" id="email"size="20" value="<?php echo $userRow["email"];?>"><p class="required">*</p>
                    </section>
                    <section>
                        <label for="phone">Phone Number </label>
                        <input type="number" name="phone" id="phone"size="20" value="<?php echo $userRow["mobile"];?>"><p class="required">*</p>
                    </section>
                    <section>
                        <label for="application_notes">Give us a reason </label><p class="required">*</p>
                    </section>
                        <textarea name="application_notes" id="application_notes" rows="10" cols="80" placeholder="Be convincing!"></textarea>
                        <section>
                            <br><input type="submit">
                        </section>
                        <p id="formError" style="color:red; display:none;">All fields must not be empty.</p>
                        <p id="formPass" style="display: none;">Form submitted!</p>
                    </form>
                    <?php }
                    else
                    { ?>
                    <h4>You must sign up or login to adopt this animal.</h4>
                    <?php }
                    ?>
                </section>  
            </section>
        </main>  
        <footer>
            <p>Western Sydney University<br><br>By 20732093 Arnold Quiocho<br>Technologies for Web Applications<br>Copyright 2023 (not really).</p>
        </footer>
    </body>
</html>

<?php
require_once("dbconn.php");
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $firstName = $dbConn->escape_string($_POST['firstName']);
    $lastName = $dbConn->escape_string($_POST['lastName']);
    $email = $dbConn->escape_string($_POST['email']);
    $phone = $dbConn->escape_string($_POST['phone']);
    $number = $dbConn->escape_string($_POST['number']);
    $application_notes = $dbConn->escape_string($_POST['application_notes']); 

    $sql = "INSERT INTO adoptions (pet_id, user_id, application_notes)
    VALUES  ('$pet_id','$user_id','$application_notes')";
    $results = $dbConn->query($sql)
        or die ('Problem with query: ' . $dbConn->error);     
        
}
$dbConn->close();
?>