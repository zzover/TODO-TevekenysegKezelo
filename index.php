<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/rest/configs/core.php");

if (isset($_SESSION["userID"]) && $_SESSION["userID"] > 0)
{
    header("Location:". host ."/Home");
}
$lang = $_SESSION["Language"];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <noscript><?php require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/errors/noscript.php"); ?></noscript>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo textIndex[$lang]["siteTitle"];?></title>

    <link rel="stylesheet" href="<?php echo host . cssFolder . 'landingPageUj.css'?>">
</head>

<body>
<div class="wrapper">
  <div class="kartya">
    <div class="container">
      <div class="nav">
        <strong><a href="<?php echo host; ?>">ToDo</a></strong>
      </div>

      <div class="content">
        <div class="info">
          <h2><?php echo textIndex[$lang]["title"];?></h2>
          <p><?php echo textIndex[$lang]["whatIsThis"];?></p>
          <?php echo textIndex[$lang]["content"];?>
          <a href="" title="<?php echo textIndex[$lang]["signinButton"];?>" onClick="window.open('Authentication/Register','pagename','resizable=0,height=768,width=480'); return false;"><?php echo textIndex[$lang]["register"];?></a>
        </div>
        <div class="bemutato">
        <p class="mobile-szoveg">
          <?php echo textIndex[$lang]["mobileInfo"];?>
        </p>
        </div>
        <div class="row">
         <a id="register" href="<?php echo host . '/Authentication/Register'; ?>" title=""><?php echo textIndex[$lang]["register"];?></a>
         <a id="login" href="" onClick="window.open('Authentication/Login','pagename','resizable=0,height=768,width=480'); return false;"><?php echo textIndex[$lang]["login"];?></a>
        </div>
      </div>

    </div>

    <div class="container">
    <blockquote class="idezet">
    &ldquo;
    <span id="szoveg"></span>
    Vagy a saját álmaidat építed fel, vagy valaki másét.
    &rdquo;
    <span id="szerzo">– Farrah Gray</span>
    </blockquote>
    <img src="<?php echo host . '/inc/img/bgs/unDraw-TASK.svg'; ?>">
    </div>
  </div>
</div>

<script src="<?php echo host . libsFolder . 'jquery/jquery-3.4.1.min.js'?>"></script>
<script src="<?php echo host . libsFolder . 'popperjs-1.16.0/popper.min.js'?>"></script>
<script src="<?php echo host . libsFolder . 'bootstrap-4.4.1-dist/js/bootstrap.min.js'?>"></script>
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/footer.php"); ?>
</body>
</html>