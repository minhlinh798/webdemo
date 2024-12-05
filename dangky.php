<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Mã hóa mật khẩu

    // Thêm người dùng vào cơ sở dữ liệu
    $query = "INSERT INTO users (fullname, username, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $fullname, $username, $password);

    if ($stmt->execute()) {
        // Nếu thêm thành công, điều hướng tới trang đăng nhập
        echo "<script>
                alert('Đăng ký tài khoản thành công!');
                window.location.href = 'dangnhap.php';
              </script>";
        exit;
    } else {
        // Nếu xảy ra lỗi, hiển thị thông báo lỗi
        echo "<script>alert('Đăng ký thất bại! Vui lòng thử lại.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <title>Đăng ký</title>
</head>
<body>
    <form action="" method="POST">
        <h1>Đăng ký tài khoản</h1>

        <label for="fullname">Họ và tên:</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Đăng ký</button>
    </form>
</body>
</html>
