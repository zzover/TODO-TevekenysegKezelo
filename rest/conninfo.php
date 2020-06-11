<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/rest/configs/core.php");
header("Content-Type: application/json;charset=utf-8");

$db = new Database(DSN, dbUser, dbPass);
$db->isError();
?>