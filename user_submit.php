<?php
$em=$_POST['email'];
$pass=md5($_POST['password']);
include("config.php");
$query="SELECT * from `user` where `email`='$em' and `password`='$pass'";

$result=mysqli_query($connect,$query);

if(mysqli_num_rows($result)>0){
    session_start(); //start
    $_SESSION['email']=$em;
    $_SESSION['user_type']='User';
    echo "<script>window.location.assign('index.php?msg=Login successfully')</script>";
}
else{
    echo "<script>window.location.assign('userlogin.php?msg=Invalid Credentials')</script>";
}
?>