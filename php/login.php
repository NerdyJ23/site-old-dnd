<?php

$user = $_POST['username'];
$pass = $_POST['password'];

require('connect.php');
$sql = "SELECT id,username,password FROM Users WHERE username = '$user'"; // AND password = '$pass'
$result = $con->query($sql);
if($result->num_rows > 0)//if there's actually a match
{
  $row = mysqli_fetch_array($result);
  $hash = trim($row['password']); //trim is REQUIRED here
  if(password_verify($pass,$hash))
  {
    session_start();
    $_SESSION['user'] = $user;
    $_SESSION['id'] = $row['id'];
    $sql = 'UPDATE Users SET Last_Logged_In = CURRENT_TIME() WHERE ID = '.$row['id'];
    //$_SESSION['err'] .= $sql."\n";
    $result = $con->query($sql);
    if($result!=1)
    {
      $_SESSION['err'] .= 'Timestamp update failed.';
    }
    //echo "User: $user";
  }
  else
  {
    session_start();
      $_SESSION['err'] = "Username or password incorrect";
      //echo $_SESSION['err'];
      header('Location: /login.php');
      exit();
  }
}
$next = $_SESSION['ref_url'];
unset($_SESSION['ref_url']);
header('Location: '. $next);
?>
