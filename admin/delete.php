<?php 

	require '../config/config.php';
	$id = $_GET['id'];
	$pdostatement = $pdo->prepare("DELETE FROM posts WHERE id=$id");
	$pdostatement->execute();
	header('location: index.php');

?>