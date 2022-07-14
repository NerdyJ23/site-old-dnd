<?php
require('../connect.php');

$char = $_POST['q'];
//$data = $_POST['data'];
$name = $_POST['name'];
echo print_r($_POST);
session_start();
$name = mysqli_real_escape_string($con,$name);
$race = mysqli_real_escape_string($con,$_POST['race']);
$exp = mysqli_real_escape_string($con, $_POST['exp']);
$vis = mysqli_real_escape_string($con, $_POST['vis']);
$sql = "UPDATE `Characters` SET Name = '$name', Race = '$race', Exp = $exp, Visibility = $vis  WHERE ID = $char";
$result = $con->query($sql);

/*$sql = "UPDATE `Characters` SET Race = '$race' WHERE ID = $char";
$result = $con->query($sql);*/
$classlist = explode(",",mysqli_real_escape_string($con,$_POST['class']));
$sql = "DELETE FROM `Class` WHERE Char_ID = $char";
$result = $con->query($sql);
foreach($classlist as $class)
{
  $tmp = explode('-',$class);
  //echo trim($tmp[0]) . ' ' . trim($tmp[1]);

  $sql = "INSERT INTO `Class` (`Char_ID`,`Class`,`Level`) VALUES ($char,'".trim($tmp[0])."','".trim($tmp[1])."')";
  $con->query($sql);

}
$str = mysqli_real_escape_string($con,$_POST['str']);
$dex = mysqli_real_escape_string($con,$_POST['dex']);
$const = mysqli_real_escape_string($con,$_POST['con']);
$int = mysqli_real_escape_string($con,$_POST['int']);
$wis = mysqli_real_escape_string($con,$_POST['wis']);
$cha = mysqli_real_escape_string($con, $_POST['cha']);

$max_hp = mysqli_real_escape_string($con, $_POST['max_hp']);

$sql = "Update `Stats` SET Strength = $str, Dexterity = $dex, Constitution = $const, Intelligence = $int, Wisdom = $wis, Charisma = $cha, Max_HP = $max_hp, Current_HP = $max_hp WHERE Char_ID = $char";

$result = $con->query($sql);

updateProfs($char);

$cp = mysqli_real_escape_string($con,$_POST['cp']);
$sp = mysqli_real_escape_string($con,$_POST['sp']);
$ep = mysqli_real_escape_string($con,$_POST['ep']);
$gp = mysqli_real_escape_string($con,$_POST['gp']);
$pp = mysqli_real_escape_string($con,$_POST['pp']);

$sql = "UPDATE `Money_Real` SET CP = $cp, SP = $sp, EP = $ep, GP = $gp, PP = $pp WHERE Char_ID = $char";
$result = $con->query($sql);
//echo $sql;
if($result != 1)
{
  echo 'Failed to update money';
}
function updateProfs($char)
{
  require('../connect.php');
  for($i = 1; $i <= 24; $i++)
  {

    if(isset($_POST[$i.'_prof_edit']))
    {
      $_POST[$i.'_prof_edit'] = 1;
    }
    else
    {
      $_POST[$i.'_prof_edit'] = 0;
    }
    $sql = "UPDATE `Abilities` SET Proficient = ". $_POST[$i.'_prof_edit'] . " WHERE Char_ID = $char AND Fk_Prof = $i";
    $result = $con->query($sql);
    //echo $sql."\n";
    if($result != 1)
    {
      echo "Error updating stat #$i\n";
    }
  }

}
//echo "$sql";
//$_SESSION['data'] = $data;
//echo $name;

//echo $data;



?>
