<?php
include("header.php");
if(!isset($_SESSION['email'])){ //check
    echo "<script>window.location.assign('adminlogin.php?msg=Please Login!!')</script>";
}
$email=$_SESSION['email']; //store


?>
<?php
if(isset($_REQUEST['id'])){
    $id=$_REQUEST['id'];
}
?>
<div class="container my-5">
    <?php

    if(isset($_GET['msg'])){
    ?>
     <div class="alert alert-secondary"><?php echo $_GET['msg']?></div>
    <?php
    }
    ?>
 <div class="card px-5 c1">
    <h1 class="text-center my-3"style="color:black">Assign NGO</h1>
    <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        
        <div class="row my-3">
            <div class="col-md-2">
                <label>NGO Name</label>
            </div>
            <div class="col-md-10">
                <select class="form-control" name="ngo_name" required>
                    <option>Choose one</option>
                    <?php
                    include("config.php");
                    $query="Select * from `ngo`";
                    $result=mysqli_query($connect,$query);
                    while($data=mysqli_fetch_array($result)){
                        ?>
                    <option><?php echo $data['ngo_name']?></option>
                     <?php   
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-2" >
                <label>Pickup Address</label>
            </div>
            <div class="col-md-10">
                <textarea class="form-control" name="address" rows="5" cols="25" required></textarea>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-md-2"  >
                <label>Pickup Date</label>
            </div>
            <div class="col-md-10">
                <input class="form-control" type="date" id="dateInput" name="pickup_date" required>
                <div class="col-md-8 mx-auto" id="dateError" style="display: none; color: red;"></div>

            </div>
        </div>
        <button class="btn btn-primary d-block mx-auto my-3 w-50" name="submit_btn">Assign</button>
    </form>
</div>
</div>
<?php
    if(isset($_POST['submit_btn'])){
        $ngo=$_POST['ngo_name'];
        $addr=$_POST['address'];
        $date=$_POST['pickup_date'];

        include("config.php");
         $query="UPDATE `food` set `ngo_name`='$ngo',`pickup_address`='$addr',`status`='Assigned' where `id`='$id'";
        $result=mysqli_query($connect,$query);
        if($result>0){
            echo "<script>window.location.assign('view_food_admin.php?msg=NGO Assign Successfully!!')</script>";
        }
        else{
            echo "<script>window.location.assign('assign_ngo.php?msg=Error while assigning!!')</script>";
        }
    
    }
               
?>
<?php
include("footer.php");
?>
<script>
function validateForm() {
  var selectedDate = new Date(document.getElementById("dateInput").value);
  var currentDate = new Date();
  if (selectedDate < currentDate) {
    displayError("dateInput", "dateError", "Selected date is invalid. Please choose a date on or after today.");
    return false;
  } else {
    hideError("dateError");
  }

  return true; 
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
