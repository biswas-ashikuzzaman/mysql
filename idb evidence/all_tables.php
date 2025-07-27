<?php
$conn = mysqli_connect("localhost", "root", "", "mydb");

if (!$conn) {
    die("Database connection failed");
}

// Fetch all Manufacturer
$manufacturer = $conn->query("SELECT * FROM Manufacturer");

// Fetch all Product
$product = $conn->query("SELECT * FROM Product");

// Join Manufacturer + Product
$all_join = $conn->query("
    SELECT Product.id, Product.name AS product_name, Product.price,
           Manufacturer.name AS manufacturer_name
    FROM Product
    INNER JOIN Manufacturer ON Product.manufacturer_id = Manufacturer.id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Tables</title>
    <style>
        table {
            border-collapse: collapse;
            margin-bottom: 40px;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px 12px;
        }
        th {
            background-color: #eee;
        }
        h2 {
            margin-top: 40px;
        }
    </style>
</head>
<body>

<h2>🏢 Manufacturer Table</h2>
<table>
    <tr>
        <th>ID</th><th>Name</th><th>Address</th><th>Contact No</th>
    </tr>
    <?php while ($row = $manufacturer->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['address'] ?></td>
        <td><?= $row['contact_no'] ?></td>
    </tr>
    <?php } ?>
</table>

<h2>📦 Product Table</h2>
<table>
    <tr>
        <th>ID</th><th>Name</th><th>Price</th><th>Manufacturer ID</th>
    </tr>
    <?php while ($row = $product->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['price'] ?></td>
        <td><?= $row['manufacturer_id'] ?></td>
    </tr>
    <?php } ?>
</table>

<h2>🧾 All Products with Manufacturer Name (JOIN)</h2>
<table>
    <tr>
        <th>Product ID</th><th>Product Name</th><th>Price</th><th>Manufacturer Name</th>
    </tr>
    <?php while ($row = $all_join->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['product_name'] ?></td>
        <td><?= $row['price'] ?></td>
        <td><?= $row['manufacturer_name'] ?></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
