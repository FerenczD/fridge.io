<?php

include 'db.init.php';

$conn = OpenCon();

// Get variables
$item = 'Apple';
$quantity = 1;

// $item = $_POST['item'];
// $quantity =  $_POST['quantity'];

/* Chek if there are equal items on fridge already */
$timeStamp = date('Y-m-d H:i:s');

$sql = "UPDATE inventory SET using_item_flag = '$quantity' ,
        using_time_stamp = '$timeStamp' WHERE item = '$item'";
$result = mysqli_query($conn, $sql);

if (!$result){
  echo "No item";
  exit();
}

  echo "Item was retrieved temporarily";


?>
