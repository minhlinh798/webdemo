<?php
    session_start();
    include "connect.php";

    if (!isset($_SESSION['user_id'])) {
        echo "Bạn cần đăng nhập trước khi truy cập giỏ hàng.";
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $total_price = 0; // Biến lưu tổng tiền

    // Xử lý thêm sản phẩm vào giỏ hàng nếu có tham số id
    if (isset($_GET['id'])) {
        $id_sanpham = $_GET['id'];

        // Lấy thông tin sản phẩm từ bảng sanpham
        $sql = "SELECT * FROM sanpham WHERE id_sanpham = $id_sanpham";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
            $giasp = $product['giasp'];
            $ten_sanpham = $product['ten_sanpham'];
            $anh = $product['anh'];
        
            if (!$anh) {
                echo "Sản phẩm không có hình ảnh!";
                exit;
            }

            // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
            $check_cart = "SELECT * FROM giohang WHERE id_sanpham = $id_sanpham AND user_id = $user_id";
            $cart_result = mysqli_query($conn, $check_cart);

            if ($cart_result && mysqli_num_rows($cart_result) > 0) {
                // Sản phẩm đã tồn tại
                $cart_item = mysqli_fetch_assoc($cart_result);
                $new_quantity = $cart_item['quantity'] + 1;
                $new_tongtien = $new_quantity * $giasp;
                $update_sql = "UPDATE giohang SET quantity = $new_quantity, tongtien = $new_tongtien 
                               WHERE id_sanpham = $id_sanpham AND user_id = $user_id";
                mysqli_query($conn, $update_sql);
            } else {
                // Thêm sản phẩm mới
                $tongtien = $giasp;
                $insert_sql = "INSERT INTO giohang (id_sanpham, ten_sanpham, anh, giasp, quantity, tongtien, user_id)
                               VALUES ($id_sanpham, '$ten_sanpham', '$anh', $giasp, 1, $tongtien, $user_id)";
                if (!mysqli_query($conn, $insert_sql)) {
                    echo "Lỗi khi thêm vào giỏ hàng: " . mysqli_error($conn);
                    exit;
                }
            }
            header("Location: giohang.php");
            exit;
        } else {
            echo "Sản phẩm không tồn tại.";
            exit;
        }
    }
    // Hiển thị giỏ hàng
    $query = "SELECT * FROM giohang WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MIIN FOODS</title>
        <link rel="stylesheet" href="css/shopcar.css">
    </head>
    <body>
        <header>
            <div class="logo">
                <img src="imgs/logo.png" alt="Miin Foods">
            </div>
            <nav>
                <ul style="list-style-type: none; display: flex; gap: 15px; margin-right: 410px;">
                    <li><a href="index.php">TRANG CHỦ</a></li>
                    <li><a href="gioithieu.php">GIỚI THIỆU</a></li>
                    <li><a href="sanpham.php">SẢN PHẨM</a></li>
                    <li><a href="khuyenmai.php">KHUYẾN MÃI</a></li>
                    <li><a href="lienhe.php">LIÊN HỆ</a></li>
                </ul>
            </nav>
        </header>
        <style>
            button {
                padding: 8px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                background-color: #19efc9;
            }
            .cart-item .item-price {
                color: black;
                font-size: 0.9rem;
                padding-left: 10px;
            }
            span.item-price-new {
                font-weight: bold;
                font-size: 1.1rem;
                padding-left: 20px;
            }
            .cart-container {
                width: 80%;
                max-width: 950px;
                margin: 30px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }
        </style>
        <main class="cart-container">
            <h1>Giỏ hàng của bạn</h1>
            <ul class="cart-items">
                <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <li class="cart-item">
                <img src="admin/class/uploads/<?php echo $row['anh']; ?>" alt="<?php echo $row['ten_sanpham']; ?>">
                    <div class="item-details">
                        <span class="item-name"><?php echo $row['ten_sanpham']; ?></span>
                        <span class="item-price">Giá: <?php echo number_format($row['giasp']); ?> VNĐ</span>
                        <span class="item-price-new">Tổng: <?php echo number_format($row['tongtien']); ?> VNĐ</span>
                    </div>
                    <div class="item-quantity">
                        <form action="updatesp.php" method="POST">
                            <input type="hidden" name="id_giohang" value="<?php echo $row['id_giohang']; ?>">
                            <input type="number" name="product_quantity" value="<?php echo $row['quantity']; ?>" min="1">
                            <button type="submit">Cập nhật</button>
                        </form>
                    </div>
                    <button class="remove-item" style="background-color: #ff4d4d; padding: 5px 10px;"><a href="deletesp.php?id=<?php echo $row['id_giohang']; ?>" style="color: aliceblue; text-decoration: none;">Xóa</a></button>
                </li>
                <?php
                    $total_price += $row['tongtien'];
                        }
                    }
                ?>
            </ul>
            <div class="cart-total">
                <span>Tổng cộng:</span>
                <span class="total-price"><?php echo number_format($total_price); ?> VNĐ</span>
            </div>

            <!-- Các nút hành động -->
            <div class="cart-buttons">
                <a href="sanpham.php" class="continue-shopping">Tiếp tục mua sắm</a>
                <button class="checkout">Thanh toán</button>
            </div>
        </main>
        <script src="./js/cart.js"></script>
    </body>
</html>
