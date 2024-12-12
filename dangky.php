<?php
    include "connect.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // Kiểm tra xem tài khoản đã tồn tại chưa
        $checkQuery = "SELECT * FROM users WHERE username = ? OR email = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("ss", $username, $email);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            echo "<script>alert('Tên đăng nhập hoặc email đã tồn tại! Vui lòng thử lại.');</script>";
        } else {
            $query = "INSERT INTO users (fullname, username, password, email) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $fullname, $username, $password, $email);

            if ($stmt->execute()) {
                echo "<script>
                        alert('Đăng ký tài khoản thành công!');
                        window.location.href = 'dangnhap.php';
                    </script>";
                exit();
            } else {
                echo "<script>alert('Đăng ký thất bại! Vui lòng thử lại.');</script>";
            }
            $stmt->close();
        }
        $checkStmt->close();
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

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Đăng ký</button>
    </form>
</body>
</html>
