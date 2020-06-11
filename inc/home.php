<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/rest/configs/core.php");

$lang = $_SESSION["Language"];

if (!isset($_SESSION["userID"]))
{
    header("Location:". host);
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <noscript><?php require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/errors/noscript.php"); ?></noscript>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo textHome[$lang]["siteTitle"];?></title>

    <!-- Bootstrap és PNotify stíluslapjai -->
    <link rel="stylesheet" href="<?php echo host . libsFolder . 'bootstrap-4.4.1-dist/css/bootstrap.min.css'?>">
    <link rel="stylesheet" href="<?php echo host . libsFolder . 'node_modules/pnotify/dist/PNotifyBrightTheme.css'?>">
    
    <!-- Az oldal kinézete -->
    <link rel="stylesheet" href="<?php echo host . cssFolder . 'home.css'?>">

    <!-- Naptár stíluslapjai -->
    <link rel="stylesheet" href="<?php echo host . libsFolder . 'fullcalendar-4.4.0/packages/core/main.css'?>">
    <link rel="stylesheet" href="<?php echo host . libsFolder . 'fullcalendar-4.4.0/packages/daygrid/main.css'?>">
    <link rel="stylesheet" href="<?php echo host . libsFolder . 'fullcalendar-4.4.0/packages/timegrid/main.css'?>">
    <link rel="stylesheet" href="<?php echo host . libsFolder . 'fullcalendar-4.4.0/packages/list/main.css'?>">

    <script src="<?php echo host . libsFolder . 'node_modules/chart.js/dist/Chart.js'?>"></script>
</head>
<body>
    <div class="wrapper">
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/navs/sidebar.php"); ?>

        <!-- Tartalom, oldalsáv nélkül  -->
        <div id="content">
        <!-- Felső navigációs sáv -->
        <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/navs/navbar.php"); ?>

            <!-- Tényleges tartalom, ide kerülnek a generált elemek -->
            <div class="container-fluid">
            
            <div id="overviewContainer">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 mb-3">
                    <h5></h5>
                	<div id="chartView"></div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-3">
                        <h5><?php echo textHome[$lang]["siteStatistics"];?></h5>
                        <ul class="list-group">
                            <li class="list-group-item"><span id="statUsers">#</span><?php echo textHome[$lang]["statUsers"];?></li>
                            <li class="list-group-item"><span id="statProjects">#</span><?php echo textHome[$lang]["statProjects"];?></li>
                            <li class="list-group-item"><span id="statProjectsShare">#</span><?php echo textHome[$lang]["statProjectsShare"];?></li>
                            <li class="list-group-item"><span id="statActivity">#</span><?php echo textHome[$lang]["statActivity"];?></li>
                            <li class="list-group-item"><span id="statActivityInProgress">#</span><?php echo textHome[$lang]["statActivityInProgress"];?></li>
                            <li class="list-group-item"><span id="statActivityDone">#</span><?php echo textHome[$lang]["statActivityDone"];?></li>
                        </ul>
                    </div>
                </div>

                <div class="row"><h5><?php echo textHome[$lang]["latestProjects"];?></h5></div>
                <div class="card-columns" id="latestColumns"></div>
            </div>
              <!-- Naptár -->
              <!--div class="row"-->
		<div id="calendarView"></div>
              <!--/div-->
              <!-- Kártya nézet, a projekteknek -->
            <div class="card-columns" id="columns"></div>
            </div>
    </div>

    <!-- Modal import -->
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/modals/notificationArea.php"); ?>
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/modals/userSearch.php"); ?>
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/modals/projectView.php"); ?>
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/modals/newProject.php"); ?>

    <!-- Script importok -->
    <script src="<?php echo host . libsFolder . 'jquery/jquery-3.4.1.min.js'?>"></script>
    <script src="<?php echo host . libsFolder . 'popperjs-1.16.0/popper.min.js'?>"></script>
    <!--<script src="<?php echo host . libsFolder . 'customscrollbar/jquery.mCustomScrollbar.concat.min.js'?>"></script>-->
    <script src="<?php echo host . libsFolder . 'bootstrap-4.4.1-dist/js/bootstrap.min.js'?>"></script>
    
    <script type="module" src="<?php echo host . jsFolder . 'AJAX_home.js'?>"></script>
    <script type="module" src="<?php echo host . jsFolder . 'AJAX_signout.js'?>"></script>

    <script src="<?php echo host . libsFolder . 'fullcalendar-4.4.0/packages/core/main.js'?>"></script>
    <script src="<?php echo host . libsFolder . 'fullcalendar-4.4.0/packages/core/locales-all.js'?>"></script>
    <script src="<?php echo host . libsFolder . 'fullcalendar-4.4.0/packages/interaction/main.js'?>"></script>
    <script src="<?php echo host . libsFolder . 'fullcalendar-4.4.0/packages/daygrid/main.js'?>"></script>
    <script src="<?php echo host . libsFolder . 'fullcalendar-4.4.0/packages/timegrid/main.js'?>"></script>
    <script src="<?php echo host . libsFolder . 'fullcalendar-4.4.0/packages/list/main.js'?>"></script>

    <script src="<?php echo host . libsFolder . 'node_modules/nonblockjs/NonBlock.es5.js'?>"></script>

    <!-- Oldalsáv kezelése -->
    <script type="text/javascript">
            $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                    $('#content').toggleClass('active');
                });
            });
      </script>

  <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/footer.php"); ?>
<div id="betoltes-container">
	<div class="betoltes">
		<span class="animacio"></span>
	</div>
</div>
</body>
</html>