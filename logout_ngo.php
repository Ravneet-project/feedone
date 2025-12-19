<?php

session_start();
session_unset();
echo "<script>window.location.assign('ngo_login.php?msg=Logout Successfully!!')</script>";
?>