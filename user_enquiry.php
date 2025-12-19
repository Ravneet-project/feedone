<?php
include("header.php");
if(!isset($_SESSION['email'])){ //check
    echo "<script>window.location.assign('userlogin.php?msg=Please Login!!')</script>";
}


?>
<div class="container my-5">
    <?php
    if(isset($_GET['msg'])){
    echo $_GET['msg'];
    }
    ?>
 <div class="card px-5 c1" >
    <h1 class="text-center my-3" style="color:black">Add enquiry</h1>
    <form method="post"  onsubmit="return validateForm()">
        <div class="row my-3">
            <div class="col-md-2">
                <label> Name</label>
            </div>
            <div class="col-md-10">
                <input class="form-control" id="name" type="text" name="name"placeholder="Name" required>
                <div id="nameError" style="color: red;"></div>


            </div>
        </div>
        
      

        <div class="row my-3">
            <div class="col-md-2"  >
                <label>Subject</label>
            </div>
            <div class="col-md-10">
                <input class="form-control" name="subject" placeholder="Subject" required>
            </div>
        </div>
        
        <div class="row my-3">
            <div class="col-md-2" >
                <label>Message</label>
            </div>
            <div class="col-md-10">
                <textarea name="message" class="form-control" placeholder="message" rows="5" cols="25" required></textarea>
            </div>
        </div>

       
        
        <button class="btn btn-primary d-block mx-auto my-3 w-50" name="submit_btn">Send</button>
    </form>
</div>
</div>
<?php
    if(isset($_POST['submit_btn'])){
        $name=$_POST['name'];
        $em=$_SESSION['email'];
        $sub=$_POST['subject'];
        $msg=$_POST['message'];
        $usertype=$_SESSION['user_type'];

        include("config.php");
        $query="INSERT into `enquiry`(`name`,`email`,`subject`,`message`,`user_type`)
                            VALUES('$name','$em','$sub','$msg','$usertype')";
        $result=mysqli_query($connect,$query);
        if($result>0){
            echo "<script>window.location.assign('user_enquiry.php?msg=Enquiry added Successfully!!')</script>";
        }
        else{
            echo "<script>window.location.assign('user_enquiry.php?msg=Error while adding!!')</script>";
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
