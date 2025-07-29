<?php
if (isset($_POST['submit'])) {
    $conn = new mysqli("localhost", "root", "", "isdb_evidence");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];

    $stmt = $conn->prepare("CALL insert_manufacturer(?, ?, ?)");
    $stmt->bind_param("sss", $name, $address, $contact_no);

    if ($stmt->execute()) {
        echo "Manufacturer inserted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
