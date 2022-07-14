<?php
session_start();
if(isset($_SESSION['user']))
{
  header('Location: /profile.php');
}
$_SESSION['ref_url'] = $_SERVER['HTTP_REFERER'];
include_once('template/header.html');
include_once('template/navbar.php');
 ?>
 <title>Login</title>
<h1>Login</h1>
 <div class='login'>
   <?php echo "<err>" . $_SESSION['err'] . "</err>"; unset($_SESSION['err']); ?>
   <form action="/php/login.php" method="POST">
     <div><label for="username">Username: </label> </div><input type="text" name="username" value="" id="username" required autofocus><br></div>
     <div><label for="password">Password: </label></div> <input type="password" name="password" value="" placeholder="**********" id="password" required><br></div>
     <input type="submit" value="Login">
   </form>
 </div>
