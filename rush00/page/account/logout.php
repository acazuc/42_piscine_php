<?php
session_destroy();
$_SESSION = array();
include("page/login.php");
?>
