<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Week 8 Exercise 1</title>
        <link rel="stylesheet" href=" ../css/week10Styles.css">
    </head>
    <body>
    <?php
        require_once("conn.php");
        $sql = "SELECT * FROM product"; 
        $results = $dbConn->query($sql)
            or die ('Problem with query: ' . $dbConn->error);
    ?>
    <h1>Product table</h1>
    <table>
        <tr>
            <th>Product Code</th>z
            <th>Name </th>
            <th>Quantity In Stock</th>
            <th>Price</th>
        </tr>
    <?php
    while ($row = $results->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row["productCode"]?></td>
            <td><?php echo $row["name"]?></td>
            <!-- output the other fields here from the $row array -->
        </tr>
     <?php }
        $dbConn->close(); ?>
    </table>
</body>
</html>
