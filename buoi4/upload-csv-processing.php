<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";

// kết nối DB
$conn = new mysqli($servername, $username, $password, $dbname);

// check lỗi
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// kiểm tra có upload file không
if(isset($_POST["submit"])){

    $file = $_FILES["file"]["tmp_name"];

    if($_FILES["file"]["size"] > 0){

        $handle = fopen($file, "r");

        // bỏ dòng header
        fgetcsv($handle);

        while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){

            $fullname = $conn->real_escape_string($data[0]);
            $email    = $conn->real_escape_string($data[1]);
            $birthday = $conn->real_escape_string($data[2]);
            $reg_date = $conn->real_escape_string($data[3]);
            $password = $conn->real_escape_string($data[4]);

            $sql = "INSERT INTO customers(fullname, email, Birthday, reg_date, password)
                    VALUES('$fullname', '$email', '$birthday', '$reg_date', '$password')";

            $conn->query($sql);
        }

        fclose($handle);

        echo "Import CSV thành công!";
    } else {
        echo "File rỗng!";
    }
}

$conn->close();

?>