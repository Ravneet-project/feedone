<?php
include("header.php");
if(isset($_GET['id'])){
    $id=$_GET['id'];
    
    include("config.php");
    $query="Select * from `ngo` where `id`='$id'";
    $result=mysqli_query($connect,$query);
    $data=mysqli_fetch_array($result);
   
}
else{
    echo "<script>window.location.assign('view_status.php?msg=Please choose an item to update')</script>";
}
?>
<div class="container my-5">
    <?php
    if(isset($_GET['msg'])){
    echo $_GET['msg'];
    }
    ?>
 <div class="card px-5 c1">
    <h1 class="text-center my-3" style="color:black">Update Status</h1>
    <form method="post" >
       
        <div class="row my-3">
            <div class="col-md-2">
                <label>Status</label>
            </div>
            <div class="col-md-10">
                <select class="form-control" name="status">
                    <option selected disabled>Select one</option>
                    <option>Completed</option>
                    <option>Processing</option>
                    <option>Picking up</option>
                    <option>Donated</option>
                </select>
            </div>
        </div>
       
        <button class="btn btn-primary d-block mx-auto my-3 w-50" name="submit_btn">Update</button>
    </form>
</div>
</div>
<?php
if(isset($_POST['submit_btn'])){
    $status=$_POST['status'];
    
    include("config.php");
   echo  $query="UPDATE `food` set  `status`='$status' where `id`='$id'";
    $result=mysqli_query($connect,$query);
    if($result>0){
        echo "<script>window.location.assign('status.php?msg=Updated Successfully!!')</script>";
    }
    else{
        echo "<script>window.location.assign('status.php?msg=Error While Updating!!')</script>";
    }
}
?>
<?php
include("footer.php");
?>