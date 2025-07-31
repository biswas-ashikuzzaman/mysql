<?php
$conn = new mysqli("localhost", "root", "", "all_sql");

// Handle Insert Manufacturer
if (isset($_POST['add_manufacturer'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    if (!empty($name) && !empty($address) && !empty($contact)) {
        $stmt = $conn->prepare("CALL insert_manufacturer(?, ?, ?)");
        $stmt->bind_param("sss", $name, $address, $contact);
        $stmt->execute();
        $stmt->close();
        mysqli_next_result($conn);
    }
}

// Handle Insert Product
if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $manufacturer_id = $_POST['manufacturer_id'];

    if (!empty($product_name) && !empty($manufacturer_id)) {
        $stmt = $conn->prepare("CALL insert_product(?, ?, ?)");
        $stmt->bind_param("sii", $product_name, $price, $manufacturer_id);
        $stmt->execute();
        $stmt->close();
        mysqli_next_result($conn);
    }
}

// Handle Delete Manufacturer
if (isset($_GET['delete_manufacturer'])) {
    $id = $_GET['delete_manufacturer'];
    $stmt = $conn->prepare("CALL delete_manufacturer_by_id(?)");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    mysqli_next_result($conn);
}

// Get Manufacturers
$manufacturers = $conn->query("CALL get_all_manufacturers()");
mysqli_next_result($conn);

// Get All Products
$products = $conn->query("
    SELECT p.id, p.name AS pname, p.price, m.name AS manufacturer_name
    FROM product p
    JOIN manufacturer m ON p.manufacturer_id = m.id
");

// Get Products with Price > 5000
$expensive_products = $conn->query("SELECT * FROM view_all_products_only");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h2>Add Manufacturer</h2>
    <form method="post" class="mb-4">
        <div class="mb-2">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Address:</label>
            <input type="text" name="address" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Contact No:</label>
            <input type="text" name="contact" class="form-control" required>
        </div>
        <button type="submit" name="add_manufacturer" class="btn btn-primary">Add Manufacturer</button>
    </form>

    <h2>Add Product</h2>
    <form method="post" class="mb-4">
        <div class="mb-2">
            <label>Product Name:</label>
            <input type="text" name="product_name" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Price:</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Manufacturer:</label>
            <select name="manufacturer_id" class="form-control" required>
                <option value="">Select Manufacturer</option>
                <?php
                $manufacturer_list = $conn->query("CALL get_all_manufacturers()");
                while ($row = $manufacturer_list->fetch_assoc()):
                ?>
                    <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                <?php endwhile; mysqli_next_result($conn); ?>
            </select>
        </div>
        <button type="submit" name="add_product" class="btn btn-success">Add Product</button>
    </form>

    <h2>Manufacturer List</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Contact No</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $manufacturer_table = $conn->query("CALL get_all_manufacturers()");
            while ($row = $manufacturer_table->fetch_assoc()):
            ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['address']; ?></td>
                    <td><?= $row['contact_no']; ?></td>
                    <td>
                        <a href="?delete_manufacturer=<?= $row['id']; ?>" onclick="return confirm('Delete this manufacturer and all its products?')" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endwhile; mysqli_next_result($conn); ?>
        </tbody>
    </table>

    <h2>All Product List</h2>
    <table class="table table-bordered table-secondary">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Manufacturer</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($products->num_rows > 0): ?>
                <?php while ($row = $products->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['pname']; ?></td>
                        <td><?= $row['price']; ?></td>
                        <td><?= $row['manufacturer_name']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4" class="text-center">No products found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2 class="mt-5">Products with Price > 5000</h2>
    <table class="table table-bordered table-warning">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Manufacturer</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($expensive_products->num_rows > 0): ?>
                <?php while ($row = $expensive_products->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['pname']; ?></td>
                        <td><?= $row['price']; ?></td>
                        <td><?= $row['manufacturer_name']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4" class="text-center">No products above 5000</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
