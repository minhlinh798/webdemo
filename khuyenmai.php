<?php
    include "connect.php";
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MIIN FOODS</title>
        <link rel="stylesheet" href="css/km.css">
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
            <div class="buttons"></div>
        </header>
        <div class="promotion">
            <h1>🎉 SIÊU KHUYẾN MÃI CUỐI NĂM 🎉</h1>
            <?php
                // Truy vấn danh sách voucher
                $sql = "SELECT * FROM voucher ORDER BY id_voucher DESC";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
            ?>
            <div class="voucher">
                <h2>Mã: <?php echo $row['ten_voucher']; ?></h2>
                <p>giá trị mã được giảm giá: <?php echo $row['noidung']; ?>%</p>
                <p>ngày bắt đầu mã: <?php echo $row['ngay_bat_dau']; ?></p>
                <p>ngày kết thúc mã: <?php echo $row['ngay_ket_thuc']; ?></p>
            </div>
            <?php
                }
            }
            ?>
            <p>Lưu ý: Mã voucher không được kết hợp với các chương trình khuyến mãi khác. Mỗi mã voucher chỉ sử dụng được một lần.</p>
        </div>
    </body>
</html>