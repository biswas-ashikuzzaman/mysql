<?php
$c = mysqli_connect("localhost", "root", "", "my_first_db");

$id = $_GET['id'];

mysqli_query($c, "DELETE FROM users WHERE id=$id");

header("Location: view.php");
?>
