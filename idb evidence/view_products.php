<?php
$conn = mysqli_connect("localhost", "root", "", "mydb");

$result = $conn->query("SELECT * FROM view_high_price");

echo "<table border='1'>
<tr><th>ID</th><th>Name</th><th>Price</th><th>Manufacturer ID</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['price']}</td>
        <td>{$row['manufacturer_id']}</td>
    </tr>";
}
echo "</table>";
?>