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

    <link rel="stylesheet" href="<?php echo host . cssFolder . 'errors.css'?>">
</head>
<body>
    <div class="err-container">
        <div class="error">
            <h2><?php echo textError[$lang]["noscriptTitle"];?></h2>

            <span><?php echo textError[$lang]["noscriptMsg"];?></span>
        </div>
    </div>
</body>
</html>