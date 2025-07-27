<?php
$conn = mysqli_connect("localhost", "root", "", "mydb");

// Insert product when form is submitted
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $manufacturer_id = $_POST['manufacturer_id'];

    $stmt = $conn->prepare("INSERT INTO Product (name, price, manufacturer_id) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $name, $price, $manufacturer_id);
    $stmt->execute();

    echo "<p style='color:green;'>✅ Product inserted successfully!</p>";
}

// Get all manufacturers for dropdown
$manufacturers = $conn->query("SELECT id, name FROM Manufacturer");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>

<h2>Add Product</h2>

<form method="post">
    Product Name: <input type="text" name="name" required><br><br>
    Price: <input type="number" name="price" required><br><br>
    
    Manufacturer: 
    <select name="manufacturer_id" required>
        <option value="">-- Select Manufacturer --</option>
        <?php while ($row = $manufacturers->fetch_assoc()) { ?>
            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
        <?php } ?>
    </select><br><br>

    <input type="submit" name="submit" value="Add Product">
</form>

</body>
</html>
