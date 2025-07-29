<?php
$conn = new mysqli("localhost", "root", "", "isdb_evidence");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Manufacturer";
$result = $conn->query($sql);

echo "<h2>Manufacturer List</h2>";

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
              <th>ID</th><th>Name</th><th>Address</th><th>Contact</th><th>Action</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['address']}</td>
                <td>{$row['contact_no']}</td>
                <td>
                  <a href='delete.php?type=manufacturer&id={$row['id']}' onclick=\"return confirm('Are you sure?')\">Delete</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No manufacturer found.";
}

$conn->close();
?>
