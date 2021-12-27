<?php
include 'db.init.php';

$conn = OpenCon();

// Get variables
// $item = 'Apple';
// $quantity = 1;
// $inputDate = date('y-m-d');
//
// $expiry = date('y-m-d', strtotime("+3 days")); // Add 3 days for test

/* Chek if there are equal items on fridge already */
//$sql = "SELECT EXISTS(SELECT 1 FROM inventory WHERE item == ''$item')";

/* Retrieve items from fridge */
// $sql = "SELECT * FROM inventory";
$sql = "SELECT inventory.item , inventory.quantity , inventory.input_date ,
        inventory.expiry_date, expiration_times.time FROM inventory
        INNER JOIN expiration_times ON inventory.item = expiration_times.name";
$result = mysqli_query($conn, $sql);

/* Is fridge empty? */
if (mysqli_num_rows($result) == 0){
  echo "Fridge is empty";
}
else {

  $itemArray = array();
  $index = 0;

  while($row =  mysqli_fetch_object($result)){
    $itemArray[$index] = $row;
    $index++;
  }

  /* Return object as json */
  echo json_encode($itemArray);
}

?>
