<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/rest/configs/core.php");

if (isset($_GET["language"]))
{
    $_SESSION["Language"] = $_GET["language"];
    header("Location:". host);
}
else
{
    
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo</title>

    <link rel="stylesheet" href="<?php echo host . cssFolder . 'landingPage.css'?>">
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
            <h2>Choose a language | Válasszon nyelvet</h2>
            <p>Please select the language you want to use!</p>
            <p>Kérem válassza ki melyik nyelvet szeretné használni!</p>
          <?php
            if ($_SERVER["REQUEST_METHOD"] == "GET")
            {
                echo '<a class="language" href="'. host .'/ChooseLanguage/HU">Magyar</a>';
                echo '<a class="language" href="'. host .'/ChooseLanguage/EN">English</a>';
            }
            ?>
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
    <img src="<?php echo host . '/inc/img/bgs/unDraw-ADVENTURE.svg'; ?>">
</div>
</div>
</div>
</body>
</html>