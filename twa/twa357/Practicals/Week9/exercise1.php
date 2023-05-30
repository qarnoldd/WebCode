<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <title>Week 9 Exercise 1</title>
        </head>
        <body>
            <?php
                //obtain the firstname input from the $_GET array
                $namestr = $_GET["firstname"];
                //obtain the values for the other input devices here
                $email = $_GET["email"];
                $addr = $_GET["postaddr"];
                $sport = $_GET["favsport"];
                $emaillist = $_GET["emaillist"];
				if(!$emaillist)
				{
					$emaillist = "No";
				}
                

            ?>
            <p>The following information was received from the form:</p>
            <p><strong>name = </strong> <?php echo "$namestr"; ?></p>
            <p><strong>email = </strong> <?php echo "$email"; ?></p>
            <p><strong>addr = </strong> <?php echo "$addr"; ?></p>
            <p><strong>sport = </strong> <?php echo "$sport"; ?></p>
            <p><strong>mailing list selected = </strong> <?php echo "$emaillist"; ?></p>
            <!--output the other form inputs here -->
        </body>
    </html>