<?php

session_start();
session_unset();
echo "<script>window.location.assign('adminlogin.php?msg=Logout Successfully!!')</script>";
?>