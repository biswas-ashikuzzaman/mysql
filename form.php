<?php
$c = mysqli_connect("localhost", "root", "", "my_first_db");

if (!$c) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST["name"];
    $email   = $_POST["email"];
    $contact = $_POST["contact"];

    $insert = "INSERT INTO users (name, email, contact) VALUES ('$name', '$email', '$contact')";
    
    if (mysqli_query($c, $insert)) {
        echo "<div class='alert alert-success'>Data inserted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($c) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Insert Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Add Student</h2>
  <form method="POST" action="">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Contact</label>
      <input type="text" name="contact" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Insert</button>
    <a href="view.php" class="btn btn-secondary">View Students</a>
  </form>
</div>
</body>
</html>
