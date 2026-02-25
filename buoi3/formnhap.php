<?php
$conn = new mysqli("localhost", "root", "", "qlsv");
if ($conn->connect_error) {
    die("Loi ket noi: " . $conn->connect_error);
}

// lấy danh sách chuyên ngành
$sql_major = "SELECT * FROM major";
$result_major = $conn->query($sql_major);
?>

<!DOCTYPE HTML>
<html>
<body>

<h2>Thêm sinh viên</h2>

<form action="luu.php" method="post">
    Name: <input type="text" name="name" required><br><br>
    E-mail: <input type="text" name="email" required><br><br>
    Birthday: <input type="date" name="birth" required><br><br>

    Chuyên ngành:
    <select name="major_id" required>
        <option value="">-- Chọn chuyên ngành --</option>
        <?php
        if ($result_major->num_rows > 0) {
            while ($row = $result_major->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['name_major'] . "</option>";
            }
        }
        ?>
    </select>
    <br><br>

    <input type="submit" value="Thêm">
</form>

</body>
</html>

<?php $conn->close(); ?>