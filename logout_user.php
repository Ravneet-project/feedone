<?php

session_start();
session_unset();
echo "<script>window.location.assign('userlogin.php?msg=Logout Successfully!!')</script>";
?>