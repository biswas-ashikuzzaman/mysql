<?php
$conn = new mysqli("localhost", "root", "", "isdb_evidence");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM expensive_products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h3>Products Price > 5000</h3>";
    echo "<table border='1'>
            <tr>
              <th>ID</th><th>Name</th><th>Price</th><th>Manufacturer ID</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['price']}</td>
                <td>{$row['manufacturer_id']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No products found.";
}

$conn->close();
?>
