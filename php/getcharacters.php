<?php
//private
function showchars($name,$vis,$all)
{
  $explist= array(0,300,900,2700,6500,14000,23000,34000,48000,64000,85000,100000,120000,140000,165000,195000,225000,265000,305000,335000);
  require('connect.php');
  $level = 0;
  $sql = "";
  if($all == 0)
  {
    $sql = 'SELECT * FROM `Characters` WHERE User_Access =' . $_SESSION['id'] . ' AND Visibility = '.$vis . ' ORDER BY ID DESC';
  }
  else
  {
    $sql = 'SELECT * FROM `Characters` WHERE Visibility = '.$vis . ' ORDER BY ID DESC LIMIT 10';
  }
  $result = $con->query($sql);
  echo "<div class='char-preview'><h2>$name</h2>";
  if($result->num_rows > 0)
  {
    $i = 0;
    while($row = mysqli_fetch_array($result))
    {
      $level = 0;
      $sql2 = 'SELECT * FROM `Class` WHERE Char_ID =' . $row['ID'];
      $newresult = $con->query($sql2);

      if($i % 2 == 0)
      {
        //echo "</tr><tr>";
      }
      echo "<a href='/char.php?q=" .$row['ID']."'><char><div class='right'><h3>" . $row['Name'] . "</h3>";
      echo "<p>".$row['Race']."</p>";
      $classout = "";
      while($class = mysqli_fetch_array($newresult))
      {
        $level += $class['Level'];
        $classout .= $class['Class'] . ' - ' . $class['Level'] . ', ';
      }
      //echo $classout;
      $classout = rtrim(trim($classout),',');
      echo "<p class='class'>" .$classout ."</p>";
      $width = $row['Exp'] / $explist[$level] * 100;
      echo "<div id='expcontainer'><exp style='width:$width%'>".$row['Exp']."/".$explist[$level]."</exp></div></div>";
      echo "<div class='left'><img class='icon' src='" . $row['portrait_url'] . "' '/> </div>";
      echo "</char></a>";
      $i++;
    }
  }
  else
  {
    echo "Nothing found!";
  }
  //echo "</tr></table>";
  echo "</div>";
}
 ?>
