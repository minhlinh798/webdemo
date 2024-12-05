<?php
session_start();
include "connect.php";
if (isset($_SESSION['icon'])) {
    // echo "Kiểm tra: " . $_SESSION['icon'];
} else {
    // echo "Session chưa có dữ liệu!";
}
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MIIN FOODS</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <header>
            <div class="logo">
                <img class="anhnguoidung" src="imgs/logo.png" alt="Miin Foods">
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
                <a href="giohang.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                    </svg>
                </a>
                <?php if (isset($_SESSION['user_id'])): ?>
                <?php
                $iconPath = "imgs/" . htmlspecialchars($_SESSION['icon']);
                if (file_exists($iconPath)):
                ?>
                    <img src="<?php echo $iconPath; ?>" alt="User Icon" width="40px" height="40px">
                <?php else: ?>
                    <img src="imgs/icons.png" alt="Default User Icon" width="40px" height="40px">
                <?php endif; ?>
                <button class="ducatutu"><a href="logout.php" class="logout-button">Đăng xuất</a>
                <?php else: ?>
                    <button class="login">
                        <a href="dangnhap.php">ĐĂNG NHẬP</a>
                    </button>
                <?php endif; ?>
            </div>
        </header>
        <style>
            .slideshow-container {
                position: relative;
                margin: auto;
                overflow: hidden;
            }
            @keyframes slide {
                0% { transform: translateX(100%); }
                25% { transform: translateX(0); }
                50% { transform: translateX(0); }
                75% { transform: translateX(-100%); }
                100% { transform: translateX(-100%); }
            }
            span {
                margin-top: 7px;
            }
            .buttons {
                display: flex;
                gap: 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            a {
                color: aliceblue;
                text-decoration: none;
            }
            button.ducatutu {
                background-color: #e60023;
                width: 110px;
            }
        </style>
        <div class="slideshow-container">
            <div class="slide fade">
                <img src="imgs/banner.png" class="slide-image" width="100%" height="600px">
            </div>
            <div class="slide fade">
                <img src="imgs/banner6.png" class="slide-image" width="100%" height="600px">
            </div>
            <div class="slide fade">
                <img src="imgs/banner4.png.jpeg" class="slide-image" width="100%" height="600px">
            </div>
            <div class="slide fade">
                <img src="imgs/banner5.png" class="slide-image" width="100%" height="600px">
            </div>
        </div>
        <main>
            <div>
                <div class="nav">
                    <h1>Sản phẩm nổi bật nhất</h1>
                    <img src="imgs/logo1.png">
                </div>
                <div class="menu">
                    <h2>Trà Sữa</h2>
                    <ul class="product_list">
                        <li>
                            <a class="product" href="">
                                <img src="imgs/b1.png">
                                <a class="icon" href="giohang.html" class="cart-icon">
                                    <img name="icon-list" src="https://img.pikbest.com/png-images/shopping-cart-icon---vector-template---transparent-background_1794341.png!sw800" alt="Thêm vào giỏ hàng">
                                </a>
                                <p class="title_product">Trà sữa trân châu đen</p>
                                <p class="price_product">Giá: 20.000 vnđ</p>
                            </a>
                        </li>
                        <li>
                            <a class="product" href="">
                                <img src="imgs/b4.png">
                                <a class="icon" href="giohang.html" class="cart-icon">
                                    <img name="icon-list" src="https://img.pikbest.com/png-images/shopping-cart-icon---vector-template---transparent-background_1794341.png!sw800" alt="Thêm vào giỏ hàng">
                                </a>
                                <p class="title_product">Trà sữa thái xanh</p>
                                <p class="price_product">Giá: 20.000 vnđ</p>
                            </a>
                        </li>
                        <li>
                            <a class="product" href="">
                                <img src="imgs/b6.png">
                                <a class="icon" href="giohang.html" class="cart-icon">
                                    <img name="icon-list" src="https://img.pikbest.com/png-images/shopping-cart-icon---vector-template---transparent-background_1794341.png!sw800" alt="Thêm vào giỏ hàng">
                                </a>
                                <p class="title_product">Trà đào</p>
                                <p class="price_product">Giá: 20.000 vnđ</p>
                            </a>
                        </li>
                        <li>
                            <a class="product" href="">
                                <img src="imgs/b9.png">
                                <a class="icon" href="giohang.html" class="cart-icon">
                                    <img name="icon-list" src="https://img.pikbest.com/png-images/shopping-cart-icon---vector-template---transparent-background_1794341.png!sw800" alt="Thêm vào giỏ hàng">
                                </a>
                                <p class="title_product">Bạc xỉu</p>
                                <p class="price_product">Giá: 20.000 vnđ</p>
                            </a>
                        </li>
                    </ul>
                    <h2>Đồ Chiên</h2>
                    <ul class="product_list">
                        <li>
                            <a class="product" href="">
                                <img src="imgs/b1.png">
                                <a class="icon" href="giohang.html" class="cart-icon">
                                    <img name="icon-list" src="https://img.pikbest.com/png-images/shopping-cart-icon---vector-template---transparent-background_1794341.png!sw800" alt="Thêm vào giỏ hàng">
                                </a>
                                <p class="title_product">Tên sản phẩm: gì đó</p>
                                <p class="price_product">Giá: 20.000 vnđ</p>
                            </a>
                        </li>
                        <li>
                            <a class="product" href="">
                                <img src="imgs/b1.png">
                                <a class="icon" href="giohang.html" class="cart-icon">
                                    <img name="icon-list" src="https://img.pikbest.com/png-images/shopping-cart-icon---vector-template---transparent-background_1794341.png!sw800" alt="Thêm vào giỏ hàng">
                                </a>
                                <p class="title_product">Tên sản phẩm: gì đó</p>
                                <p class="price_product">Giá: 20.000 vnđ</p>
                            </a>
                        </li>
                        <li>
                            <a class="product" href="">
                                <img src="imgs/b1.png">
                                <a class="icon" href="giohang.html" class="cart-icon">
                                    <img name="icon-list" src="https://img.pikbest.com/png-images/shopping-cart-icon---vector-template---transparent-background_1794341.png!sw800" alt="Thêm vào giỏ hàng">
                                </a>
                                <p class="title_product">Tên sản phẩm: gì đó</p>
                                <p class="price_product">Giá: 20.000 vnđ</p>
                            </a>
                        </li>
                        <li>
                            <a class="product" href="">
                                <img src="imgs/b1.png">
                                <a class="icon" href="giohang.html" class="cart-icon">
                                    <img name="icon-list" src="https://img.pikbest.com/png-images/shopping-cart-icon---vector-template---transparent-background_1794341.png!sw800" alt="Thêm vào giỏ hàng">
                                </a>
                                <p class="title_product">Tên sản phẩm: gì đó</p>
                                <p class="price_product">Giá: 20.000 vnđ</p>                             
                            </a>
                        </li>
                    </ul>
                    <h2>Ăn Vặt</h2>
                    <ul class="product_list">
                        <li>
                            <a class="product" href="">
                                <img src="imgs/b10.png">
                                <a class="icon" href="giohang.html" class="cart-icon">
                                    <img name="icon-list" src="https://img.pikbest.com/png-images/shopping-cart-icon---vector-template---transparent-background_1794341.png!sw800" alt="Thêm vào giỏ hàng">
                                </a>
                                <p class="title_product">Lẩu hải sản</p>
                                <p class="price_product">Giá: 20.000 vnđ</p>           
                            </a>
                        </li>
                        <li>
                            <a class="product" href="">
                                <img src="imgs/b3.png">
                                <a class="icon" href="giohang.html" class="cart-icon">
                                    <img name="icon-list" src="https://img.pikbest.com/png-images/shopping-cart-icon---vector-template---transparent-background_1794341.png!sw800" alt="Thêm vào giỏ hàng">
                                </a>
                                <p class="title_product">Lẩu kim chi hàn quốc</p>
                                <p class="price_product">Giá: 20.000 vnđ</p>
                            </a>
                        </li>
                        <li>
                            <a class="product" href="">
                                <img src="imgs/b6.png">
                                <a class="icon" href="giohang.html" class="cart-icon">
                                    <img name="icon-list" src="https://img.pikbest.com/png-images/shopping-cart-icon---vector-template---transparent-background_1794341.png!sw800" alt="Thêm vào giỏ hàng">
                                </a>
                                <p class="title_product">Lẩu thái</p>
                                <p class="price_product">Giá: 20.000 vnđ</p>
                            </a>
                        </li>
                        <li>
                            <a class="product" href="">
                                <img src="imgs/b9.png">
                                <a class="icon" href="giohang.html" class="cart-icon">
                                    <img name="icon-list" src="https://img.pikbest.com/png-images/shopping-cart-icon---vector-template---transparent-background_1794341.png!sw800" alt="Thêm vào giỏ hàng">
                                </a>
                                <p class="title_product">Lẩu bò</p>
                                <p class="price_product">Giá: 20.000 vnđ</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </main>
        <footer>Copyright &copy; Your Website 2024</footer>
        <script>
            let slideIndex = 0;
            showSlides();

            function showSlides() {
                let i;
                let slides = document.getElementsByClassName("slide");
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";  
                }
                slideIndex++;
                if (slideIndex > slides.length) {slideIndex = 1}    
                slides[slideIndex-1].style.display = "block";  
                setTimeout(showSlides, 2000); // Thay đổi ảnh mỗi 2 giây
            }
        </script>
        <script src="script.js"></script>
    </body>
</html>