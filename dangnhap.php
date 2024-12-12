<?php
session_start();
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {
            // Lưu thông tin vào session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['icon'] = isset($user['icon']) ? $user['icon'] : null;
            echo "<script>
                    alert('Đăng nhập thành công!');
                    window.location.href = 'index.php';
                  </script>";
            exit();
        } else {
            echo "<script>alert('Sai mật khẩu!');</script>";
        }
    } else {
        echo "<script>alert('Tên đăng nhập không tồn tại!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/login.css">
        <title>Đăng nhập</title>
    </head>
    <body>
        <form action="" method="POST">
            <h1>Đăng nhập</h1>

            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Đăng nhập</button>
            <div class="text-center">
                <a class="small" href="dangky.php">Tạo tài khoản!</a>
            </div>
        </form>
    </body>
</html>
