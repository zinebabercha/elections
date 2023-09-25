<?php

session_start();
require_once("../model/db.php");


session_destroy();
header("Location: ../view/login.php");
exit;


?>