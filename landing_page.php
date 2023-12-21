<?php
require('config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>DompetKu</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <script src="js/feather.min.js"></script>
  <style>
    * {
        margin: 0px;
        padding: 0px;
        text-decoration: none;
        list-style: none;
        font-family: sans-serif;
    }

    .header {
        width: 100%;
        height: auto;
        background-image: url('uploads/background.jpg');
        background-position: center;
        background-size: cover;
    }

    .home_section {
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        margin-left: auto;
    }

    .heading_sm {
        font-size: 42px;
        color: white;
        font-weight: 400;
        margin-bottom: -1px;
    }

    .heading_lg {
        font-size: 71px;
        color: white;
        font-weight: 800;
    }

    .heading_md {
        font-size: 19px;
        letter-spacing: 3px;
        color: rgba(255, 255, 255, 0.61);
    }

    .para_home {
        color: rgba(255, 255, 255, 0.822);
        font-weight: 500;
        max-width: 400px;
        font-size: 14px;
        line-height: 24px;
        margin: px 4px;
        text-align: justify;
    }

    .button_home {
        display: inline-block;
        padding: 8px 24px;
        font-size: 13px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.877);
        text-decoration: none;
        border: 2px solid rgba(255, 255, 255, 0.534);
        border-radius: 2px;
        margin: 4px;
        transition: 0.2s ease-in-out;
    }

    .button_home:hover {
        background-color: rgba(255, 255, 255, 0.822);
        padding: 9px 24px;
        border: none;
        color: black;
    }

    @media(max-width: 991px)
    {        
        .container_home {
            height: auto;
            padding: 20px;
        }
        
        .heading_sm {
            font-size: 24px;
        }
        
        .heading_lg {
            font-size: 32px;
        }
        
        .heading_md {
            font-size: 20px;
        }
        
        .para_home {
            font-size: 14px;
        }
        
        .button_home {
            font-size: 14px;
        }
    }

    @media (max-height: 300px)
    {
        .home_section {
            padding-top: 320px;
        }

        .header {
            width: 100%;
            min-height: 175vh;
            height: auto;
        }
    }  
  </style>
</head>

<body>
  <div class="header">
    <div class="home_section container" id="home">
      <div class="container_home">
        <div class="content_home">
        <h4 class="heading_sm">Welcome to</h4>
        <h2 class="heading_lg">DompetKu</h2>
        <p class="para_home">Managing your finances has never been easier. 
        DompetKu empowers you to take control of your money effortlessly, 
        providing a comprehensive solution for tracking your balance, income, and expenses.
        </p>
        <p class="para_home">CREDITS:<br>
        1. Malvin Leonardo Hartanto (NRP 5025221033) <br>
        2. Ranto Bastara Hamonangan Sitorus (NRP 5025221228) <br>
        Kuliah Pemrograman Web Jurusan Teknik Informatika ITS (2023). Dosen: Imam Kuswardayan, S.Kom, M.T
        </p>
        <a href="login.php" class="button_home"><span>Login</span></a>
        <a href="register.php" class="button_home"><span>Register</span></a>
        </div>
      </div>
    </div>
  </div>

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
</body>

</html>