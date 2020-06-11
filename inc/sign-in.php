<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/rest/configs/core.php");

$lang = $_SESSION["Language"];

if (isset($_SESSION["userID"]) && $_SESSION["userID"] > 0)
{
    header("Location:". host ."/Home");
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
  <noscript><?php require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/errors/noscript.php"); ?></noscript>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo textSignin[$lang]["siteTitle"];?></title>

  <link rel="stylesheet" href="<?php echo host . cssFolder . 'signin-upForms.css'?>">
  <link rel="stylesheet" href="<?php echo host . libsFolder . 'node_modules/pnotify/dist/PNotifyBrightTheme.css'?>">
</head>
<body>
  
  <div class="container">
    <form method="POST" id="signinForm">
        <div class="title"><?php echo textSignin[$lang]["formTitle"];?></div>

        <div>
          <ul id="basicList"></ul>
        </div>

        <div class="input-container">
            <label for="user"><?php echo textSignin[$lang]["placeholderAddress"];?></label>
            <input type="text" name="user" id="user" data-placeholder="" required tabindex="1">

            <div>
                <div id="userDrop" class="info rejtett">
                <?php echo textSignin[$lang]["errorList"];?>
                  <i class="down"></i>
                </div>
              <ul id="userList" class="rejtett"></ul>
            </div>
        </div>

        <div class="input-container">
            <label for="pass"><?php echo textSignin[$lang]["placeholderPass"];?></label>
            <input type="password" name="pass" id="pass" data-placeholder="" required tabindex="2">

            <div>
              <div id="passDrop" class="info rejtett">
              <?php echo textSignin[$lang]["errorList"];?>
                <i class="down"></i>
            </div>
              <ul id="passList" class="rejtett"></ul>
            </div>

            <div class="forgot rejtett"><a tabindex="5" disabled><?php echo textSignin[$lang]["forgotPass"];?></a></div>
        </div>
        <button type="submit" value="Submit" tabindex="3"><?php echo textSignin[$lang]["signinButton"];?></button>

        <hr class="hr-text" data-content="<?php echo textSignin[$lang]["or"];?>">
        <div class="other"><a href="Register" tabindex="4"><?php echo textSignin[$lang]["signupButton"];?></a></div>
        
    </form>
  </div>
  <script>
const FloatLabel = (() => {

// add active class and placeholder 
const handleFocus = e => {
  const target = e.target;
  target.parentNode.classList.add('active');
  target.setAttribute('placeholder', target.getAttribute('data-placeholder'));
};

// remove active class and placeholder
const handleBlur = e => {
  const target = e.target;
  if (!target.value) {
    target.parentNode.classList.remove('active');
  }
  target.removeAttribute('placeholder');
};

// register events
const bindEvents = element => {
  const floatField = element.querySelector('input');
  floatField.addEventListener('focus', handleFocus);
  floatField.addEventListener('blur', handleBlur);
};

// get DOM elements
const init = () => {
  const floatContainers = document.querySelectorAll('.input-container');

  floatContainers.forEach(element => {
    if (element.querySelector('input').value) {
      element.classList.add('active');
    }

    bindEvents(element);
  });
};

return {
  init: init };

})();

FloatLabel.init();
      </script>
<script src="<?php echo host . libsFolder . 'jquery/jquery-3.4.1.min.js'?>"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="<?php echo host . libsFolder . 'bootstrap-4.4.1-dist/js/bootstrap.min.js'?>"></script>
<script type="module" src="<?php echo host . jsFolder . 'AJAX_signin.js'?>"></script>

<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/footer.php"); ?>
</body>
</html>