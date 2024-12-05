<?php
include "connect.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_giohang = $_POST['id_giohang'];
    $new_quantity = $_POST['product_quantity'];

    // Lấy giá sản phẩm để cập nhật tổng tiền
    $query = "SELECT giasp FROM giohang WHERE id_giohang = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_giohang);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $new_total = $new_quantity * $row['giasp'];

    // Cập nhật số lượng và tổng tiền
    $update_query = "UPDATE giohang SET quantity = ?, tongtien = ? WHERE id_giohang = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("iii", $new_quantity, $new_total, $id_giohang);
    $stmt->execute();

    header("Location: giohang.php");
    exit();
}
?>
