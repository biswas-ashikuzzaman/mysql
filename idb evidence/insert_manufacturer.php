<?php
if (isset($_POST['submit'])) {
   $conn = mysqli_connect("localhost", "root", "", "mydb");


    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $stmt = $conn->prepare("CALL insert_manufacturer(?, ?, ?)");
    $stmt->bind_param("sss", $name, $address, $contact);
    $stmt->execute();

    echo "Manufacturer inserted successfully!";
}
?>

<form method="post">
    Name: <input type="text" name="name"><br>
    Address: <input type="text" name="address"><br>
    Contact: <input type="text" name="contact"><br>
    <input type="submit" name="submit" value="Add Manufacturer">
</form>