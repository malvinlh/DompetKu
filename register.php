<?php
require('config.php');

if (isset($_REQUEST['firstname'])) {
    $firstname = stripslashes($_REQUEST['firstname']);
    $firstname = mysqli_real_escape_string($con, $firstname);

    $lastname = stripslashes($_REQUEST['lastname']);
    $lastname = mysqli_real_escape_string($con, $lastname);

    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);

    $created_date = date("Y-m-d H:i:s");

    // Check if the email already exists in the database
    $email_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $email_check_result = mysqli_query($con, $email_check_query);

    if (mysqli_num_rows($email_check_result) > 0) {
        $error_message_email = "Email exists, please use another email.";
    } else {
        // Proceed with user registration
        if ($_REQUEST['password'] == $_REQUEST['confirm_password']) {
            $hashed_password = md5($password);
            $query = "INSERT INTO users (firstname, lastname, password, email, created_date) VALUES ('$firstname', '$lastname', '$hashed_password', '$email', '$created_date')";
            $result = mysqli_query($con, $query);

            if ($result) {
                header("Location: login.php");
            }
        } else {
            $error_message_pw = "Password does not match.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      font-family: sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      width: 100%;
      background: url('uploads/login_reg_bg.jpg') no-repeat;
      background-position: center;
      background-size: cover;
    }

    .form-box {
      position: relative;
      width: 400px;
      height: 700px;
      background: transparent;
      border: 2px solid rgba(255, 255, 255, 0.5);
      border-radius: 20px;
      backdrop-filter: blur(15px);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    h2 {
      font-size: 2em;
      color: #fff;
      text-align: center;
    }

    .inputbox {
      position: relative;
      margin: 30px 0;
      width: 310px;
      border-bottom: 2px solid #fff;
    }

    .inputbox label {
      position: absolute;
      top: 50%;
      left: 5px;
      transform: translateY(-50%);
      color: #fff;
      font-size: 1em;
      pointer-events: none;
      transition: .5s;
    }

    input:focus~label,
    input:valid~label {
      top: -5px;
    }

    .inputbox input {
      width: 100%;
      height: 50px;
      background: transparent;
      border: none;
      outline: none;
      font-size: 1em;
      padding: 0 35px 0 5px;
      color: #fff;
    }

    .forget {
      margin: -15px 0 15px;
      font-size: .9em;
      color: #fff;
      display: flex;
      justify-content: space-between;
    }

    .forget label input {
      margin-right: 3px;
    }

    .forget label a {
      color: #fff;
      text-decoration: none;
    }

    .forget label a:hover {
      text-decoration: underline;
    }

    button {
      width: 100%;
      height: 40px;
      border-radius: 40px;
      background: #fff;
      border: none;
      outline: none;
      cursor: pointer;
      font-size: 1em;
      font-weight: 600;
    }

    .register {
      font-size: .9em;
      color: #fff;
      text-align: center;
      margin: 25px 0 10px;
    }

    .register p a {
      text-decoration: none;
      color: #fff;
      font-weight: 600;
    }

    .register p a:hover {
      text-decoration: underline;
    }

    .error-message {
      text-align: center;
      font-weight: bold;
      margin-bottom: 15px;
    }

    /* Media queries for responsiveness */
    @media only screen and (max-width: 600px) {
      .form-box {
        width: 300px;
        height: 550px;
      }

      h2 {
        font-size: 1.5em;
      }

      .inputbox {
        width: auto;
        margin: 15px 0;
      }

      .inputbox label {
        font-size: 0.8em;
      }

      input {
        width: auto;
        font-size: 0.8em;
      }

      .forget {
        margin: -10px 0 10px;
        font-size: 0.8em;
      }

      .forget label {
        font-size: 0.8em;
        display: flex;
        align-items: center;
      }

      .forget label input {
        margin-right: 3px;
      }

      button {
        width: 100%;
        font-size: 0.8em;
      }

      .register {
        font-size: 0.7em;
      }
    }
  </style>
</head>

<body>
  <section>
    <div class="form-box">
      <div class="form-value">
        <form action="" method="POST" autocomplete="off">
          <h2>Register</h2>
          <?php
          if (isset($error_message_email)) {
            echo '<div class="error-message text-danger">' . $error_message_email . '</div>';
          }
          if (isset($error_message_pw)) {
            echo '<div class="error-message text-danger">' . $error_message_pw . '</div>';
          }
          ?>
          <div class="inputbox">
            <input type="text" name="firstname" required="required">
            <label for="">First Name</label>
          </div>
          <div class="inputbox">
            <input type="text" name="lastname" required="required">
            <label for="">Last Name</label>
          </div>
          <div class="inputbox">
            <input type="email" name="email" required="required">
            <label for="">Email</label>
          </div>
          <div class="inputbox">
            <input type="password" name="password" required="required">
            <label for="">Password</label>
          </div>
          <div class="inputbox">
            <input type="password" name="confirm_password" required="required">
            <label for="">Confirm Password</label>
          </div>
          <div class="forget">
            <label class="float-left form-check-label"><input type="checkbox" required="required"> I accept the Terms of Use &amp; Privacy Policy</a></label>
          </div>
          <button type="submit">Register</button>
          <div class="register">
            <p>Already have an account?<a href="login.php" class="text-danger"> Login Here</a></p>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>

<!-- Bootstrap core JavaScript -->
<script src="js/jquery.slim.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Menu Toggle Script -->
<script>
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
</script>
<script>
  feather.replace()
</script>

</html>