<?php
define("enableLogs", true);
define("root", $_SERVER["DOCUMENT_ROOT"]);
define("classFolder", "/rest/classes/");
    //define("contrFolder", "/rest/classes/controllers/");
define("logsFolder", "/rest/logs/");
define("logExt", ".log");
define("jsFolder", "/inc/js/");
define("cssFolder", "/inc/css/");
define("jsonFolder", "/inc/json/");
define("flagsFolder", "/inc/img/flags/");
define("libsFolder", "/libs/");

date_default_timezone_set("Europe/Budapest");
define("dFormat", "Y.n.j");
define("dtFormat", "%Y %b %d %H:%M:%S");

$dbHost = "127.0.0.1";
$database = "todo";
$dbCharset = "utf8";

define("dbUser", "root");
define("dbPass", "");
define("DSN", "mysql:host=". $dbHost .";dbname=". $database .";charset=". $dbCharset);

define("host", "http://localhost");
define("WebFrontString", "");
?>