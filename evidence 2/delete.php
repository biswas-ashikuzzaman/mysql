<?php
$conn = new mysqli("localhost", "root", "", "isdb_evidence");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = $_GET['type'];
$id = $_GET['id'];

if ($type == "manufacturer") {
    $sql = "DELETE FROM Manufacturer WHERE id=$id";
    $redirect = "manufacturer_list.php";
} elseif ($type == "product") {
    $sql = "DELETE FROM Product WHERE id=$id";
    $redirect = "product_list.php";
} else {
    die("Invalid type!");
}

if ($conn->query($sql) === TRUE) {
    header("Location: $redirect");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
