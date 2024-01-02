<?php
  session_start();
  require 'config/config.php';
  //check session
  if(empty($_SESSION['user_id']) and empty($_SESSION['logged_in'])){
    header('location: login.php');
  }
  $post_id = $_GET['detail'];
  $pdostatement = $pdo->prepare("SELECT * FROM posts WHERE id=$post_id");
  $pdostatement->execute();
  $data = $pdostatement->fetch();

  //add comment;
  if ($_POST['comment']) {
    $newComment = $_POST['comment'];
    $cmt_sql = "INSERT INTO comments(content,author_id,post_id) VALUES(:content,:author_id,:post_id)";
    $cmt_statement = $pdo->prepare($cmt_sql);
    $cmt_statement->execute([
      ':content' => $newComment,
      ':author_id' => $_SESSION['user_id'],
      ':post_id' => $post_id,
    ]);
  }

  //get comments
  $getCmtSql = "select comments.id,comments.content,comments.post_id,comments.created_at,users.name from comments left join users on comments.author_id=users.id where post_id=:post_id";
  $get_cmt_stat = $pdo->prepare($getCmtSql);
  $get_cmt_stat->execute([
    ':post_id' => $post_id,
  ]);
  $comments = $get_cmt_stat->fetchAll();

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
  <style type="text/css">
    .content{
      margin: 0px 500px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="">

  <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <h2 class="text-center"><?php echo $data['title'] ?></h2>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
                <!-- <div class="user-block"> -->
                  <strong><span class="username"><?php echo "Admin" ?></span></strong><br>
                  <span class="description"><?php echo $data['created_at'] ?></span>
                <!-- </div>  -->
                <!-- /.user-block -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <img class="img-fluid pad" src="<?php echo $data['image'] ?>" width="100%" alt="Photo">

                <p><?php echo $data['content'] ?></p>
              </div>
              <!-- /.card-body -->
              <div class="card-footer card-comments" >
                <div class="card-comment">
                  <h4 class="text-primary">Comment</h4>
                  <?php foreach($comments as $comment): ?>
                    <div class="comment-text" style="margin-left: 0px;">
                      <span class="username">
                        <?php echo $comment['name'] ?>
                        <span class="text-muted float-right"><?php echo $comment['created_at'] ?></span>
                      </span><!-- /.username -->
                      <?php echo $comment['content'] ?>
                    </div>
                  <?php endforeach; ?>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <form action="blogdetail.php?detail=<?php echo $post_id ?>" method="post">
                  <div class="img-push">
                    <input name="comment" type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
                  </div>
                </form>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
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
      <form action="logout.php">
        <a class="btn btn-danger btn-sm" href="index.php">Home</a>
        <button class="btn btn-danger btn-sm">Logout</button>
      </form>
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