<?php

include 'db.init.php';

$conn = OpenCon();

// Get variables
// $item = 'Apple';
// $quantity = 1;
$item = $_POST['item'];
$quantity =  $_POST['quantity'];

/* Chek if there are equal items on fridge already */
$sql = "SELECT * FROM inventory WHERE item='$item'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0){
  echo "No item";
  exit();
}

$row = mysqli_fetch_assoc($result);

$currentQuantity = $row['quantity'];

$currentQuantity -= $quantity;

if ($currentQuantity > 0){
  $sql = "UPDATE inventory SET quantity = $currentQuantity
          WHERE item='$item'";
  $result = mysqli_query($conn, $sql);

  echo "True";
}else{
  $sql = "DELETE FROM inventory WHERE item = '$item'";
  $result = mysqli_query($conn, $sql);

  echo "False";
}

?>
