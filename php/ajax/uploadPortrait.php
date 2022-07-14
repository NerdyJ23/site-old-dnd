<?php
//$sourcePath =print_r($_FILES);
//echo $sourcePath;
//echo print_r($_FILES);
require('../connect.php');

$char = mysqli_real_escape_string($con,$_POST['q']);

$base_dir = getenv("BASE_DIR");
$target_dir = getenv("TARGET_DIR");
if(!isset($_FILES['image']))
{
  exit();
}
$target_file = $base_dir . $target_dir . basename($_FILES['image']['name']);
$fileName = $char . '.'.strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$target_file = $base_dir . $target_dir . $fileName;
echo "Target: $target_file";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//print_r($_FILES);
//print_r($_POST);
if(isset($_POST['submit']))
{
}
$check = getimagesize($_FILES['image']['tmp_name']);
if($check !== false)
{
  echo "File is an image";
  $uploadOk = 1;
}
else
{
  echo "File is NOT an image";
  $uploadOk = 0;
}

if($_FILES['image']['size'] > 1500000)
{
  echo  "Sorry, your file is too large";
  $uploadOk = 0;
}
if($imageFileType != 'jpg' && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")
{
  echo "Sorry, only JPG, JPEG, PNG and GIF files are allowed";
  $uploadOk = 0;
}
echo $uploadOk;
if($uploadOk == 0)
{
  echo "Sorry, your file was not uploaded";
  //header('Location: ../error.php');
}
else
{
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file))
    {
      echo "The file " . $_FILES['image']['name'] . " has been uploaded";

      $location =  '/'.$target_dir . $fileName;

      $sql = "SELECT portrait_url FROM `Characters` WHERE ID = $char";
      $result = $con->query($sql);
      if($result->num_rows > 0)
      {
        $row = mysqli_fetch_array($result);
        /*if(!unlink($base_dir . $row['portrait_url']))
        {
          echo 'Error removing old file';
        }
        else
        {
            echo "Removed old file";
        }*/
      }

      $sql = "UPDATE `Characters` SET `portrait_url` = '$location' WHERE ID = $char";
      echo $sql;
      $result = $con->query($sql);

      if($result != 1)
      {
        echo 'Failed to update database url';
      }
      //$_POST['id'] = 'portrait_url';
      //$refer =  isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
      //header("Location: $refer");
      //echo "right before include";
      //echo "right after include";
    }
    else
    {
        echo "Sorry, there was an error in uploading your file";
    }
}
 ?>
