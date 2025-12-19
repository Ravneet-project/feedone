<?php 
  include_once("header.php");
  
?>
<div class="container my-5">
    <?php
    if(isset($_GET['msg'])){
    ?>

    <div class="alert alert-dark"><?php echo $_GET['msg']?></div>
    <?php
    }
    ?>
    <div class="card px-5 c1">
    <h1 class="text-center my-3 " style="color:black">User Login</h1>
    <form action="user_submit.php" method="post">
        <div class="row my-3">
            <div class="col-md-2" style="color:black" >
                <label>Email</label>
            </div>
            <div class="col-md-10">
                <input class="form-control" name="email" required>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-2" style="color:black">
                <label>Password</label>
            </div>
            <div class="col-md-10">
                <input class="form-control" type="password" name="password" required>
            </div>
        </div>
        <div class="d-flex justify-content-center mb-5 mt-5">
                <button class="btn btn-primary w-25">Login</button><span class="mx-3 text-dark">Not Have an account?<br/><a href="user_register.php" class=" ">Register</a></span>
    
        </div>
    </form>
</div>
</div>

<?php
include("footer.php");
?>