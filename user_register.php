<?php
include_once("header.php");
?>
<div class="container my-5">
  <?php
  if (isset($_GET['msg'])) {
    echo $_GET['msg'];
  }
  ?>
  <div class="card px-5 c1 " style="color:black">
    <h1 class="text-center my-3" style="color:black">User Register</h1>
    <form method="post" onsubmit=" return validateForm()">
      <div class="row my-3">
        <div class="col-md-2">
          <label>Name</label>
        </div>
        <div class="col-md-10">
          <input class="form-control" name="name" required>
          <div id="nameError" style="color: red;"></div>

        </div>
      </div>
      <div class="row my-3">
        <div class="col-md-2">
          <label>Email</label>
        </div>
        <div class="col-md-10">
          <input class="form-control" name="email" required>
          <div id="emailError" style="color: red;"></div>

        </div>
      </div>
      <div class="row my-3">
        <div class="col-md-2">
          <label>Password</label>
        </div>
        <div class="col-md-10">
          <input class="form-control" name="password" type="password" required>
        </div>
      </div>
      <div class="row my-3">
        <div class="col-md-2">
          <label>Contact</label>
        </div>
        <div class="col-md-10">
          <input class="form-control" name="contact" type="number" required>
          <div id="contactError" style="color: red;"></div>

        </div>
      </div>
      <div class="row my-3">
        <div class="col-md-2">
          <label>Address</label>
        </div>
        <div class="col-md-10">
          <input class="form-control" name="address" required>
        </div>
      </div>
      <div class="d-flex justify-content-center mb-5 mt-5">
        <button class="btn btn-primary w-25 " name="btn1">Register</button><span class="mx-3 text-dark">Already Have an account?<a href="userlogin.php" class="btn btn-style btn-outline-primary  ml-lg-3 mr-lg-2 p-2">Login</a></span>

      </div>
    </form>
  </div>
</div>
<?php
if (isset($_POST['btn1'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $contact = $_POST['contact'];
  $address = $_POST['address'];

  include("config.php");
  $query = "INSERT into `user`(`username`,`email`,`password`,`contact`,`address`)VALUES('$name','$email','$password','$contact','$address')";

  $result = mysqli_query($connect, $query);
  // echo $query;
  if($result>0){
      echo "<script>window.location.assign('userlogin.php?msg=Register Successfully!')</script>";
  }
  else{
      echo "<script>window.location.assign('user_register.php?msg=Error while registering')</script>";
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
    var contact = document.getElementsByName("contact")[0].value;

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

    // Validate contact
    var pattern = /^(\+?91|0)?[6789]\d{9}$/;
    if (!pattern.test(contact)) {
      displayError("contactError", "Please enter a valid Indian contact number.");
      return false;
    } else {
      hideError("contactError");
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