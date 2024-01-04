<?php
  session_start();
  require 'config/config.php';
  //check session
  if(empty($_SESSION['user_id']) and empty($_SESSION['logged_in'])){
    header('location: login.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Widgets</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left:0px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <h2 class="text-center">Blog Site</h2>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
      // $pdostatement = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
      // $pdostatement->execute();
      // $results = $pdostatement->fetchAll();
    if (!empty($_GET['pageno'])) {
                  $pageno = $_GET['pageno'];
                }else{
                  $pageno = 1;
                }
                $numOfrecs = 6;
                $offset = ($pageno-1)*$numOfrecs;
                if (empty($_POST['search'])) {
                  //Get Total Pagesr
                  $pdostatement = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
                  $pdostatement->execute();
                  $rawresults = $pdostatement->fetchAll();
                  $total_pages = ceil(count($rawresults)/$numOfrecs);
                  //
                  $pdostatement = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT $offset,$numOfrecs");
                  $pdostatement->execute();
                  $results = $pdostatement->fetchAll();
                }else{
                  $search = $_POST['search'];
                  echo $search;
                  //Get Total Pages
                  $pdostatement = $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$search%' ORDER BY id DESC");
                  $pdostatement->execute();
                  $rawresults = $pdostatement->fetchAll();
                  $total_pages = ceil(count($rawresults)/$numOfrecs);
                  //
                  $pdostatement = $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$search%' ORDER BY id DESC LIMIT $offset,$numOfrecs");
                  $pdostatement->execute();
                  $results = $pdostatement->fetchAll();
                }
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <?php foreach($results as $result): ?>
          <div class="col-md-4">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
                <h4 class="text-center"><?php echo $result['title'] ?></h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="text-center">
                  <a href="blogdetail.php?detail=<?php echo $result['id'] ?>">
                    <img class="img-fluid pad" src="<?php echo $result['image'] ?>" style="height: 200px;">
                  </a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        <?php endforeach; ?>
      </div>
          <!-- row -->
        <div class="row" style="float:right;margin-left:0px;">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item"> <a class="page-link" href="?pageno=1">First</a> </li>
              <li class="page-item <?php if($pageno<=1){echo 'disabled';} ?>">
                <a class="page-link " href="?pageno=<?php echo $pageno-1; ?>">Previous</a>
              </li>
              <li class="page-item"> <a class="page-link" href="#"><?php echo $pageno; ?></a> </li>
              <li class="page-item <?php if($pageno >= $total_pages){echo 'disabled';} ?>">
                <a class="page-link" href="?pageno=<?php echo $pageno+1; ?>">Next</a>
              </li>
              <li class="page-item"> <a class="page-link" href="?pageno=<?php echo $total_pages ?>">Last</a> </li>
            </ul>
          </nav>
        </div><br><br>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="margin-left: 0px;">
    <div class="float-right d-none d-sm-block">
      <a class="btn btn-danger" href="logout.php">Logout</a>
    </div>
    <strong>Copyright &copy; 2024 <a href="#">RobotSixteen</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
