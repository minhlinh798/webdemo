<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nhận dữ liệu từ form
    $ten = $conn->real_escape_string($_POST['name']);
    $giasp = $conn->real_escape_string($_POST['giasp']);
    $soluong = $conn->real_escape_string($_POST['soluong']);
    $tongtien = $conn->real_escape_string($_POST['tongtien']);
    $hinhanh = $conn->real_escape_string($_POST['hinhanh']);
    $trangthai = $conn->real_escape_string($_POST['trangthai']);

    // Kiểm tra dữ liệu hợp lệ
    if (empty($ten) || empty($giasp) || empty($soluong) || empty($tongtien) || empty($hinhanh) || empty($trangthai)) {
        echo "Vui lòng điền đầy đủ thông tin.";
    
    } else {
        // Lưu thông tin vào bảng "donhang"
        $sql = "INSERT INTO donhang (ten_sanpham, giasp, soluong, tongtien, hinhanh, trangthai) 
                VALUES ('$ten', '$giasp', '$soluong', '$tongtien', '$hinhanh', '$trangthai')";
        
        if ($conn->query($sql) === TRUE) {
            // echo "Thông tin của bạn đã được gửi thành công!";
        } else {
            echo "Lỗi khi lưu thông tin: " . $conn->error;
        }
    }
} else {
    echo "Phương thức không được hỗ trợ.";
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MIIN FOODS</title>
        <link rel="stylesheet" href="css/thanhtoan.css">
    </head>
    <body>
        <header>
            <div class="logo">
                <img src="imgs/logo.png" alt="Miin Foods">
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">TRANG CHỦ</a></li>
                    <li><a href="gioithieu.php">GIỚI THIỆU</a></li>
                    <li><a href="sanpham.php">SẢN PHẨM</a></li>
                    <li><a href="khuyenmai.php">KHUYẾN MÃI</a></li>
                    <li><a href="lienhe.php">LIÊN HỆ</a></li>
                </ul>
            </nav>
            <div class="buttons">
                <button class="login">
                    <a href="danhnhap.html">ĐĂNG NHẬP</a>
                </button>
            </div>
        </header>

    <div class="payment-form">
        <h2>Thanh Toán</h2>
        <form action="" method="POST">
        
        <label for="name">Họ và Tên</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="amount">Số tiền</label>
        <input type="number" id="amount" name="amount" required>

        <label for="magiamgia">Voucher Giảm Giá</label>
        <input type="magiamgia" id="magiamgia" name="magiamgia">

        <label for="address">Địa Chỉ</label>
        <input type="address" id="address" name="address" required>

        <label for="method">Phương thức thanh toán</label>
        <select id="method" name="method" onchange="toggleExtraFields()" required>
            <option value="">Chọn phương thức</option>
            <option value="cash">Tiền mặt</option>
            <option value="transfer">Chuyển khoản</option>
            <option value="wallet">Ví điện tử</option>
        </select>

        <div class="extra-fields" id="cardFields">
            <label for="card-number">Số thẻ</label>
            <input type="text" id="card-number" name="card-number" placeholder="Nhập số thẻ">
            
            <label for="account-number">Số tài khoản</label>
            <input type="text" id="account-number" name="account-number" placeholder="Nhập số tài khoản">
        </div>

        <div class="extra-fields" id="phoneField">
            <label for="phone">Số điện thoại</label>
            <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại">
        </div>

        <button type="submit">Xác nhận thanh toán</button>
        </form>
    </div>
    </body>
    <script src="./js/checkout.js"></script>
</html>