<?php
$c = mysqli_connect("localhost", "root", "", "my_first_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST["name"];
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
