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
    echo "<script>window.location.assign('view_ngo.php?msg=Please choose an item to update')</script>";
}
?>
<div class="container my-5">
    <?php
    if(isset($_GET['msg'])){
    echo $_GET['msg'];
    }
    ?>
 <div class="card px-5 c1">
    <h1 class="text-center my-3" style="color:black">Update NGO</h1>
    <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="row my-3">
            <div class="col-md-2">
                <label>NGO Name</label>
            </div>
            <div class="col-md-10">
                <input class="form-control" type="text" name="name" value="<?php echo $data['ngo_name']?>">
                <div id="nameError" style="color: red;"></div>

            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-2">
                <label>NGO Image</label>
            </div>
            <div class="col-md-10">
                <input class="form-control" type="file" name="ngo_image" >
                <input value="<?php echo $data['thumbnail']?>" name="hidden_old_image" type="hidden">
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-2"  >
                <label>Email</label>
            </div>
            <div class="col-md-10">
                <input class="form-control" name="email" type="email" value="<?php echo $data['email']?>">
                <div id="emailError" style="color: red;"></div>

            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-2" >
                <label>Description</label>
            </div>
            <div class="col-md-10">
                <textarea class="form-control"  name="description" rows="5" cols="25" ><?php echo $data['description']?></textarea>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-2" >
                <label>Address</label>
            </div>
            <div class="col-md-10">
                <textarea class="form-control" name="address" rows="5" cols="25"><?php echo $data['address']?></textarea>
            </div>
        </div>
        <button class="btn btn-primary d-block mx-auto my-3 w-50" name="submit_btn">Update</button>
    </form>
</div>
</div>
<?php
if(isset($_POST['submit_btn'])){
    $ngo=$_POST['name'];
    if($_FILES['ngo_image']['name']){
       
        $img_name=$_FILES['ngo_image']['name'];
        $img_path=$_FILES['ngo_image']['tmp_name'];
       
        $new_name=rand().$img_name;
        echo $new_name;
        move_uploaded_file($img_path,"images/".$new_name);
    }
    else{
        $new_name=$_POST['hidden_old_image'];
        echo $new_name;
    }
    $em=$_POST['email'];
    $desc=$_POST['description'];
    $addr=$_POST['address'];
    
    include("config.php");
    $query="UPDATE `ngo` set `ngo_name`='$ngo',`thumbnail`='$new_name',`email`='$em',`description`='$desc',`address`='$addr' where `id`='$id'";
    $result=mysqli_query($connect,$query);
    if($result>0){
        echo "<script>window.location.assign('view_ngo.php?msg=Updated Successfully!!')</script>";
    }
    else{
        echo "<script>window.location.assign('view_ngo.php?msg=Error While Updating!!')</script>";
    }
}
?>
<?php
include("footer.php");
?>
<script>
function validateForm() {
  var name = document.getElementsByName("name")[0].value;
  var email = document.getElementsByName("email")[0].value;

  // Validate name
  if (name.trim() === "") {
    displayError("nameError", "Please enter your name.");
    return false;
  } else if (!isAlphabetic(name)) {
    displayError("nameError", "Please enter alphabetic characters only for Name.");
    return false;
  } else {
    hideError("nameError");
  }

  // Validate email
  if (email.trim() === "") {
    displayError("emailError", "Please enter your email address.");
    return false;
  } else if (!validateEmail(email)) {
    displayError("emailError", "Please enter a valid email address.");
    return false;
  } else {
    hideError("emailError");
  }



  return true; // Form is valid
}

function isAlphabetic(input) {
  var letters = /^[A-Za-z\s]+$/;
  return letters.test(input);
}

function validateEmail(email) {
  var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return pattern.test(email);
}

function displayError(errorId, errorMessage) {
  var errorElement = document.getElementById(errorId);
  errorElement.textContent = errorMessage;
  errorElement.style.display = "block";
}

function hideError(errorId) {
  var errorElement = document.getElementById(errorId);
  errorElement.style.display = "none";
}
</script>
