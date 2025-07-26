<?php
include "config.php";

$departments = mysqli_query($conn, "SELECT * FROM departments");
$employees = mysqli_query($conn, "SELECT e.emp_id, e.emp_name, d.dept_name FROM employees e JOIN departments d ON e.dept_id = d.dept_id");
?>

<!DOCTYPE html>
<html>
<head><title>Employees</title></head>
<body>

<h2>Add Employee</h2>
<form method="POST" action="insert.php">
    Name: <input type="text" name="emp_name" required>
    Department:
    <select name="dept_id" required>
        <option value="">Select</option>
        <?php while($row = mysqli_fetch_assoc($departments)): ?>
            <option value="<?= $row['dept_id'] ?>"><?= $row['dept_name'] ?></option>
        <?php endwhile; ?>
    </select>
    <button type="submit">Add</button>
</form>

<h2>Employee List</h2>
<table border="1" cellpadding="8">
<tr><th>ID</th><th>Name</th><th>Department</th></tr>
<?php while($row = mysqli_fetch_assoc($employees)): ?>
<tr>
    <td><?= $row['emp_id'] ?></td>
    <td><?= $row['emp_name'] ?></td>
    <td><?= $row['dept_name'] ?></td>
</tr>
<?php endwhile; ?>
</table>

</body>
</html>
