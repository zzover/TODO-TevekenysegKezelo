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
  <title><?php echo textSignup[$lang]["siteTitle"];?></title>

  <link rel="stylesheet" href="<?php echo host . cssFolder . 'signin-upForms.css'?>">
  <link rel="stylesheet" href="<?php echo host . libsFolder . 'node_modules/pnotify/dist/PNotifyBrightTheme.css'?>">
</head>
<body>
  <div class="container">
    <form method="POST" id="signupForm">
        <div class="title"><?php echo textSignup[$lang]["formTitle"];?></div>

        <div>
          <ul id="basicList"></ul>
        </div>

        <!-- FELHASZNÁLÓNÉV -->
        <div class="input-container">
            <label for="user"><?php echo textSignup[$lang]["placeholderUsername"];?></label>
            <input type="text" name="user" id="user" data-placeholder="" tabindex="1">

            <div>
                <div id="userDrop" class="info rejtett">
                <?php echo textSignup[$lang]["errorList"];?>
                  <i class="down"></i>
                </div>
              <ul id="userList" class="rejtett"></ul>
            </div>
        </div>

        <!-- VEZETÉKNÉV -->
        <div class="input-container">
            <label for="lastname"><?php echo textSignup[$lang]["placeholderLastname"];?></label>
            <input type="text" name="lastname" id="lastname" data-placeholder="" tabindex="2">

            <div>
                <div id="lastnameDrop" class="info rejtett">
                <?php echo textSignup[$lang]["errorList"];?>
                  <i class="down"></i>
                </div>
              <ul id="lastnameList" class="rejtett"></ul>
            </div>
        </div>

        <!-- KERESZTNÉV -->
        <div class="input-container">
            <label for="firstname"><?php echo textSignup[$lang]["placeholderFirstname"];?></label>
            <input type="text" name="firstname" id="firstname" data-placeholder="" tabindex="3">

            <div>
                <div id="firstnameDrop" class="info rejtett">
                <?php echo textSignup[$lang]["errorList"];?>
                  <i class="down"></i>
                </div>
              <ul id="firstnameList" class="rejtett"></ul>
            </div>
        </div>

        <!-- E-MAIL CÍM -->
        <div class="input-container">
            <label for="address"><?php echo textSignup[$lang]["placeholderAddress"];?></label>
            <input type="email" name="address" id="address" data-placeholder="" tabindex="4">

            <div>
                <div id="addressDrop" class="info rejtett">
                <?php echo textSignup[$lang]["errorList"];?>
                  <i class="down"></i>
                </div>
              <ul id="addressList" class="rejtett"></ul>
            </div>
        </div>

        <!-- JELSZÓ -->
        <div class="input-container">
            <label for="pass"><?php echo textSignup[$lang]["placeholderPass"];?></label>
            <input type="password" name="pass" id="pass" data-placeholder="" tabindex="5">

            <div>
                <div id="passDrop" class="info rejtett">
                <?php echo textSignup[$lang]["errorList"];?>
                  <i class="down"></i>
                </div>
              <ul id="passList" class="rejtett"></ul>
            </div>
        </div>

        <div class="input-container">
            <label for="confirm"><?php echo textSignup[$lang]["placeholderConfirmPass"];?></label>
            <input type="password" name="confirm" id="confirm" data-placeholder="" tabindex="6">

            <div>
                <div id="confirmDrop" class="info rejtett">
                <?php echo textSignup[$lang]["errorList"];?>
                  <i class="down"></i>
                </div>
              <ul id="confirmList" class="rejtett"></ul>
            </div>
        </div>

        <button type="submit" value="Submit" tabindex="7"><?php echo textSignup[$lang]["signupButton"];?></button>

        <hr class="hr-text" data-content="<?php echo textSignup[$lang]["or"];?>">
        <div class="other"><a href="Login" tabindex="8"><?php echo textSignup[$lang]["signinButton"];?></a></div>
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
<script type="module" src="<?php echo host . jsFolder . 'AJAX_signup.js'?>"></script>

<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/footer.php"); ?>
</body>
</html>