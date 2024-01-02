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
      $pdostatement = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
      $pdostatement->execute();
      $results = $pdostatement->fetchAll();
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
    </section>
    <!-- /.content -->

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="margin-left: 0px;">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
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
