<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy dữ liệu + JOIN bảng chuyên ngành
$sql = "SELECT student.*, major.name_major 
        FROM student 
        LEFT JOIN major ON student.major_id = major.id";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bảng dữ liệu sinh viên</title>
</head>
<body>

<h1>Bảng dữ liệu sinh viên</h1>

<?php
if ($result && $result->num_rows > 0) {

    $result_all = $result->fetch_all(MYSQLI_ASSOC);
?>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>Ngày sinh</th>
        <th>Mã chuyên ngành</th>
        <th>Tên chuyên ngành</th>
        <th colspan="2">Hành động</th>
    </tr>

<?php
    foreach ($result_all as $row) {

        // format ngày
        $date = date_create($row['Birthday']);
        $birthday = $date ? $date->format('d-m-Y') : "";

        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["fullname"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $birthday . "</td>";

        // chuyên ngành
        echo "<td>" . ($row["major_id"] ?? "") . "</td>";
        echo "<td>" . ($row["name_major"] ?? "Chưa có") . "</td>";

        // nút xóa
        echo "<td>";
?>
        <form method="post" action="xoa.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="submit" name="action" value="Xóa">
        </form>
<?php
        echo "</td>";

        // nút sửa
        echo "<td>";
?>
        <form method="post" action="form_sua.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="submit" name="action" value="Sửa">
        </form>
<?php
        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";

} else {
    echo "<p>Không có dữ liệu</p>";
}

$conn->close();
?>

</body>
</html>