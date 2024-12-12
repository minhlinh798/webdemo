<?php
session_start();
include "connect.php";
if (!isset($_SESSION['user_id'])) {
    echo "Bạn cần đăng nhập trước khi thanh toán.";
    header('Location: dangnhap.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$voucher_code = isset($_POST['voucher']) ? trim($_POST['voucher']) : '';
$total_price = 0;
$discount = 0;
$final_price = 0;

// Lấy tổng tiền từ bảng giohang
// Giả sử bạn đang lấy thông tin giỏ hàng của người dùng
$query_cart = "SELECT * FROM giohang WHERE user_id = ?";
$stmt_cart = $conn->prepare($query_cart);
$stmt_cart->bind_param("i", $user_id);
$stmt_cart->execute();
$result_cart = $stmt_cart->get_result();

if ($result_cart->num_rows > 0) {
    while ($row = $result_cart->fetch_assoc()) {
        // Nếu chỉ có một món hàng, tổng tiền chỉ là giá trị của món hàng đó
        $total_price += $row['tongtien'];
    }
} else {
    echo "Giỏ hàng trống!";
    exit;
}

// Kiểm tra mã voucher (nếu có)
// Kiểm tra mã voucher
if (!empty($voucher_code)) {
    $query_voucher = "SELECT * FROM voucher WHERE ten_voucher = ?";
    $stmt_voucher = $conn->prepare($query_voucher);
    $stmt_voucher->bind_param("s", $voucher_code);
    $stmt_voucher->execute();
    $result_voucher = $stmt_voucher->get_result();

    if ($result_voucher->num_rows > 0) {
        $voucher = $result_voucher->fetch_assoc();
        // Lấy ngày hiện tại
        $current_date = date("Y-m-d");
        $start_date = date("Y-m-d", strtotime($voucher['ngay_bat_dau']));
        $end_date = date("Y-m-d", strtotime($voucher['ngay_ket_thuc']));

        // Kiểm tra ngày hợp lệ của voucher
        if ($current_date >= $start_date && $current_date <= $end_date) {
            $discount = (float)$voucher['noidung']; // Giảm giá tính theo %
            $final_price = $total_price - ($total_price * $discount / 100); // Tính tổng tiền sau giảm
        } else {
            echo "Voucher đã hết hạn!";
            $final_price = $total_price; // Không áp dụng giảm giá
        }
    } else {
        echo "Voucher không hợp lệ!";
        $final_price = $total_price; // Không áp dụng giảm giá
    }
} else {
    $final_price = $total_price; // Nếu không có voucher
}

// Xử lý thanh toán và lưu vào bảng donhang
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $method = isset($_POST['method']) ? trim($_POST['method']) : '';
    $voucher_code = isset($_POST['voucher']) ? trim($_POST['voucher']) : '';

    // Kiểm tra thông tin bắt buộc
    if (empty($fullname) || empty($email) || empty($address) || empty($method)) {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
        exit;
    }

    // Thêm vào bảng đơn hàng
    $query_insert_order = "INSERT INTO donhang (fullname, email, address, ten_voucher, tongtien_giam, tongtien, trangthai, created_at, user_id)
                           VALUES (?, ?, ?, ?, ?, ?, 'Đang xử lý', NOW(), ?)";
    $stmt_order = $conn->prepare($query_insert_order);
    $voucher_ap_dung = !empty($voucher_code) ? $voucher_code : null;
    $tongtien_giam = $total_price - $final_price;

    $stmt_order->bind_param("ssssdii", $fullname, $email, $address, $voucher_ap_dung, $tongtien_giam, $final_price, $user_id);

    if ($stmt_order->execute()) {
        // Xóa giỏ hàng
        $delete_cart_query = "DELETE FROM giohang WHERE user_id = ?";
        $stmt_delete_cart = $conn->prepare($delete_cart_query);
        $stmt_delete_cart->bind_param("i", $user_id);
        $stmt_delete_cart->execute();

        echo "<script>alert('Thanh toán thành công!');</script>";
        header('Location: lichsumuahang.php');
        exit;
    } else {
        echo "<script>alert('Lỗi khi thanh toán: " . $stmt_order->error . "');</script>";
    }
}
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
            </div>
        </header>

        <div class="payment-form">
            <h2>Thanh Toán</h2>
            <form action="" method="POST">
                <label for="fullname">Họ và Tên</label>
                <input type="text" id="fullname" name="fullname" required placeholder="Nhập họ và tên">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Nhập email">

                <label for="voucher">Nhập mã voucher (nếu có):</label>
                <input type="text" id="voucher" name="voucher" placeholder="Nhập mã giảm giá">
                <button type="button" onclick="applyVoucher()">Áp dụng Voucher</button>

                <p>Tổng tiền: <span id="total-price"><?php echo number_format($total_price); ?> VNĐ</span></p>
                <p>Giảm giá: <span id="discount"><?php echo $discount > 0 ? $discount . "%" : "Không có"; ?></span></p>
                <p>Tổng tiền sau giảm: <span id="final-price"><?php echo number_format( $final_price); ?> VNĐ</span></p>

                <label for="address">Địa chỉ</label>
                <input type="text" id="address" name="address" required placeholder="Nhập địa chỉ nhận hàng">

                <label for="method">Phương thức thanh toán</label>
                <select id="method" name="method" onchange="toggleExtraFields()" required>
                    <option value="">Chọn phương thức</option>
                    <option value="cash">Tiền mặt</option>
                    <option value="transfer">Chuyển khoản</option>
                    <option value="wallet">Ví điện tử</option>
                </select>

                <div class="extra-fields" id="cardFields">
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
    <script>
        function toggleExtraFields() {
            const methodElement = document.getElementById('method');
            const cardFields = document.getElementById('cardFields');
            const phoneField = document.getElementById('phoneField');

            const method = methodElement.value;

            if (method === 'transfer') {
                cardFields.style.display = 'block';
                phoneField.style.display = 'none';
            } else if (method === 'wallet') {
                cardFields.style.display = 'none';
                phoneField.style.display = 'block';
            } else {
                cardFields.style.display = 'none';
                phoneField.style.display = 'none';
            }
        }
        function applyVoucher() {
            const voucherCode = document.getElementById("voucher").value;
            if (!voucherCode) {
                alert("Vui lòng nhập mã voucher!");
                return;
            }
            // Gửi yêu cầu Ajax tới server để kiểm tra voucher
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "ktra_voucher.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.getElementById("discount").innerText = response.discount + "%";
                        document.getElementById("final-price").innerText = response.final_price + " VNĐ";
                    } else {
                        alert("Voucher không hợp lệ hoặc đã hết hạn.");
                        document.getElementById("discount").innerText = "Không có";
                        document.getElementById("final-price").innerText = document.getElementById("total-price").innerText;
                    }
                }
            };
            xhr.send("voucher=" + encodeURIComponent(voucherCode));
        }
    </script>
</html>