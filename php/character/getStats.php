<?php
require('../connect.php');
require('../verifyAuth.php');
$char = $_GET['q'];
function calcBonus($var)
{
  $out = 0;
  if($var == 1)
  {
    $out = -5;
  }
  else
  {
    $out = floor($var/2-5);
  }

  if($out >= 0)
  {
    $out = '+'.$out;
  }
  return $out;
}

$sql = "SELECT * FROM `Stats` WHERE Char_ID = $char";
$sql = mysqli_real_escape_string($con,$sql);
$stats = $con->query($sql);

$out;
if($stats->num_rows > 0)
{
  $row = mysqli_fetch_array($stats);

  $out->str_score = $row['Strength'];
  $out->str_bonus = calcBonus($row['Strength']);
  $out->dex_score = $row['Dexterity'];
  $out->dex_bonus = calcBonus($row['Dexterity']);
  $out->con_score = $row['Constitution'];
  $out->con_bonus = calcBonus($row['Constitution']);
  $out->int_score = $row['Intelligence'];
  $out->int_bonus = calcBonus($row['Intelligence']);
  $out->wis_score = $row['Wisdom'];
  $out->wis_bonus = calcBonus($row['Wisdom']);
  $out->cha_score = $row['Charisma'];
  $out->cha_bonus = calcBonus($row['Charisma']);

}

echo json_encode($out);
mysqli_close($con);
?>
