<?php include "connect.php"; ?>

<h2>DANH SÁCH CHUYÊN NGÀNH</h2>

<a href="major_add.php">Thêm chuyên ngành</a><br><br>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Tên chuyên ngành</th>
    <th>Hành động</th>
</tr>

<?php
$sql = "SELECT * FROM major";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
    echo "<tr>
            <td>".$row["id"]."</td>
            <td>".$row["name_major"]."</td>
            <td>
                <a href='major_edit.php?id=".$row["id"]."'>Sửa</a> |
                <a href='major_xoa.php?id=".$row["id"]."' onclick='return confirm(\"Xóa?\")'>Xóa</a>
            </td>
          </tr>";
}
?>

</table>