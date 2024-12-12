<?php
$conn = new mysqli('localhost', 'root', '', 'webdemo');
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
$id_donhang = isset($_GET['id']) ? $_GET['id'] : null;
if ($id_donhang) {
    $sql = "UPDATE donhang SET trangthai = 'Đã duyệt' WHERE id_donhang = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_donhang);
    if ($stmt->execute()) {
        header("Location: qldh.php");
        exit;
    } else {
        echo "Lỗi khi duyệt đơn hàng.";
    }
    $stmt->close();
} else {
    echo "Không tìm thấy đơn hàng.";
}
$conn->close();
?>
