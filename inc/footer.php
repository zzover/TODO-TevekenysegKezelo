<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/rest/configs/core.php");

$_SESSION["URL_BEFORE"] = $_SERVER["REQUEST_URI"];
?>
<style>
    .footer
    {
      position: fixed;
      right: -150px;
      width: 200px;
      bottom: 25px;
      text-align: center;
      display: inline-block;
      z-index: 100;
      background-color: #ffffff;
      border: 1px solid #ffffff;
      border-top-left-radius: 10px;
      border-bottom-left-radius: 10px;
      padding: 10px;
      box-shadow: -1px -1px 1px 0 rgba(255, 255, 255, 1), 5px 5px 5px 0 rgba(0, 0, 0, .5);
      transition: 0.5s;
      opacity: 0.5;
    }

    .footer svg
    {
      fill: #1b262c;
      display: block;
      margin: auto;
      margin-left: 0;
    }

    .footer:hover {
      right: -100px;
      opacity: 1;
      transition: 0.5s;
    }
</style>
    
    <div class="footer">
      <?php displayFlag(); ?>
    </div>