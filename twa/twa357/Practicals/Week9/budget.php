    <!DOCdescription html>
        <html lang="en">
            <head>
                <meta charset="utf-8">
                <title>Week 9 Exercise 2</title>
            </head>
            <body>
                <?php
                    //obtain the firstname input from the $_GET array
                    $month = $_GET["month"];
                    $year = $_GET["year"];
                    $totalIncome = 0;
                    $totalExpense = 0;
                    $total;
                
                    function printRow(int $current)
                    {
                        $amount = $_GET["amount"][$current];
                        if(strlen($amount) > 0)
                        {
                            $description = $_GET["description"][$current];
                            echo "<p> • " . $description . " $ " . $amount . "</p>";
                        }
                    }

                ?>
                <?php 
                for ($i = 0; $i < 5; $i++)
                {
                    $amount = $_GET["amount"][$i];
                    if(strlen($amount) > 0)
                    {
                        $totalIncome += floatval($amount);
                    }
                }

                for ($i = 5; $i < 10; $i++)
                {
                    $amount = $_GET["amount"][$i];
                    if(strlen($amount) > 0)
                    {
                        $totalExpense += floatval($amount);
                    }
                }

                $total = $totalIncome - $totalExpense;

                ?>
                <p>For the month of <?php echo "$month"; ?> <?php echo "$year"; ?>, I saved <?php echo number_format(100 * ($total/$totalIncome),2) ?>% (<?php echo $total; ?>) of my total income (<?php echo "$totalIncome"; ?>). 
                To reach my 25% savings goal I should have spent <?php echo number_format($totalIncome * 0.25 - $total,2); ?> less in <?php echo "$month"; ?>.</p>
                <p>My income sources were</p>
                
                <?php
                for ($i = 0; $i < 5; $i++)
                {
                    printRow($i);
                }
                ?><br>

                <p>My expenses were</p>
                
                <?php
                for ($i = 5; $i < 10; $i++)
                {
                    printRow($i);
                }
                ?><br>

            </body>
        </html>