<?php include_once('template/navbar.php'); ?>
<?php include_once('template/header.html'); ?>
<title>My Dnd Page </title>
<h1> My Dnd Character Sheets </h1>

<?php include('php/getcharacters.php'); showchars('Recently Created',1,1); ?>
