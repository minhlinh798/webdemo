<?php
  include "connect.php";

  if (isset($_GET['id'])) {
    $id_sanpham = $_GET['id'];
  } else {
    // Xử lý lỗi: Không có ID sản phẩm được cung cấp
    echo "Error: Không tìm thấy ID sản phẩm.";
    exit();
  }

  // Chuẩn bị truy vấn SQL để lấy thông tin sản phẩm
  $sql = "SELECT * FROM sanpham WHERE id_sanpham = $id_sanpham";
  $result = mysqli_query($conn, $sql);

 // Kiểm tra xem truy vấn có thành công và sản phẩm có tồn tại không
  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

   // Hiển thị chi tiết sản phẩm sử dụng dữ liệu $row
?>


<link rel="stylesheet" href="./css/productpage.css">
<h1>Chi Tiết Sản Phẩm</h1>
<div class="container">
  <div class="images">
    <div class="main-image">
      <img id="main-image" src="admin/class/uploads/<?php echo $row['anh']; ?>" alt="<?php echo $row['ten_sanpham']; ?>">
    </div>
  </div>
  <div class="product">
    <a id="back" href="sanpham.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
        </svg>Back
    </a>
    <h5><?php echo $row['ten_sanpham']; ?></h5>
    <div class="price">
      <span class="act-price"><?php echo number_format($row['giasp'], 0, ',', '.'); ?> VND</span>
    </div>
    <p class="about">Mô tả: <?php echo $row['mota']; ?></p>
    <div class="cart">
      <a href="giohang.php?id=<?php echo $row['id_sanpham']; ?>"><button class="btn">Thêm Vào Giỏ Hàng</button></a>
    </div>
  </div>
</div>
<?php
  } else {
   // Xử lý lỗi: Sản phẩm không tìm thấy
    echo "Error: Sản phẩm không tìm thấy.";
  }

  mysqli_close($conn);
?>