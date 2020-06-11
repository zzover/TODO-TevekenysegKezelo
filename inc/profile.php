<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/rest/configs/core.php");

$lang = $_SESSION["Language"];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo textError[$lang]["siteTitle"];?></title>

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
            <h2>UserID: <?php 
                            if (isset($_GET["user"]))
                            {
                                echo $_GET["user"];
                            }
                            else
                            {
                                echo 0;
                            }
                        ?>
            </h2>
            
            <p>Fejlesztés alatt!</p>
            <p>Work in progress!</p>

            <a href="#" onclick="window.history.back();">
            <?php echo textError[$lang]["previous"];?>
            </a>
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
    <img src="<?php echo host . '/inc/img/bgs/unDraw-WARNING.svg'; ?>">
</div>
</div>
</div>

<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/footer.php"); ?>
</body>
</html>