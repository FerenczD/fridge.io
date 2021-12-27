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
  storeItem($item, $quantity, $conn);
}else{
  increaseQuantity($item, $quantity, $conn);
  // echo "Exists";
}



function storeItem($item, $quantity, $conn){
  $inputDate = date('M d');
  /* Really I will look for date in DB */

  $sql = "SELECT time FROM expiration_times WHERE name = '$item'";
  $result = mysqli_query($conn, $sql);

  $row = mysqli_fetch_assoc($result);

  $expiryTime = $row['time'];

  $expiry = '+'.$expiryTime.' days';

  $expiry = date('M d', strtotime($expiry)); // Add 3 days for test

  /* Store item in inventory */
  $sql = "INSERT INTO inventory (item, quantity, input_date, expiry_date)
          VALUES ('$item', '$quantity', '$inputDate', '$expiry')";

  $result = mysqli_query($conn, $sql);

  echo json_encode($expiry);
}

function increaseQuantity($item, $quantity, $conn){

  $sql = "SELECT * FROM inventory WHERE item='$item'";
  $result = mysqli_query($conn, $sql);

  $row = mysqli_fetch_assoc($result);

  $storedQuantity = $row["quantity"];
  $storedExpiry = $row["expiry_date"];

  $quantity += $storedQuantity;

  $sql = "UPDATE inventory SET quantity = $quantity
          WHERE item='$item'";
  $result = mysqli_query($conn, $sql);

  echo json_encode($storedExpiry);


}


?>
