<?php
$conn = mysqli_connect("localhost", "root", "", "mydb");

if (!$conn) {
    die("Database connection failed");
}

// All Products
$all = $conn->query("SELECT * FROM Product");

// High Price View
$view = $conn->query("SELECT * FROM view_high_price");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <style>
        table {
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px 12px;
        }
        th {
            background-color: #ddd;
        }
        h2 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h2>📦 All Products</h2>
<table>
    <tr>
        <th>ID</th><th>Name</th><th>Price</th><th>Manufacturer ID</th>
    </tr>
    <?php while ($row = $all->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['price'] ?></td>
        <td><?= $row['manufacturer_id'] ?></td>
    </tr>
    <?php } ?>
</table>

<h2>💰 Products with Price > 5000</h2>
<table>
    <tr>
        <th>ID</th><th>Name</th><th>Price</th><th>Manufacturer ID</th>
    </tr>
    <?php
    if ($view->num_rows > 0) {
        while ($row = $view->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['manufacturer_id'] ?></td>
        </tr>
    <?php }
    } else {
        echo "<tr><td colspan='4'>No product with price > 5000</td></tr>";
    }
    ?>
</table>

</body>
</html>
