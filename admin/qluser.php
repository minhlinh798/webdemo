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
<div class="ormandetlime">
    <h2>Quản Lý Người Dùng</h2>
    <table>
        <tr>
            <th>Stt</th>
            <th>Tên Đăng Nhập</th>
            <th>Mật Khẩu</th>
            <th>Họ Tên</th>
            <th>Email</th>
            <th>Tùy biến</th>
        </tr>
        <tr>
            <td>1</td>
            <td>minhlinh</td>
            <td>123</td>
            <td>Nguyễn Min Lĩnh</td>
            <td>linhclear@gmail.com</td>
            <td><a href="#">Sửa</a> | <a href="#">Xóa</a></td>
        </tr>
    </table>
</div>



<?php
    include "script.php";
?>