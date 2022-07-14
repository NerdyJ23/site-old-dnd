<?php
require('../connect.php');
require('../verifyAuth.php');
$char = $_GET['q'];


$sql = "SELECT * FROM `Equipment` WHERE Char_ID =$char ORDER BY Weight DESC";
$sql = mysqli_real_escape_string($con,$sql);
$result = $con->query($sql);
$out = [];
if($result->num_rows > 0)
{
  //$bag = [];
  //$out = $sql;
  while($row = mysqli_fetch_assoc($result))
  {
    $temp;
    $temp->count = $row['Count'];
    $temp->name = $row['Name'];
    $temp->value = $row['Value'];
    $temp->value_type = $row['Value_Type'];
    $temp->weight = $row['Weight'];
    $out[] = clone $temp;
    //echo "<tr><td>". $row['Count'] . "x </td><td>" .$row['Name']."</td><td> " . $row['Value'] . " " . $row['Value_Type'] . " </td><td> " . $row['Weight'] . "lb </td></tr>";
  }
  //$out->inv=$bag;
}
echo json_encode($out);
?>
