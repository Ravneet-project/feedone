<?php 
  include("header.php");
  
?>
<div class="container my-5">
    <?php
    if(isset($_GET['msg'])){
    ?>
     <div class="alert alert-secondary"><?php echo $_GET['msg']?></div>
    <?php
    }
    ?>
    <div class="card px-5 c1 " style="color:black">
    <h1 class="text-center my-3 "style="color:black" >Admin Login</h1>
    <form action="submit.php" method="post">
        <div class="row my-3">
            <div class="col-md-2"  >
                <label>Email</label>
            </div>
            <div class="col-md-10">
                <input class="form-control" name="email" required>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-2" >
                <label>Password</label>
            </div>
            <div class="col-md-10">
                <input class="form-control" name="password" type="password" required>
            </div>
        </div>
        <button class="btn btn-primary d-block mx-auto my-3 w-50">Login</button>
    </form>
</div>
</div>
<?php
include("footer.php");
?>