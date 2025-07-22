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
}<?php
$c = mysqli_connect("localhost", "root", "", "my_first_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST["name"];
    $email   = $_POST["email"];
    $contact = $_POST["contact"];

    $q = "INSERT INTO users (name, email, contact) VALUES ('$name', '$email', '$contact')";

    if (mysqli_query($c, $q)) {
        header("Location: view.php");
    } else {
        echo "Error: " . mysqli_error($c);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Add New User</h3>
    <form method="POST">
        <input class="form-control mb-2" type="text" name="name" placeholder="Name" required>
        <input class="form-control mb-2" type="email" name="email" placeholder="Email" required>
        <input class="form-control mb-2" type="text" name="contact" placeholder="Contact" required>
        <button class="btn btn-primary">Save</button>
        <a href="view.php" class="btn btn-secondary">View All</a>
    </form>
</div>
</body>
</html>

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
