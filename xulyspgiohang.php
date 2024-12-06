<?php
session_start();
include "connect.php";

// Lấy product_id từ POST
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

if ($user_id === 0 || $product_id === 0) {
    echo json_encode(['error' => 'Người dùng hoặc sản phẩm không hợp lệ!']);
    exit;
}

// Kiểm tra sản phẩm có tồn tại không
$query = "SELECT * FROM sanpham WHERE id_sanpham = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    echo json_encode(['error' => 'Sản phẩm không tồn tại!']);
    exit;
}

// Kiểm tra sản phẩm đã có trong giỏ hàng chưa
$query = "SELECT * FROM giohang WHERE id_sanpham = ? AND user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $product_id, $user_id);
$stmt->execute();
$cart_item = $stmt->get_result()->fetch_assoc();

if ($cart_item) {
    // Cập nhật số lượng nếu sản phẩm đã có trong giỏ hàng
    $new_quantity = $cart_item['quantity'] + 1;
    $new_total = $new_quantity * $product['giasp'];
    $update_query = "UPDATE giohang SET quantity = ?, tongtien = ? WHERE id_giohang = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("iii", $new_quantity, $new_total, $cart_item['id_giohang']);
    $stmt->execute();
} else {
    // Thêm sản phẩm mới vào giỏ hàng
    $quantity = 1;
    $tongtien = $product['giasp'] * $quantity;
    $insert_query = "INSERT INTO giohang (id_sanpham, ten_sanpham, anh, giasp, quantity, tongtien, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("issiiii", $product['id_sanpham'], $product['ten_sanpham'], $product['anh'], $product['giasp'], $quantity, $tongtien, $user_id);
    $stmt->execute();
}

// Tính lại tổng số sản phẩm trong giỏ hàng (dựa trên tất cả sản phẩm)
$total_query = "SELECT SUM(quantity) AS total_items FROM giohang WHERE user_id = ?";
$stmt = $conn->prepare($total_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$total_result = $stmt->get_result()->fetch_assoc();
$total_items = $total_result['total_items'] ?? 0;

// Gửi phản hồi JSON
echo json_encode(['success' => 'Thêm sản phẩm thành công!', 'totalItems' => $total_items]);
exit;
