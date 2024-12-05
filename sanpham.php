<?php
include "connect.php";
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MIIN FOODS</title>
        <link rel="stylesheet" href="css/styles.css">
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
            <style>
                .cart-count {
                    position: absolute;
                    top: 12px;
                    right: 45px;
                    background-color: #f7f7fd;
                    color: #050505;
                    font-size: 12px;
                    padding: 4px 8px;
                    border-radius: 50%;
                    font-weight: bold;
                }
            </style>
            <div class="buttons">
                <a href="giohang.php">
                    <svg class="member" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                    </svg>
                    <span class="cart-count">0</span>
                </a>
            </div>
        </header>
        <img src="imgs/banner2.png" alt="Ảnh từ thư mục cục bộ" width="100%" height="500px">
        <main>
            <div class="mainlist-top">
                <div class="nav">
                    <h1>Các Sản Phẩm Của Shop</h1>
                    <img src="imgs/logo1.png">
                </div>
                <div class="mainlist">
                    <ul class="product_list">
                        <?php
                            // Truy vấn danh sách sản phẩm
                            $sql = "SELECT * FROM sanpham ORDER BY id_sanpham DESC";
                            $result = $conn->query($sql);

                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                        ?>
                        <li>
                        <a class="product" href="chitietsp.php?id=<?php echo $row['id_sanpham']; ?>">
                                <img src="admin/class/uploads/<?php echo $row['anh']; ?>" alt="<?php echo $row['ten_sanpham']; ?>">
                                <h2><?php echo $row['ten_sanpham']; ?></h2>
                                <p>Giá: <?php echo number_format($row['giasp'], 0, ',', '.'); ?> VND</p>
                                <p>Danh mục: <?php echo $row['ten_danhmuc']; ?></p>
                                <p>Số lượng: <?php echo $row['soluong']; ?></p>
                                <div class="commen">
                                    <a class="boromec" href="thanhtoan.php">
                                        <button>Mua Ngay</button>
                                    </a>
                                    <button class="cart-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                        </svg>
                                        <span class="tooltip">Thêm vào giỏ hàng</span>
                                    </button>
                                </div>
                            </a>
                        </li>
                        <?php
                            }
                        } else {
                            echo "<p>Không có sản phẩm nào.</p>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </main>
        <footer>Copyright &copy; Your Website 2024</footer>
    </body>
</html>