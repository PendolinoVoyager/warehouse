<?php include "layout.php";
session_destroy();
header("Location: login.php");
exit();
?>