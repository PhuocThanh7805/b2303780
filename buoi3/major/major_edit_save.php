<?php
include "connect.php";

$id = $_POST["id"];
$name = $_POST["name_major"];

$sql = "UPDATE major SET name_major='$name' WHERE id='$id'";

if($conn->query($sql)){
    header("Location: major_index.php");
} else {
    echo "Lỗi: ".$conn->error;
}
?>