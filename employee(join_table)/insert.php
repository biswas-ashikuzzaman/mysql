<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_name = $_POST["emp_name"];
    $dept_id = $_POST["dept_id"];

    $sql = "INSERT INTO employees (emp_name, dept_id) VALUES ('$emp_name', $dept_id)";
    mysqli_query($conn, $sql);

    header("Location: index.php");
}
?>
