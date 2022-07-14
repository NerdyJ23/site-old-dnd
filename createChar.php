<?php
session_start();
include('template/header.html');
include('template/navbar.php');
include('template/jquery.html');
if(!isset($_SESSION['id']))
{
  header('Location: /login.php');
}
?>
<script src='/js/createTabs.js'></script>
<link rel="stylesheet" type='text/css' href="/style/createChar.css">
<h1>Create new character</h1>
<div id='content'>
  <div id='buttons'><button value='0'>Manual Entry</button><button value='1'>Generate new character</button></div>
  <div id='user-gen' class='tabcontent'>
    <?php include('template/character/create.html');  ?>
  </div>
  <div id='auto-gen' class='tabcontent'>
    <?php include('template/character/genCreate.html'); ?>
  </div>
</div>
