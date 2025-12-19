<?php
$em=$_POST['email'];
$pass=md5($_POST['password']);
include("config.php");
$query="SELECT * from `admin` where `email`='$em' and `password`='$pass'";

$result=mysqli_query($connect,$query);

if(mysqli_num_rows($result)>0){
    session_start(); //start
    $_SESSION['email']=$em;
    $_SESSION['user_type']='Admin';  
    echo "<script>window.location.assign('adminindex.php?msg=Login Successfully')</script>";
}
else{
    echo "<script>window.location.assign('adminlogin.php?msg=Invalid Credentials')</script>";
}
?>