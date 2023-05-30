<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <style>
      input[type="text"] {border: 1px solid black;}
    </style>
    <link rel="stylesheet" href="../css/week10Styles.css">
    <title>Week 10 Exercise 4 Form</title>
  </head>
  <body>
    <form id="exercise4Form" method="post">
      <h1>Quantity in Stock</h1>
      <p>Please enter the quantity to check against stock levels</p>
      <p>
          <label for="quantity">Quantity: </label>
          <input type="text" name="quantity" size="10" id="quantity" maxlength="6">
      </p>
      <p><input type="submit" name="submit"></p>
    </form>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $quantity = $_POST['quantity'];
        if(is_numeric($quantity))
        {
        require_once("conn.php");
        $sql = "SELECT productCode, name, quantityInStock, price FROM product WHERE quantityInStock > $quantity ORDER BY quantityInStock ASC"; 
        $results = $dbConn->query($sql)
            or die ('Problem with query: ' . $dbConn->error);
    ?>

    <?php if ($results->num_rows > 0) {?>
    <h1>Products with stock > <?php echo "$quantity"; ?> </h1>
    <table>
        <tr>

            <th>Name </th>
            <th>Quantity In Stock</th>
            <th>Price</th>
        </tr>
    <?php 
    while ($row = $results->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row["productCode"]?></td>
            <td><?php echo $row["name"]?></td>
            <td><?php echo $row["quantityInStock"]?></td>
            <td><?php echo $row["price"]?></td>
            <!-- output the other fields here from the $row array -->
        </tr>
        <?php } ?>
        </table>
        <?php } else { ?>
            <p>There are no products that have more than <?php echo $quantity ?> in stock.</p>
       <?php } 
        $dbConn->close(); 
        }
        else { ?>
         <p>Please input a number.</p>
        <?php }
        }?>
</body>
</html>
