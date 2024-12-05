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
    <link href="css/support.css" rel="stylesheet">
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
}

.support {
    max-width: 1100px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.support h2 {
    color: #333;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
}

table th {
    background-color: #f2f2f2;
    color: #333;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #f1f1f1;
}

table th, table td {
    text-align: center;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

</style>
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

    // Lấy dữ liệu từ bảng lienhe
    $sql = "SELECT id_lienhe, ten_nguoidung, email, sdt, noidung, created_at FROM lienhe ORDER BY created_at DESC";
    $result = $conn->query($sql);
?>
<div class="support">
    <h2>Quản Lý Người Dùng Khi Gặp Lỗi!</h2>
    <table>
        <tr>
            <th>Stt</th>
            <th>ID</th>
            <th>Họ Tên</th>
            <th>Email</th>
            <th>SĐT</th>
            <th>Nội Dung</th>
            <th>Thời gian gửi</th>
            <th>Tùy biến</th>
        </tr>
        <?php
            if($result->num_rows > 0){$i=0;
                while($row = $result ->fetch_assoc()) {$i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['id_lienhe']; ?></td>
            <td><?php echo $row['ten_nguoidung']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['sdt']; ?></td>
            <td><?php echo $row['noidung']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td><a href="delete_lienhe.php?id=<?php echo $row['id_lienhe']; ?>">Xóa</a></td>
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