<?php
require('../connect.php');
require('../verifyAuth.php');
$char = $_GET['q'];
function getInfo($charID,$con)
{
  $sql = "SELECT * FROM `Characters` WHERE ID = $charID";
  $sql = mysqli_real_escape_string($con,$sql);
  return $con->query($sql);
}
function getClass($charID,$con)
{
  $sql = "SELECT * FROM `Class` WHERE Char_ID = $charID";
  $sql = mysqli_real_escape_string($con,$sql);
  return $con->query($sql);
}
function getStats($charID,$con)
{
  $sql = "SELECT * FROM `Stats` WHERE Char_ID = $charID";
  $sql = mysqli_real_escape_string($con,$sql);
  return $con->query($sql);
}
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
$info = getInfo($char,$con);
$output;
if($info->num_rows > 0)
{
  $info = mysqli_fetch_array($info);
  $class = getClass($char,$con);
  $output->name=$info['Name'];
  $output->vis=$info['Visibility'];
  //echo "<div class='portrait'>
  //<h1>".$info['Name']."</h1>
  //<h3>";

  $classout = "";
  while($row = mysqli_fetch_array($class))
  {
    $classout .= $row['Class'] . ' - ' . $row['Level'] . ', ';
  }
  $classout = rtrim(trim($classout),',');
  $output->class=$classout;
  $output->race=$info['Race'];
  $output->img_url=$info['portrait_url'];
  //echo $classout . "<br>" . $info['Race']."</h3>";
  //echo "<img src='" . $info['portrait_url'] ."' id='profile-pic' />
  //</div>";
}

$stats = getStats($char,$con);
if($stats->num_rows > 0)
{
  $hparr = mysqli_fetch_array($stats);
  $output->hp = $hparr['Current_HP'];
  $output->max = $hparr['Max_HP'];
  $output->hpwidth = $output->hp/$output->max*100;
  //echo "<div id='hpcontainer'><div id='fade' style='width:$width%;'><hp style='background-color:rgba(57,210,81," . $width/100 .")'><span id='curr_hp'>$hp</span>/<span id='max_hp'>$max</span></hp></div></div>";
  //Exp bar
  $explist= array(300,900,2700,6500,14000,23000,34000,48000,64000,85000,100000,120000,140000,165000,195000,225000,265000,305000,335000,335000);
  $output->level = calclevel($char,$con);
  $output->expwidth = $info['Exp'] / $explist[$output->level-1]*100;
  $output->exp = $info['Exp'];
  $output->exp_next = $explist[$output->level-1];
  //echo "<div id='expcontainer'><exp style='width:$xpwidth%'><span id='xpval'>" . $info['Exp'] . "/".$explist[$level]."</span></exp></div>";


}

echo json_encode($output);
mysqli_close($con);
?>
