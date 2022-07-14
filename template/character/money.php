<?php

$sql = "SELECT * FROM Money WHERE Char_ID = $char";
$sql = mysqli_real_escape_string($con,$sql);
$result = $con->query($sql);

//$template = file_get_contents('template/character/money.html');
$out
if($result->num_rows > 0)
{
  while($row = mysqli_fetch_array($result))
  {
    //echo $row['Type'];
    switch($row['Type'])
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
  }

}
$template = str_replace('[COPPER]','0',$template);
$template = str_replace('[SILVER]','0',$template);
$template = str_replace('[ELECTRUM]','0',$template);
$template = str_replace('[GOLD]','0',$template);
$template = str_replace('[PLAT]','0',$template);

echo $template;
 ?>
