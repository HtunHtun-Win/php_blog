<?php
  session_start();
  require '../config/config.php';
  require '../common/common.php';
  //check session
  if(empty($_SESSION['user_id']) and empty($_SESSION['logged_in'])){
    header('location: /admin/login.php');
  }
  $id = $_GET['id'] ?? $_POST['id'];
  if ($id) {
    $pdostatement = $pdo->prepare("SELECT * FROM posts WHERE id=$id");
    $pdostatement->execute();
    $data = $pdostatement->fetch();
  }else{
    header("location: index.php");
  }
  if ($_POST) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    //check null
    if (empty($title) || empty($content) ) {
      if (empty($title)) {
        $titleError = "Title can't be null!";
      }
      if (empty($content)) {
        $contentError = "Content can't be null!";
      }
    }else{
      //Have image or not
      if (empty($_FILES['image']['name'])) {
        $sql = "UPDATE posts set title=:title,content=:content WHERE id=:id";
        $pdostatement = $pdo->prepare($sql);
        $pdostatement->execute([
          ':title' => $title,
          ':content' => $content,
          ':id' => $id,
        ]);
        echo "<script>alert('Post updated successfully!');window.location.href='index.php';</script>";
      }else{
        $image = "../images/".$_FILES['image']['name'];
        $fileType = pathinfo($image,PATHINFO_EXTENSION);
        if ( $fileType != 'png' && $fileType != 'jpg' && $fileType != 'jpeg' ) {
          echo "<script>alert('Image must be png,jpg or jpeg!')</script>";
        }else{
          $sql = "UPDATE posts set title=:title,content=:content,image=:image WHERE id=:id";
          move_uploaded_file($_FILES['image']['tmp_name'],$image);
          $pdostatement = $pdo->prepare($sql);
          $pdostatement->execute([
            ':title' => $title,
            ':content' => $content,
            ':image' => $image,
            ':id' => $id,
          ]);
          echo "<script>alert('Post updated successfully!');window.location.href='index.php';</script>";
        }
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
                <h3 class="card-title">Edit Post</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="edit.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" value="<?php echo $data['id'] ?>" name="id">
                  <div class="form-group">
                    <label>Title</label>
                     <span class="text-danger"><?php if($titleError) echo "*".$titleError; ?></span>
                    <input type="text" name="title" class="form-control" value="<?php echo escape($data['title']) ?>">
                  </div>
                  <div class="form-group">
                    <label>Content</label>
                    <span class="text-danger"><?php if($contentError) echo "*".$contentError; ?></span>
                    <textarea name="content" rows="7" class="form-control"><?php
                    echo escape($data['content'])
                    ?></textarea>
                  </div>
                  <div class="form-group">
                    <label>Image</label><br>
                    <img src="<?php echo $data['image'] ?>" width="200px" alt="Image"><br>
                    <input type="file" name="image">
                  </div>
                  <button class="btn btn-primary">Update</button>
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
