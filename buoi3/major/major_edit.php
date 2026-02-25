<?php
include "connect.php";

$id = $_GET["id"];

$sql = "SELECT * FROM major WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<h2>SỬA CHUYÊN NGÀNH</h2>

<form action="major_edit_save.php" method="post">
    ID: <input type="text" name="id" value="<?php echo $row["id"]; ?>" readonly><br><br>
    Tên chuyên ngành: <input type="text" name="name_major" value="<?php echo $row["name_major"]; ?>"><br><br>

    <input type="submit" value="Lưu">
</form>