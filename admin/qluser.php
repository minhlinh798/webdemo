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
    <link href="css/user.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

<?php
    include "headerr.php";
?>
<?php
    $conn = new mysqli("localhost", "root", "", "webdemo");
    if($conn->connect_error){
        die("kết nối thất bại: " . $conn->connect_error);
    }
    $sql = "SELECT id, fullname, username, password, email, created_at FROM users ORDER BY id DESC";
    $result = $conn->query($sql);
?>
<style>
.ormandetlime {
    max-width: 1700px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    text-align: center;
}
</style>
<div class="ormandetlime">
    <h2>Quản Lý Người Dùng</h2>
    <table>
        <tr>
            <th>Stt</th>
            <th>Id</th>
            <th>Tên Đăng Nhập</th>
            <th>Mật Khẩu</th>
            <th>Họ Tên</th>
            <th>Email</th>
            <th>Created_at</th>
            <th>Tùy biến</th>
        </tr>
        <?php 
            if($result->num_rows > 0){ $i=0;
                while($row = $result->fetch_assoc()){$i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['fullname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td><a href="deleteuser.php?id=<?php echo $row['id']; ?>">Xóa</a></td>
        </tr>
        <?php
                }
            }
        ?>
    </table>
</div>



<?php
    include "script.php";
?>