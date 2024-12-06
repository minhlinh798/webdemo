<?php
    session_start();
    include "connect.php";

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
    $totalItems = 0;

    if ($user_id !== 0) {
        $query = "SELECT SUM(quantity) AS total_items FROM giohang WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $totalItems = $data['total_items'] ?? 0;
    }
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
                .alert-box {
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background-color: #28a745;
                    color: #fff;
                    padding: 10px 20px;
                    border-radius: 5px;
                    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
                    z-index: 1000;
                    font-size: 14px;
                    animation: fade-in-out 3s ease;
                }

                @keyframes fade-in-out {
                    0% { opacity: 0; transform: translateY(-10px); }
                    10% { opacity: 1; transform: translateY(0); }
                    90% { opacity: 1; transform: translateY(0); }
                    100% { opacity: 0; transform: translateY(-10px); }
                }

            </style>
            <div class="buttons">
                <a href="giohang.php">
                    <svg class="member" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                    </svg>
                    <span class="cart-count"><?php echo $totalItems; ?></span>
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
                                    <div data-product-id="<?php echo $row['id_sanpham']; ?>">
                                        <button class="cart-button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                            </svg>
                                            <span class="tooltip">Thêm vào giỏ hàng</span>
                                        </button>
                                    </div>
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
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const addToCartButtons = document.querySelectorAll('.cart-button');
                addToCartButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const productId = this.closest('div').getAttribute('data-product-id'); // Lấy ID sản phẩm
                        if (!productId) {
                            alert('Không thể xác định sản phẩm. Vui lòng thử lại!');
                            return;
                        }
                        // Gửi yêu cầu AJAX tới backend
                        fetch('xulyspgiohang.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: new URLSearchParams({ product_id: productId })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Cập nhật số lượng trong giỏ hàng
                                document.querySelector('.cart-count').textContent = data.totalItems;

                                // Hiển thị thông báo thêm thành công
                                showAlert(data.success);
                            } else if (data.error) {
                                alert(data.error); // Hiển thị lỗi nếu có
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi khi thêm vào giỏ hàng:', error);
                            alert('Đã xảy ra lỗi khi thêm vào giỏ hàng. Vui lòng thử lại!');
                        });
                    });
                });
                // Hàm hiển thị thông báo
                function showAlert(message) {
                    const alertBox = document.createElement('div');
                    alertBox.className = 'alert-box';
                    alertBox.textContent = message;
                    document.body.appendChild(alertBox);
                    // Tự động ẩn thông báo sau 3 giây
                    setTimeout(() => {
                        alertBox.remove();
                    }, 3000);
                }
            });
        </script>
        <footer>Copyright &copy; Your Website 2024</footer>
    </body>
</html>