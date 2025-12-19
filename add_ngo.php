<?php
include("header.php");

if(!isset($_SESSION['email'])){
    echo "<script>window.location.assign('adminlogin.php?msg=Please Login!!')</script>";
}
$email = $_SESSION['email'];
?>

<style>
    /* ===== Responsive Form Styling ===== */
    .page-wrap {
        padding: 110px 12px 40px; /* fixed header space + mobile padding */
    }

    .form-card {
        max-width: 900px;
        margin: 0 auto;
        border-radius: 16px;
        padding: 22px 18px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.10);
        border: 1px solid rgba(0,0,0,0.06);
    }

    .form-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 18px;
        color: #111;
    }

    label {
        color: #111;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .form-control, textarea.form-control {
        border-radius: 10px;
        height: 44px;
    }

    textarea.form-control {
        height: auto;
        min-height: 120px;
        resize: vertical;
    }

    .field-row {
        margin-bottom: 14px;
    }

    .error-text {
        font-size: 13px;
        margin-top: 6px;
        color: red;
        display: none;
    }

    /* stop horizontal scroll */
    body {
        overflow-x: hidden;
    }

    /* Mobile improvements */
    @media (max-width: 576px) {
        .page-wrap { padding: 95px 10px 30px; }
        .form-card { padding: 18px 14px; }
        .form-title { font-size: 22px; }
        .btn-submit { width: 100% !important; }
    }
</style>

<div class="page-wrap">
    <div class="container">

        <?php if(isset($_GET['msg'])){ ?>
            <div class="alert alert-secondary"><?php echo $_GET['msg']?></div>
        <?php } ?>

        <div class="card form-card">
            <h1 class="text-center form-title">Add NGO</h1>

            <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">

                <!-- NGO Name -->
                <div class="row field-row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <label>NGO Name</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <input class="form-control" type="text" name="name" required>
                        <div id="nameError" class="error-text"></div>
                    </div>
                </div>

                <!-- NGO Image -->
                <div class="row field-row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <label>NGO Image</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <input class="form-control" type="file" name="ngo_image" required>
                    </div>
                </div>

                <!-- Email -->
                <div class="row field-row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <label>Email</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <input class="form-control" type="email" name="email" required>
                        <div id="emailError" class="error-text"></div>
                    </div>
                </div>

                <!-- Password -->
                <div class="row field-row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <label>Password</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <input class="form-control" type="password" name="password" required>
                    </div>
                </div>

                <!-- Description -->
                <div class="row field-row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <label>Description</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <textarea class="form-control" name="description" rows="5" required></textarea>
                    </div>
                </div>

                <!-- Address -->
                <div class="row field-row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <label>Address</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <textarea class="form-control" name="address" rows="5" required></textarea>
                    </div>
                </div>

                <button class="btn btn-primary d-block mx-auto mt-4 btn-submit" style="width:260px;" name="submit_btn">
                    Add
                </button>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($_POST['submit_btn'])){
    $ngo = $_POST['name'];

    $img_name = $_FILES['ngo_image']['name'];
    $img_path = $_FILES['ngo_image']['tmp_name'];

    $new_name = rand().$img_name;
    move_uploaded_file($img_path,"images/".$new_name);

    $em   = $_POST['email'];
    $pass = md5($_POST['password']);
    $desc = $_POST['description'];
    $addr = $_POST['address'];

    include("config.php");
    $query="INSERT into `ngo`(`ngo_name`,`thumbnail`,`email`,`password`,`description`,`address`)
            VALUES('$ngo','$new_name','$em','$pass','$desc','$addr')";
    $result=mysqli_query($connect,$query);

    if($result>0){
        echo "<script>window.location.assign('add_ngo.php?msg=NGO Added Successfully!!')</script>";
    } else {
        echo "<script>window.location.assign('add_ngo.php?msg=Error while adding!!')</script>";
    }
}
?>

<?php include("footer.php"); ?>

<script>
function validateForm() {
  var name = document.getElementsByName("name")[0].value;
  var email = document.getElementsByName("email")[0].value;

  // Validate name
  if (name.trim() === "") {
    displayError("nameError", "Please enter NGO name.");
    return false;
  } else if (!isAlphabetic(name)) {
    displayError("nameError", "Only alphabetic characters allowed in NGO Name.");
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

  return true;
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
