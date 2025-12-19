<?php
$em=$_POST['email'];
$pass=md5($_POST['password']);
include("config.php");
$query="SELECT * from `ngo` where `email`='$em' and `password`='$pass'";

$result=mysqli_query($connect,$query);
$data=mysqli_fetch_array($result);
// $ngo=$_SESSION['ngo_name']=$data['ngo_name'];
// echo $ngo;
if(mysqli_num_rows($result)>0){
    session_start(); //start
    $_SESSION['email']=$em;
    $_SESSION['ngo_name']=$data['ngo_name'];
    $_SESSION['user_type']='ngo';
    echo "<script>window.location.assign('ngoindex.php')</script>";
}
else{
    echo "<script>window.location.assign('ngo_login.php?msg=Invalid Credentials')</script>";
}
?>