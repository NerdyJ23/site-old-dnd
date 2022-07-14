<?php
session_start();
include_once('template/header.html');
include_once('template/navbar.php');
include_once('template/jquery.html');
require('php/connect.php');
require('php/verifyAuth.php');
echo "<title>".$charInfo['Name']." - DndSheets? </title>";
 ?>
<link rel="stylesheet" type='text/css' href="/style/char.css">
<script src="/js/chartabs.js"></script>
<script src="/js/updatehp.js"></script>
<div class='vis' val=''>
  <span style='display:none' id='vis'></span>
  <div id='vis_1'><i class="fa fa-eye fa-3x" aria-hidden="true"></i><br>Public</div>
  <div id='vis_0'><i class="fa fa-eye-slash fa-3x" aria-hidden="true"></i><br>Private</div>
</div>
<div class='tab'>
  <?php if($charInfo['User_Access'] == $_SESSION['id']) echo "<button class='admin' id='edit' value='edit'>Edit Information</button>" ?>
  <button class='tablinks active' value='sheet'>Character</button>
  <button class='tablinks' value='equipment'>Equipment</button>
  <!--<button class='tablinks' value='misc'>Misc</button> -->
</div>
<?php if($charInfo['User_Access'] == $_SESSION['id']) include('template/character/statsedit.html'); ?>
<div id="content">
  <div id='sheet' class='tabcontent sheet'>
    <?php ?>
    <table>
      <tr>
        <td id='stat-bar'>
          <?php include('template/character/stats.html'); ?>
        </td>
          <?php //include('template/character/abilities.html'); ?>
        <td id="main"> <!-- bulk of info; profile, hp, exp etc -->
          <?php include('template/character/info.html'); ?>
        </td>
      </tr>
    </table>
  </div>

  <div id='equipment' class='tabcontent equipment'>
    <h1>Equipment</h1>
    <div id='wallet'>
      <?php include('template/character/money.html'); ?>
    </div>

    <div id='bag'>
      <?php include('template/character/equipment.html'); ?>
    </div>
  </div>

</div>
