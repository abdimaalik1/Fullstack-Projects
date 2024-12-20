<?php

session_start();
session_unset();
session_destroy();

header("location: hospital_login.php");

?>