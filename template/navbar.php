<ul>
  <li><a href="/">Home</a></li>
  <?php
  session_start();
  if(!isset($_SESSION['user']))
  {
    echo '<li style="float:right"><a href="/login.php">Login</a></li>';
    echo '<li style="float:right"><a href="/register.php">Register</a></li>';
  }
  else
  {
    echo '<li style="float:right"><a href="/logout.php"> Logout </a></li>';
    echo '<li style="float:right"><a href="/profile.php">' . $_SESSION['user'] .'</a></li>';
    echo '<li style="float:right"><a href="/createChar.php">Create new character</a></li>';
  }
   ?>

</ul>
