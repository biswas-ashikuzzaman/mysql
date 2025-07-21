<?php
$c = mysqli_connect("localhost", "root", "", "my_first_db");

if (!$c) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Table</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>Student Information</h2>
    <table class="table table-bordered">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Contact</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $users = $c->query("SELECT * FROM users");

        while (list($id, $name, $email, $contact) = $users->fetch_row()) {
            echo "<tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$email</td>
                    <td>$contact</td>
                  </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
