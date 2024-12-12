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
    <link href="css/adddm.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
<style>
    button[type="submit"] {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 20px;
    }
</style>
<?php
    include "headerr.php";
?>
<?php
    include "class/voucher_class.php";
    $voucher = new voucher;
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $ten_voucher = $_POST['ten_voucher'];
        $noidung = $_POST['noidung'];
        $ngay_bat_dau = $_POST['ngay_bat_dau'];
        $ngay_ket_thuc = $_POST['ngay_ket_thuc'];
        $insert_voucher = $voucher->insert_voucher($ten_voucher, $noidung, $ngay_bat_dau, $ngay_ket_thuc);
    }
?>
<div class="contener-main">
    <h1>Thêm Voucher Giảm Giá</h1>
    <form action="" method="POST">
        <input required name="ten_voucher" type="text" placeholder="Nhập mã voucher">

        <label for="noidung">Giá Trị Giảm Giá (%):</label>
        <input type="number" name="noidung" required placeholder="Nhập giá trị giảm giá" min="1" max="100" style="width:370px; height:40px">

        <label for="ngay_bat_dau">Ngày Bắt Đầu:</label>
        <input type="date" name="ngay_bat_dau" required style="width:150px; height:40px">

        <label for="ngay_ket_thuc">Ngày Kết Thúc:</label>
        <input type="date" name="ngay_ket_thuc" required style="width:150px; height:40px">

        <button type="submit">Thêm</button>
    </form>
</div>

<?php
    include "script.php";
?>