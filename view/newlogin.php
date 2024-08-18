<?php
session_start();
include('includes/dbconnection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch user details
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters to the prepared statement
    $stmt->bind_param("ss", $username, $password);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Store user details in session variables
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];


        // Redirect to the appropriate dashboard based on user role
        switch ($row['role']) {
            case 'teacher':
                header("Location: Dashboard.php");
                break;
            case 'student':
                header("Location: student_dashboard.php");
                break;
            case 'admin':
                header("Location: admin_dashboard.php");
                break;
        }
    } else {
        // Invalid credentials
        echo "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Student Management System || Login Page</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
  .brand-logo
{
  text-align: center;
  max-width: 100%;
  max-height: 100%;
}
h4{
  text-align: center;
  max-width: 100%;
  max-height: 100%;
  top: -20px;
}
.password-toggle {
    position: absolute;
    right: 0px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
  }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">

              <div class="auth-form-light text-left p-5">
                
                <div class="brand-logo" >
                  <img src="school.png" alt="School Logo">
                  <h4>School Login</h4>
                </div>
               
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" id="login" method="post" name="login">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="icon-user"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control form-control-lg" placeholder="Enter your username" id="username" name="username" required="true">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="icon-lock"></i>
                        </span>
                      </div>
                      <input type="password" class="form-control form-control-lg" placeholder="Enter your password" id="password" name="password" required="true">
                      <div class="input-group-append">
                        <span class="input-group-text password-toggle" onclick="togglePasswordVisibility()">
                          <i id="password-icon" class="icon-eye"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-success btn-block loginbtn" name="login" type="submit">Login</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                      <input type="checkbox" id="remember" class="form-check-input" name="remember" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?> /> Keep me signed in </label>
                      </label>
                    </div>
                    <a href="forgot-password.php" class="auth-link text-black">Forgot password?</a>
                  </div>
                  <div class="mb-2">
                    <a href="../index.php" class="btn btn-block btn-facebook auth-form-btn">
                      <i class="icon-social-home mr-2"></i>Back Home
                    </a>
                  </div>
                </form>
                <p class="text-center mt-5 mb-0">© 2024 Your School Name. All rights reserved.</p>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>

    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <script>
  // Password toggle functionality
  function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var passwordIcon = document.getElementById("password-icon");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      passwordIcon.classList.remove("icon-eye");
      passwordIcon.classList.add("icon-eye-off");
    } else {
      passwordInput.type = "password";
      passwordIcon.classList.remove("icon-eye-off");
      passwordIcon.classList.add("icon-eye");
    }
  }
</script>
  </body>
</html>