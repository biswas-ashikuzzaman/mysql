<?php
$c = mysqli_connect("localhost", "root", "", "my_first_db");

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM users WHERE id=$id"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST["name"];
    $email   = $_POST["email"];
    $contact = $_POST["contact"];

    mysqli_query($c, "UPDATE users SET name='$name', email='$email', contact='$contact' WHERE id=$id");
    header("Location: view.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Edit User</h3>
    <form method="POST">
        <input class="form-control mb-2" type="text" name="name" value="<?= $data['name']; ?>" required>
        <input class="form-control mb-2" type="email" name="email" value="<?= $data['email']; ?>" required>
        <input class="form-control mb-2" type="text" name="contact" value="<?= $data['contact']; ?>" required>
        <button class="btn btn-primary">Update</button>
        <a href="view.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
