<?php
session_start();
if(isset($_SESSION['user']))
{
  header('Location: /profile.php');
}
include_once('template/header.html');
include_once('template/navbar.php');
 ?>
 <title>Register</title>
 <h1>Register</h1>
 <div class='register'>
   <?php echo "<err>" . $_SESSION['err'] . "</err>"; unset($_SESSION['err']); ?>

   <form action="/php/register.php" method="POST">
     <div><label for="username">Username: </label> </div><input type="text" name="username" value="" id="username" required autofocus><br>
     <div><label for="password">Password: </label></div> <input type="password" name="password" value="" placeholder="**********" id="password" required><br>
     <input type="submit" value="Login">
</div>
