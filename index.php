<?php
include("session.php");

// Expense
$exp_category_dc = mysqli_query($con, "SELECT expensecategory FROM expense WHERE user_id = '$userid' GROUP BY expensecategory");
$exp_amt_dc = mysqli_query($con, "SELECT SUM(expense) FROM expense WHERE user_id = '$userid' GROUP BY expensecategory");

$exp_date_line = mysqli_query($con, "SELECT expensedate FROM expense WHERE user_id = '$userid' GROUP BY expensedate");
$exp_amt_line = mysqli_query($con, "SELECT SUM(expense) FROM expense WHERE user_id = '$userid' GROUP BY expensedate");

$exp_total_result = mysqli_query($con, "SELECT SUM(expense) AS total_expense FROM expense");
$exp_total_row = mysqli_fetch_assoc($exp_total_result);
$expense_total = $exp_total_row['total_expense'];

// Income
$inc_category_dc = mysqli_query($con, "SELECT incomecategory FROM income WHERE user_id = '$userid' GROUP BY incomecategory");
$inc_amt_dc = mysqli_query($con, "SELECT SUM(income) FROM income WHERE user_id = '$userid' GROUP BY incomecategory");

$inc_date_line = mysqli_query($con, "SELECT incomedate FROM income WHERE user_id = '$userid' GROUP BY incomedate");
$inc_amt_line = mysqli_query($con, "SELECT SUM(income) FROM income WHERE user_id = '$userid' GROUP BY incomedate");

$inc_total_result = mysqli_query($con, "SELECT SUM(income) AS total_income FROM income");
$inc_total_row = mysqli_fetch_assoc($inc_total_result);
$income_total = $inc_total_row['total_income'];

// History
$exp_fetched = mysqli_query($con, "SELECT * FROM expense WHERE user_id = '$userid'");
$inc_fetched = mysqli_query($con, "SELECT * FROM income WHERE user_id = '$userid'");
// Balance
$total_balance = $income_total - $expense_total;

// Fetch data into arrays
$exp_categories = [];
$exp_amounts = [];
$exp_dates = [];
$exp_line_amounts = [];
$inc_categories = [];
$inc_amounts = [];
$inc_dates = [];
$inc_line_amounts = [];

while ($expCat = mysqli_fetch_array($exp_category_dc)) {
  $exp_categories[] = $expCat['expensecategory'];
}

while ($expAmount = mysqli_fetch_array($exp_amt_dc)) {
  $exp_amounts[] = $expAmount['SUM(expense)'];
}

while ($expDate = mysqli_fetch_array($exp_date_line)) {
  $exp_dates[] = $expDate['expensedate'];
}

while ($expAmtLine = mysqli_fetch_array($exp_amt_line)) {
  $exp_line_amounts[] = $expAmtLine['SUM(expense)'];
}

while ($incCat = mysqli_fetch_array($inc_category_dc)) {
  $inc_categories[] = $incCat['incomecategory'];
}

while ($incAmount = mysqli_fetch_array($inc_amt_dc)) {
  $inc_amounts[] = $incAmount['SUM(income)'];
}

while ($incDate = mysqli_fetch_array($inc_date_line)) {
  $inc_dates[] = $incDate['incomedate'];
}

while ($incAmtLine = mysqli_fetch_array($inc_amt_line)) {
  $inc_line_amounts[] = $incAmtLine['SUM(income)'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Expense Manager - Dashboard</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <script src="js/feather.min.js"></script>
  <style>
    .card a {
      color: #000;
      font-weight: 500;
    }

    .card a:hover {
      color: #28a745;
      text-decoration: dotted;
    }
  </style>
</head>

<body>
  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="border-right" id="sidebar-wrapper">
      <div class="user">
        <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="120">
        <h5>
          <?php echo $username ?>
        </h5>
        <p>
          <?php echo $useremail ?>
        </p>
      </div>
      <div class="sidebar-heading">Management</div>
      <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item list-group-item-action sidebar-active"><span
            data-feather="home"></span> Dashboard</a>
        <a href="add_expense.php" class="list-group-item list-group-item-action "><span
            data-feather="plus-square"></span> Add Expense</a>
        <a href="manage_expense.php" class="list-group-item list-group-item-action "><span
            data-feather="dollar-sign"></span> Manage Expense</a>
        <a href="add_income.php" class="list-group-item list-group-item-action "><span
            data-feather="plus-square"></span> Add Income</a>
        <a href="manage_income.php" class="list-group-item list-group-item-action "><span
            data-feather="dollar-sign"></span> Manage Income</a>
      </div>
      <div class="sidebar-heading">Settings </div>
      <div class="list-group list-group-flush">
        <a href="profile.php" class="list-group-item list-group-item-action "><span data-feather="user"></span>
          Profile</a>
        <a href="logout.php" class="list-group-item list-group-item-action "><span data-feather="power"></span>
          Logout</a>
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
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="25">
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="profile.php">Your Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <h3 class="mt-4">Dashboard</h3>
        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md text-center">
                    <a href="add_expense.php"><img src="icon/addex.png" width="57px" />
                      <p>Add Expense</p>
                    </a>
                  </div>
                  <div class="col-md text-center">
                    <a href="manage_expense.php"><img src="icon/maex.png" width="57px" />
                      <p>Manage Expense</p>
                    </a>
                  </div>
                  <div class="col-md text-center">
                    <a href="add_income.php"><img src="icon/addex.png" width="57px" />
                      <p>Add Income</p>
                    </a>
                  </div>
                  <div class="col-md text-center">
                    <a href="manage_income.php"><img src="icon/maex.png" width="57px" />
                      <p>Manage Income</p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <h3 class="mt-4">Balance</h3>
        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md text-center">
                    <h4>
                      Total Balance
                    </h4>
                    <h4>
                      <?php echo $total_balance ?>
                    </h4>
                  </div>
                  <div class="col-md text-center text-success">
                    <h4>
                      Total Income
                    </h4>
                    <h4>
                      +
                      <?php echo $income_total ?>
                    </h4>
                  </div>
                  <div class="col-md text-center text-danger">
                    <h4>
                      Total Expense
                    </h4>
                    <h4>
                      -
                      <?php echo $expense_total ?>
                    </h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <h3>History</h3>
        <div>
          <div class="row justify-content-center">
            <div class="col-md">
              <h3 class="mt-4 text-center">Expense History</h3>
              <table class="table table-hover table-bordered">
                <thead>
                  <tr class="text-center">
                    <th>#</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Expense Category</th>
                  </tr>
                </thead>

                <?php $count = 1;
                while ($row = mysqli_fetch_array($exp_fetched)) { ?>
                  <tr>
                    <td>
                      <?php echo $count; ?>
                    </td>
                    <td>
                      <?php echo $row['expensedate']; ?>
                    </td>
                    <td>
                      <?php echo '$' . $row['expense']; ?>
                    </td>
                    <td>
                      <?php echo $row['expensecategory']; ?>
                    </td>
                  </tr>
                  <?php $count++;
                } ?>
              </table>
            </div>
            <div class="col-md">
              <h3 class="mt-4 text-center">Income History</h3>
              <table class="table table-hover table-bordered">
                <thead>
                  <tr class="text-center">
                    <th>#</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Income Category</th>
                  </tr>
                </thead>

                <?php $count = 1;
                while ($row = mysqli_fetch_array($exp_fetched)) { ?>
                  <tr>
                    <td>
                      <?php echo $count; ?>
                    </td>
                    <td>$
                      <?php echo $row['incomedate']; ?>
                    </td>
                    <td>
                      <?php echo '$' . $row['income']; ?>
                    </td>
                    <td>
                      <?php echo $row['incomecategory']; ?>
                    </td>
                  </tr>
                  <?php $count++;
                } ?>
              </table>
            </div>

          </div>
        </div>
        <h3 class="mt-4">Full-Expense Report</h3>
        <div class="row">
          <!-- Expense Charts -->
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Yearly Expense</h5>
              </div>
              <div class="card-body">
                <canvas id="expense_line" height="150"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Expense Category</h5>
              </div>
              <div class="card-body">
                <canvas id="expense_category_pie" height="150"></canvas>
              </div>
            </div>
          </div>
        </div>
        <h3 class="mt-4">Full-Income Report</h3>
        <div class="row">
          <!-- Income Charts -->
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Yearly Income</h5>
              </div>
              <div class="card-body">
                <canvas id="income_line" height="150"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Income Category</h5>
              </div>
              <div class="card-body">
                <canvas id="income_category_pie" height="150"></canvas>
              </div>
            </div>
          </div>
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
    $("#menu-toggle").click(function (e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
  <script>
    feather.replace()
  </script>

  <!-- Expense Chart Script -->
  <script>
    var expenseCategoryPieCtx = document.getElementById('expense_category_pie').getContext('2d');
    var expenseCategoryPieChart = new Chart(expenseCategoryPieCtx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($exp_categories); ?>,
        datasets: [{
          label: 'Expense by Category',
          data: <?php echo json_encode($exp_amounts); ?>,
          backgroundColor: [
            '#6f42c1',
            '#dc3545',
            '#28a745',
            '#007bff',
            '#ffc107',
            '#20c997',
            '#17a2b8',
            '#fd7e14',
            '#e83e8c',
            '#6610f2'
          ],
          borderWidth: 1
        }]
      }
    });

    var expenseLineCtx = document.getElementById('expense_line').getContext('2d');
    var expenseLineChart = new Chart(expenseLineCtx, {
      type: 'line',
      data: {
        labels: <?php echo json_encode($exp_dates); ?>,
        datasets: [{
          label: 'Expense by Month (Whole Year)',
          data: <?php echo json_encode($exp_line_amounts); ?>,
          borderColor: [
            '#adb5bd'
          ],
          backgroundColor: [
            '#6f42c1',
            '#dc3545',
            '#28a745',
            '#007bff',
            '#ffc107',
            '#20c997',
            '#17a2b8',
            '#fd7e14',
            '#e83e8c',
            '#6610f2'
          ],
          fill: false,
          borderWidth: 2
        }]
      }
    });
  </script>

  <!-- Income Chart Script -->
  <script>
    var incomeCategoryPieCtx = document.getElementById('income_category_pie').getContext('2d');
    var incomeCategoryPieChart = new Chart(incomeCategoryPieCtx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($inc_categories); ?>,
        datasets: [{
          label: 'Income by Category',
          data: <?php echo json_encode($inc_amounts); ?>,
          backgroundColor: [
            '#6f42c1',
            '#dc3545',
            '#28a745',
            '#007bff',
            '#ffc107',
            '#20c997',
            '#17a2b8',
            '#fd7e14',
            '#e83e8c',
            '#6610f2'
          ],
          borderWidth: 1
        }]
      }
    });

    var incomeLineCtx = document.getElementById('income_line').getContext('2d');
    var incomeLineChart = new Chart(incomeLineCtx, {
      type: 'line',
      data: {
        labels: <?php echo json_encode($inc_dates); ?>,
        datasets: [{
          label: 'Income by Month (Whole Year)',
          data: <?php echo json_encode($inc_line_amounts); ?>,
          borderColor: [
            '#adb5bd'
          ],
          backgroundColor: [
            '#6f42c1',
            '#dc3545',
            '#28a745',
            '#007bff',
            '#ffc107',
            '#20c997',
            '#17a2b8',
            '#fd7e14',
            '#e83e8c',
            '#6610f2'
          ],
          fill: false,
          borderWidth: 2
        }]
      }
    });
  </script>
</body>

</html>