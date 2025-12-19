<?php
include("header.php");
if(!isset($_SESSION['email'])){ //check
    echo "<script>window.location.assign('userlogin.php?msg=Please Login!!')</script>";
}

if(isset($_GET['id'])){
    $id=$_GET['id'];
    
    include("config.php");
    $query="Select * from `food` where `id`='$id'";
    $result=mysqli_query($connect,$query);
    $data=mysqli_fetch_array($result);
   
}
else{
    echo "<script>window.location.assign('view_food.php?msg=Please choose an item to update')</script>";
}
?>
<div class="container my-5">
    <?php
    if(isset($_GET['msg'])){
    echo $_GET['msg'];
    }
    ?>
 <div class="card px-5 c1">
    <h1 class="text-center my-3" style="color:black">Update Donation</h1>
    <form method="post" enctype="multipart/form-data" onsubmit=" return validateForm()">
        <div class="row my-3">
            <div class="col-md-2">
                <label>User Name</label>
            </div>
            <div class="col-md-10">
                <input class="form-control"id="nameInput" type="text" name="username" value="<?php echo $data['username']?>">
                <div class="col-md-8 mx-auto" id="nameError" style="display: none; color: red;"></div>

            </div>
        </div>
        
        <div class="row my-3">
            <div class="col-md-2">
                <label>Image</label>
            </div>
            <div class="col-md-10">
                <input class="form-control" type="file" name="food_image" >
                <input value="<?php echo $data['thumbnail']?>" name="hidden_old_image" type="hidden">
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
            <div class="col-md-2"  >
                <label>Manufactured Date</label>
            </div>
            <div class="col-md-10">
                <input class="form-control" type="date" name="mfg_date" value="<?php echo $data['mfg_date']?>" >
                <div class="col-md-8 mx-auto" id="dateError" style="display: none; color: red;"></div>

            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-2"  >
                <label>Expiry Date</label>
            </div>
            <div class="col-md-10">
                <input class="form-control" id="dateInput"type="date" name="exp_date" value="<?php echo $data['exp_date']?>" >
                <div class="col-md-8 mx-auto" id="dateError" style="display: none; color: red;"></div>

            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-2" >
                <label>Pickup Address</label>
            </div>
            <div class="col-md-10">
                <textarea class="form-control" name="address" rows="5" cols="25"><?php echo $data['pickup_address']?></textarea>
            </div>
        </div>
        
        <button class="btn btn-primary d-block mx-auto my-3 w-50" name="submit_btn">Update</button>
    </form>
</div>
</div>
<?php
if(isset($_POST['submit_btn'])){
    $user=$_POST['username'];
   
       
    if($_FILES['food_image']['name']){
       
        $img_name=$_FILES['food_image']['name'];
        $img_path=$_FILES['food_image']['tmp_name'];
       
        $new_name=rand().$img_name;
        echo $new_name;
        move_uploaded_file($img_path,"images/".$new_name);
    }
    else{
        $new_name=$_POST['hidden_old_image'];
        echo $new_name;
    }
    
    $desc=$_POST['description'];
    $mfg=$_POST['mfg_date'];
    $exp=$_POST['exp_date'];
    $addr=$_POST['address'];
    
    
    include("config.php");
    $query="UPDATE `food` set `username`='$user',`thumbnail`='$new_name',
                            `description`='$desc',`mfg_date`='$mfg',`exp_date`='$exp',
                            `pickup_address`='$addr' where `id`='$id'";
    $result=mysqli_query($connect,$query);
    if($result>0){
        echo "<script>window.location.assign('user_food.php?msg=Updated Successfully!!')</script>";
    }
    else{
        echo "<script>window.location.assign('user_food.php?msg=Error While Updating!!')</script>";
    }
}
?>
<?php
include("footer.php");
?>
<script>
function validateForm() {
  var name = document.getElementById("nameInput").value;
  var selectedDate = new Date(document.getElementById("dateInput").value);
  var currentDate = new Date();

  // Validate name
  if (name.trim() === "") {
    displayError("nameInput", "nameError", "Please enter your name.");
    return false;
  } else if (!isAlphabetic(name)) {
    displayError("nameInput", "nameError", "Please enter alphabetic characters only.");
    return false;
  } else {
    hideError("nameError");
  }

  // Validate date
  if (selectedDate < currentDate) {
    displayError("dateInput", "dateError", "Selected date is invalid. Please choose a date on or after today.");
    return false;
  } else {
    hideError("dateError");
  }

  return true; // Form is valid
}

function isAlphabetic(input) {
    var letters = /^[A-Za-z\s]+$/;
  return letters.test(input);
}

function displayError(inputId, errorId, errorMessage) {
  var errorElement = document.getElementById(errorId);
  errorElement.textContent = errorMessage;
  errorElement.style.display = "block";

  // Add error class to the input element
  var inputElement = document.getElementById(inputId);
  inputElement.classList.add("is-invalid");
}

function hideError(errorId) {
  var errorElement = document.getElementById(errorId);
  errorElement.style.display = "none";

  // Remove error class from the input element
  var inputElement = document.getElementById(errorId.replace("Error", "Input"));
  inputElement.classList.remove("is-invalid");
}

</script>