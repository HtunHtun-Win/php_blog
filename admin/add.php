<?php
  session_start();
  require '../config/config.php';
  //check session
  if(empty($_SESSION['user_id']) and empty($_SESSION['logged_in'])){
    header('location: /admin/login.php');
  }
  if ($_POST) {
    //Image file
    $image = "../images/".$_FILES['image']['name'];
    $fileType = pathinfo($image,PATHINFO_EXTENSION);
    //Post data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_SESSION['user_id'];
    if (empty($title) || empty($content) || empty($_FILES['image']['name'])) {
      if (empty($title)) {
        $titleError = "Title can't be null!";
      }
      if (empty($content)) {
        $contentError = "Content can't be null!";
      }
      if (empty($_FILES['image']['name'])) {
        $imageError = "Image Can't be null!";
      }
    }else{
      if ( $fileType != 'png' && $fileType != 'jpg' && $fileType != 'jpeg' ) {
        echo "<script>alert('Image must be png,jpg or jpeg!')</script>";
      }else{
        move_uploaded_file($_FILES['image']['tmp_name'],$image);
        $sql = "INSERT INTO posts(title,content,image,author_id) VALUES(:title,:content,:image,:author_id)";
        $pdostatement = $pdo->prepare($sql);
        $pdostatement->execute([
          ':title' => $title,
          ':content' => $content,
          ':image' => $image,
          ':author_id' => $author,
        ]);
        echo "<script>alert('New post added successfully!')</script>";
      }
    }
    
  }
?>

    <?php include "header.html"; ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add Post</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Title</label>
                    <span class="text-danger"><?php if($titleError) echo "*".$titleError; ?></span>
                    <input type="text" name="title" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Content</label>
                    <span class="text-danger"><?php if($contentError) echo "*".$contentError; ?></span>
                    <textarea name="content" rows="8" class="form-control" required></textarea>
                  </div>
                  <div class="form-group">
                    <label>Image</label>
                    <span class="text-danger"><?php if($imageError) echo "*".$imageError; ?></span>
                    <br><input type="file" name="image" required>
                  </div>
                  <button class="btn btn-primary">Submit</button>
                  <a href="index.php" class="btn btn-warning">Back</a>
                </form>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <?php include 'footer.html'; ?>
