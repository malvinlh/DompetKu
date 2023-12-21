<?php
ob_start();
include("session.php");
$update = false;
$del = false;
$incomeamount = "";
$incomedate = date("Y-m-d");
$incomecategory = "Entertainment";
if (isset($_POST['add'])) {
    $incomeamount = $_POST['incomeamount'];
    $incomedate = $_POST['incomedate'];
    $incomecategory = $_POST['incomecategory'];

    $income = "INSERT INTO income (user_id, income, incomedate,incomecategory) VALUES ('$userid', '$incomeamount','$incomedate','$incomecategory')";
    $result = mysqli_query($con, $income) or die("Something Went Wrong!");
    header('location: add_income.php');
}

if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $incomeamount = $_POST['incomeamount'];
    $incomedate = $_POST['incomedate'];
    $incomecategory = $_POST['incomecategory'];

    $sql = "UPDATE income SET income='$incomeamount', incomedate='$incomedate', incomecategory='$incomecategory' WHERE user_id='$userid' AND income_id='$id'";
    if (mysqli_query($con, $sql)) {
    } else {
    }
    header('location: manage_income.php');
    ob_end_flush();
}

if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $incomeamount = $_POST['incomeamount'];
    $incomedate = $_POST['incomedate'];
    $incomecategory = $_POST['incomecategory'];

    $sql = "UPDATE income SET income='$incomeamount', incomedate='$incomedate', incomecategory='$incomecategory' WHERE user_id='$userid' AND income_id='$id'";
    if (mysqli_query($con, $sql)) {
    } else {
    }
    header('location: manage_income.php');
    ob_end_flush();
}

if (isset($_POST['delete'])) {
    $id = $_GET['delete'];
    $incomeamount = $_POST['incomeamount'];
    $incomedate = $_POST['incomedate'];
    $incomecategory = $_POST['incomecategory'];

    $sql = "DELETE FROM income WHERE user_id='$userid' AND income_id='$id'";
    if (mysqli_query($con, $sql)) {
    } else {
    }
    header('location: manage_income.php');
    ob_end_flush();
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($con, "SELECT * FROM income WHERE user_id='$userid' AND income_id=$id");
    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $incomeamount = $n['income'];
        $incomedate = $n['incomedate'];
        $incomecategory = $n['incomecategory'];
    } else {
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $del = true;
    $record = mysqli_query($con, "SELECT * FROM income WHERE user_id='$userid' AND income_id=$id");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $incomeamount = $n['income'];
        $incomedate = $n['incomedate'];
        $incomecategory = $n['incomecategory'];
    } else {
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

    <title>DompetKu - Add Income</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Feather JS for Icons -->
    <script src="js/feather.min.js"></script>

    <style>
        @media (max-width: 767px) {
            /* Adjust the font size for smaller screens */
            footer {
                font-size: 12px; /* You can adjust the size as needed */
            }
        }
    </style>

</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
            <div class="user">
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="120">
                <h5><?php echo $username ?></h5>
                <p><?php echo $useremail ?></p>
            </div>
            <div class="sidebar-heading">Management</div>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action"><span data-feather="home"></span> Dashboard</a>
                <a href="add_expense.php" class="list-group-item list-group-item-action "><span data-feather="plus-square"></span> Add Expense</a>
                <a href="manage_expense.php" class="list-group-item list-group-item-action"><span data-feather="dollar-sign"></span> Manage Expense</a>
                <a href="add_income.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="plus-square"></span> Add Income</a>
                <a href="manage_income.php" class="list-group-item list-group-item-action"><span data-feather="dollar-sign"></span> Manage Income</a>
            </div>
            <div class="sidebar-heading">Settings </div>
            <div class="list-group list-group-flush">
                <a href="profile.php" class="list-group-item list-group-item-action "><span data-feather="user"></span> Profile</a>
                <a href="change_password.php" class="list-group-item list-group-item-action "><span data-feather="key"></span> Change Password</a>
                <a href="logout.php" class="list-group-item list-group-item-action "><span data-feather="power"></span> Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light  border-bottom">


                <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
                    <span data-feather="menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="25">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profile.phcol-mdp">Your Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container">
                <h3 class="mt-4 text-center">Add Your Daily Income</h3>
                <hr>
                <div class="row ">

                    <div class="col-md-3"></div>

                    <div class="col-md" style="margin:0 auto;">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="incomeamount" class="col-sm-6 col-form-label"><b>Enter Amount (IDR)</b></label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control col-sm-12" value="<?php echo $incomeamount; ?>" id="incomeamount" name="incomeamount" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="incomedate" class="col-sm-6 col-form-label"><b>Date</b></label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control col-sm-12" value="<?php echo $incomedate; ?>" name="incomedate" id="incomedate" required>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-6 pt-0"><b>Category</b></legend>
                                    <div class="col-md">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="incomecategory" id="incomecategory4" value="Medicine" <?php echo ($incomecategory == 'Medicine') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="incomecategory4">
                                                Medicine
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="incomecategory" id="incomecategory3" value="Food" <?php echo ($incomecategory == 'Food') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="incomecategory3">
                                                Food
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="incomecategory" id="incomecategory2" value="Bills & Recharges" <?php echo ($incomecategory == 'Bills & Recharges') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="incomecategory2">
                                                Bills and Recharges
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="incomecategory" id="incomecategory1" value="Entertainment" <?php echo ($incomecategory == 'Entertainment') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="incomecategory1">
                                                Entertainment
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="incomecategory" id="incomecategory7" value="Clothings" <?php echo ($incomecategory == 'Clothings') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="incomecategory7">
                                                Clothings
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="incomecategory" id="incomecategory6" value="Rent" <?php echo ($incomecategory == 'Rent') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="incomecategory6">
                                                Rent
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="incomecategory" id="incomecategory8" value="Household Items" <?php echo ($incomecategory == 'Household Items') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="incomecategory8">
                                                Household Items
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="incomecategory" id="incomecategory5" value="Others" <?php echo ($incomecategory == 'Others') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="incomecategory5">
                                                Others
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <?php if ($update == true) : ?>
                                        <button class="btn btn-lg btn-block btn-warning" style="border-radius: 0%;" type="submit" name="update">Update</button>
                                    <?php elseif ($del == true) : ?>
                                        <button class="btn btn-lg btn-block btn-danger" style="border-radius: 0%;" type="submit" name="delete">Delete</button>
                                    <?php else : ?>
                                        <button type="submit" name="add" class="btn btn-lg btn-block btn-success" style="border-radius: 0%;">Add income</button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-3"></div>
                    
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        feather.replace();
    </script>

  <!-- Footer Section -->
  <footer class="bg-success text-white text-center py-3">
    <div class="container" style="margin-bottom: -15px;">
      <p>&copy; <?php echo date("Y"); ?> DompetKu. All rights reserved.<br>
      CREDITS:
      Malvin Leonardo Hartanto (NRP 5025221033) & Ranto Bastara Hamonangan Sitorus (NRP 5025221228)<br>
      Kuliah Pemrograman Web Jurusan Teknik Informatika ITS (2023). Dosen: Imam Kuswardayan, S.Kom, M.T</p>
    </div>
  </footer>
</body>
</html>