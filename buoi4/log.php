<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST["email"];
$pass = md5($_POST["pass"]);

$sql = "SELECT id, fullname, email FROM customers 
        WHERE email='$email' AND password='$pass'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    // ❗ THAY COOKIE = SESSION
    $_SESSION["user"] = $row['email'];
    $_SESSION["fullname"] = $row['fullname'];
    $_SESSION["id"] = $row['id'];

    header('Location: homepage.php');
    exit();

} else {
    echo "Sai thong tin dang nhap";
    header('Refresh: 3;url=login.php');
}

$conn->close();
?>