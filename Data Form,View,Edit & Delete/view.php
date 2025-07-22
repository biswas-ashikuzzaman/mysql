<?php
$c = mysqli_connect("localhost", "root", "", "my_first_db");

$users = $c->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>
<body>
<div class="container mt-4">
    <h3>User List</h3>
    <a href="form.php" class="btn btn-success mb-2">Add New</a>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Contact</th><th>Action</th></tr>
        </thead>
        <tbody>
        <?php while ($row = $users->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['contact']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
  <i class="bi bi-pencil-square"></i>
</a>

<a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Delete this user?')" class="btn btn-danger btn-sm">
  <i class="bi bi-trash"></i>
</a>

                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
