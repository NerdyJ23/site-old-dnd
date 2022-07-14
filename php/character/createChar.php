<?php
require('../connect.php');
session_start();
$name = mysqli_real_escape_string($con,$_POST['name']);
$class = mysqli_real_escape_string($con,$_POST['class']);
$race = mysqli_real_escape_string($con,$_POST['race']);
$max_hp = mysqli_real_escape_string($con,$_POST['max_hp']);
$id = $_SESSION['id'];

$str = mysqli_real_escape_string($con,$_POST['str']);
$dex = mysqli_real_escape_string($con,$_POST['dex']);
$cons = mysqli_real_escape_string($con,$_POST['con']);
$int = mysqli_real_escape_string($con,$_POST['int']);
$wis = mysqli_real_escape_string($con,$_POST['wis']);
$cha = mysqli_real_escape_string($con,$_POST['cha']);

$sql = "INSERT INTO `Characters` (Name,Race,User_Access) VALUES('$name','$race',$id)";
$result = $con->query($sql);

if($result != 1)
{
  //$_SESSION['err'] =
  echo "Failed to create character\n$sql";
  die();
}
$newid = mysqli_insert_id($con);
echo "ID: $newid";

$sql = "INSERT INTO `Stats` (Char_ID,Strength,Dexterity,Constitution,Intelligence,Wisdom,Charisma,Max_HP,Current_HP) VALUES($newid,$str,$dex,$cons,$int,$wis,$cha,$max_hp,$max_hp)";
$result = $con->query($sql);

if($result != 1)
{
  //$_SESSION['err'] =
  echo "Failed to create stats\n$sql";
  die();
}

$classlist = explode(',',$class);
foreach($classlist as $c)
{
  $tmp = explode('-',$c);

  $sql = "INSERT INTO `Class` (Char_ID,Class,Level) VALUES('$newid', '".trim($tmp[0])."','".trim($tmp[1])."')";
  $result = $con->query($sql);

  if($result != 1)
  {
    echo "Error inserting class\n$sql";
  }

}
require('genProf.php');
require('genWallet.php');
 ?>
