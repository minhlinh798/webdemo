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
    textarea {
        overflow: auto;
        resize: vertical;
        width: 370px;
        height: 100px;
    }
    .h5, h5 {
        font-size: 1.25rem;
        padding: 10px;
        color: black;
    }
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
    if(!isset($_GET['id_voucher']) || $_GET['id_voucher']==NULL){
        echo "<script>window.location = 'voucher.php'</script>";
    }
    else{
        $id_voucher = $_GET['id_voucher'];
    }
    $get_voucher = $voucher -> get_voucher($id_voucher);
    if($get_voucher){
        $result = $get_voucher -> fetch_assoc();
    }
?>
<?php
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $ten_voucher = $_POST['ten_voucher'];
        $noidung = $_POST['noidung'];
        $ngay_bat_dau = $_POST['ngay_bat_dau'];
        $ngay_ket_thuc = $_POST['ngay_ket_thuc'];
        $update_voucher = $voucher ->update_voucher($ten_voucher, $id_voucher, $ngay_bat_dau, $noidung, $ngay_ket_thuc);
    }
?>
<div class="contener-main">
    <h1>Sửa Mã Voucher</h1>
    <form action="" method="POST">
        <input name="ten_voucher" type="text" placeholder="Nhập Mã Voucher" value="<?php echo $result['ten_voucher'] ?>">

        <label for="noidung">Giá Trị Giảm Giá (%):</label>
        <input type="number" name="noidung" required placeholder="Nhập giá trị giảm giá" min="1" max="100" style="width:370px; height:40px" value="<?php echo $result['noidung'] ?>">

        <label for="ngay_bat_dau">Ngày Bắt Đầu:</label>
        <input type="date" name="ngay_bat_dau" required style="width:150px; height:40px" value="<?php echo $result['ngay_bat_dau'] ?>">

        <label for="ngay_ket_thuc">Ngày Kết Thúc:</label>
        <input type="date" name="ngay_ket_thuc" required style="width:150px; height:40px" value="<?php echo $result['ngay_ket_thuc'] ?>">

        <button type="submit">Sửa</button>
    </form>
</div>
<?php
    include "script.php";
?>