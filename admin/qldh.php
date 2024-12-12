<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/qldh.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

<?php
    include "headerr.php";
?>
<?php
    // Kết nối cơ sở dữ liệu
    $conn = new mysqli('localhost', 'root', '', 'webdemo');

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy dữ liệu từ bảng donhang
    $sql = "SELECT id_donhang, fullname, email, address, ten_voucher, tongtien_giam, trangthai, tongtien, created_at FROM donhang ORDER BY created_at DESC";
    $result = $conn->query($sql);
?>
<div class="moemboo2">
    <h2>Quản Lý Các Đơn Hàng</h2>
    <table>
        <tr>
            <th>Stt</th>
            <th>Họ Và Tên</th>
            <th>Địa Chỉ</th>
            <th>Mã Voucher</th>
            <th>Tổng Tiền Giảm</th>
            <th>Tổng Tiền</th>
            <th>Trạng Thái</th>
            <th>Thời gian</th>
            <th>Tùy biến</th>
        </tr>
        <?php
            if($result->num_rows > 0){$i=0;
                while($row = $result ->fetch_assoc()) {$i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['fullname']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['ten_voucher']; ?></td>
            <td><?php echo $row['tongtien_giam']; ?> VNĐ</td>
            <td><?php echo $row['tongtien']; ?> VNĐ</td>
            <td><?php echo $row['trangthai']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td><a href="duyetdh.php?id=<?php echo $row['id_donhang']; ?>">Duyệt ĐH</a></td>
        </tr>
        <?php
            }
        }
        ?>
    </table>
</div>
<?php
// Đóng kết nối
$conn->close();
?>
<?php
    include "script.php";
?>