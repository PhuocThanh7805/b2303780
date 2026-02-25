<?php include "connect.php"; ?>

<h2>THÊM CHUYÊN NGÀNH</h2>

<form method="post">
    ID: <input type="text" name="id"><br><br>
    Tên chuyên ngành: <input type="text" name="name_major"><br><br>

    <input type="submit" name="them" value="Thêm">
</form>

<?php
if(isset($_POST["them"])){
    $id = $_POST["id"];
    $name = $_POST["name_major"];

    $sql = "INSERT INTO major VALUES('$id','$name')";

    if($conn->query($sql)){
        header("Location: major_index.php");
    } else {
        echo "Lỗi: ".$conn->error;
    }
}
?>