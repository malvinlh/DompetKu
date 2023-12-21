<?php
require('config.php');
session_start();
$errormsg = "";
if (isset($_POST['email'])) 
{
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($con, $email);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($con, $password);
  $query = "SELECT * FROM `users` WHERE email='$email'and password='" . md5($password) . "'";
  $result = mysqli_query($con, $query) or die(mysqli_error($con));
  $rows = mysqli_num_rows($result);
  if ($rows == 1) {
    $_SESSION['email'] = $email;
    header("Location: index.php");
  } else {
    $errormsg  = "Login failed. Please try again.";
  }
} 
else 
{

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
    *{
        margin: 0;
        padding: 0;
        font-family: sans-serif;
    }
    section{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        width: 100%;
        
        background: url('uploads/login_reg_bg.jpg') no-repeat;
        background-position: center;
        background-size: cover;
    }
    .form-box{
        position: relative;
        width: 400px;
        height: 450px;
        background: transparent;
        border: 2px solid rgba(255,255,255,0.5);
        border-radius: 20px;
        backdrop-filter: blur(15px);
        display: flex;
        justify-content: center;
        align-items: center;

    }
    h2{
        font-size: 2em;
        color: #fff;
        text-align: center;
    }
    .inputbox{
        position: relative;
        margin: 30px 0;
        width: 310px;
        border-bottom: 2px solid #fff;
    }
    .inputbox label{
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);
        color: #fff;
        font-size: 1em;
        pointer-events: none;
        transition: .5s;
    }
    input:focus ~ label,
    input:valid ~ label{
    top: -5px;
    }
    .inputbox input {
        width: 100%;
        height: 50px;
        background: transparent;
        border: none;
        outline: none;
        font-size: 1em;
        padding:0 35px 0 5px;
        color: #fff;
    }
    
    .forget{
        margin: -15px 0 15px ;
        font-size: .9em;
        color: #fff;
        display: flex;
        justify-content: space-between;  
    }

    .forget label input{
        margin-right: 3px;
        
    }
    .forget label a{
        color: #fff;
        text-decoration: none;
    }
    .forget label a:hover{
        text-decoration: underline;
    }
    button{
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
    .register{
        font-size: .9em;
        color: #fff;
        text-align: center;
        margin: 25px 0 10px;
    }
    .register p a{
        text-decoration: none;
        color: #fff;
        font-weight: 600;
    }
    .register p a:hover{
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
        height: 350px;
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
                    <h2>Login</h2>
                    <?php
                      if (!empty($errormsg)) 
                      {
                        echo '<div class="error-message text-danger">' . $errormsg . '</div>';
                      }
                    ?>
                    <div class="inputbox">
                        <input type="text" name="email" required="required">
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <input type="password" name="password" required="required">
                        <label for="">Password</label>
                    </div>
                    <div class="forget">
                      <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
                    </div>
                    <button type="submit">Login</button>
                    <div class="register">
                        <p>Don't have an account?<a href="register.php" class="text-danger"> Register Here</a></p>
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
  $("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
</script>
<script>
  feather.replace()
</script>

</html>