<?php
session_start();
include "connect.php";

if (!isset($_SESSION['user_id'])) {
    echo "Bạn cần đăng nhập để xem lịch sử mua hàng.";
    header('Location: dangnhap.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Lấy danh sách đơn hàng của người dùng
$query_orders = "SELECT * FROM donhang WHERE user_id = ? ORDER BY created_at DESC";
$stmt_orders = $conn->prepare($query_orders);
$stmt_orders->bind_param("i", $user_id);
$stmt_orders->execute();
$result_orders = $stmt_orders->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử mua hàng</title>
    <link rel="stylesheet" href="css/ls.css">
</head>
<body>
    <h1>Lịch sử mua hàng</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Ngày đặt</th>
                <th>Tên Người Mua</th>
                <th>Tổng tiền</th>
                <th>Voucher áp dụng</th>
                <th>Giảm giá</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result_orders->num_rows > 0): ?>
                <?php while ($order = $result_orders->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $order['id_donhang']; ?></td>
                        <td><?php echo date("d/m/Y H:i:s", strtotime($order['created_at'])); ?></td>
                        <td><?php echo $order['fullname']; ?></td>
                        <td><?php echo number_format($order['tongtien']); ?> VNĐ</td>
                        <td><?php echo !empty($order['ten_voucher']) ? $order['ten_voucher'] : "Không áp dụng"; ?></td>
                        <td><?php echo number_format($order['tongtien_giam']); ?> VNĐ</td>
                        <td><?php echo $order['trangthai']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Bạn chưa có đơn hàng nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="index.php">Quay lại trang chủ</a>
</body>
</html>
