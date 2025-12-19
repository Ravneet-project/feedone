<?php
include("header.php");
if(!isset($_SESSION['email'])){ //check
    echo "<script>window.location.assign('userlogin.php?msg=Please Login!!')</script>";
}
$em=$_SESSION['email'];

?>
<div class="container">
    <div class="row">
        <?php
        include("config.php");
        $query="SELECT * from `food` WHERE `email`='$em' ";
        $result=mysqli_query($connect,$query);
        while($data=mysqli_fetch_array($result)){

       ?>
        <div class="col-md-4 p-5">
        <div class="card" style="width: 18rem;">
        <img src="images/<?php echo $data['thumbnail']?>" class="card-img-top" alt="..." style="height:200px;">
            <div class="card-body">
            <h5 class="card-title" style="color:black"><?php echo $data['description']?></h5>
            
            <a href="update_food.php?id=<?php echo $data['id']?>" class="btn btn-primary">Update</a>
            <a href="view_food_user.php?id=<?php echo $data['id']?>" class="btn btn-primary">View</a>
          
            </div>
            
        </div>
        </div>
        <?php
         }
         ?>
    </div>
</div>
<?php
include("footer.php");
?>
