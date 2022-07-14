<?php
require('../connect.php');
require('../verifyAuth.php');
$char = $_GET['q'];

$sql = "SELECT * FROM Money_Real WHERE Char_ID = $char";
$sql = mysqli_real_escape_string($con,$sql);
$result = $con->query($sql);

$out;
if($result->num_rows > 0)
{
  $row = mysqli_fetch_array($result);
  $out->cp = $row['CP'];
  $out->sp = $row['SP'];
  $out->ep = $row['EP'];
  $out->gp = $row['GP'];
  $out->pp = $row['PP'];
    //echo $row['Type'];
    /*switch($row['Type'])
    {
      case 'CP':
        $template = str_replace('[COPPER]',$row['Count'],$template);
        break;
      case 'SP':
        $template = str_replace('[SILVER]',$row['Count'],$template);
        break;
      case 'EP':
        $template = str_replace('[ELECTRUM]',$row['Count'],$template);
        break;
      case 'GP':
        $template = str_replace('[GOLD]',$row['Count'],$template);
        break;
      case 'PP':
        $template = str_replace('[PLAT]',$row['Count'],$template);
        break;
    }
    //echo $template;
  }*/

}
echo json_encode($out);
mysqli_close($con);
?>
