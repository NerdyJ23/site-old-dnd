<?php
require('../connect.php');
require('../verifyAuth.php');
$char = $_GET['q'];
function calclevel($charID,$con)
{
  $sql = "SELECT * FROM `Class` WHERE Char_ID = $charID";
  $sql = mysqli_real_escape_string($con,$sql);
  $result = $con->query($sql);

  $level = 0;
  if($result->num_rows > 0)
  {
    while($row = mysqli_fetch_array($result))
    {
      $level += $row['Level'];
    }
  }
  return $level;
}

$sql = "SELECT * FROM `Abilities` WHERE Char_ID =$char ORDER BY Fk_Prof ASC";
$sql = mysqli_real_escape_string($con,$sql);
$result = $con->query($sql);

$bag = [];
//$prof = [];
$out;
$out->level=calcLevel($char,$con);

if($result->num_rows > 0)
{
  while($row = mysqli_fetch_array($result))
  {
    $tmp = array($row['Fk_Prof'],$row['Proficient']);
    //$bag['id'][] = ;
    $bag[] = $tmp;
    //$bag['prof'][] = ;
    //$prof[] = ;
  }
}
$out->abilities = $bag;
//$out->prof = $bag;
echo json_encode($out);
?>
