<?php
include "connect.php";

$id = $_GET["id"];

$sql = "DELETE FROM major WHERE id='$id'";

if($conn->query($sql)){
    header("Location: major_index.php");
} else {
    echo "Lỗi: ".$conn->error;
}
?>