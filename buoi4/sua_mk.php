<?php
session_start();

// kiểm tra đăng nhập
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Lỗi kết nối: " . $conn->connect_error);
}

$thongbao = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $re_pass  = $_POST['re_pass'];

    $id = $_SESSION['id'];

    // lấy mật khẩu hiện tại trong DB
    $sql = "SELECT password FROM customers WHERE id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $current_pass = $row['password'];

    // mã hóa mật khẩu nhập vào
    $old_pass_md5 = md5($old_pass);

    // ====== KIỂM TRA ======

    // 1. mật khẩu cũ có đúng không
    if ($old_pass_md5 != $current_pass) {
        $thongbao = "❌ Mật khẩu cũ không đúng!";
    }

    // 2. mật khẩu mới nhập lại có khớp không
    elseif ($new_pass != $re_pass) {
        $thongbao = "❌ Mật khẩu mới không khớp!";
    }

    // 3. mật khẩu mới không được trùng mật khẩu cũ
    elseif (md5($new_pass) == $current_pass) {
        $thongbao = "❌ Mật khẩu mới phải khác mật khẩu cũ!";
    }

    // ====== HỢP LỆ ======
    else {
        $new_pass_md5 = md5($new_pass);

        $update = "UPDATE customers SET password='$new_pass_md5' WHERE id='$id'";

        if ($conn->query($update) === TRUE) {
            $thongbao = "✅ Đổi mật khẩu thành công!";
        } else {
            $thongbao = "❌ Lỗi cập nhật!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đổi mật khẩu</title>
</head>
<body>

<h2>Đổi mật khẩu</h2>

<form method="post">

    Mật khẩu cũ:<br>
    <input type="password" name="old_pass" required><br><br>

    Mật khẩu mới:<br>
    <input type="password" name="new_pass" required><br><br>

    Nhập lại mật khẩu mới:<br>
    <input type="password" name="re_pass" required><br><br>

    <input type="submit" value="Đổi mật khẩu">

</form>

<br>
<?php echo $thongbao; ?>

<br><br>
<a href="homepage.php">⬅ Quay về trang chủ</a>

</body>
</html>

<?php
$conn->close();
?>