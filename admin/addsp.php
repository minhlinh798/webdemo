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
    <link href="css/sp.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

<?php
    include "headerr.php";
?>

<?php
    include "class/sanpham_class.php";
    $sanpham = new sanpham;
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        // var_dump($_POST, $_FILES);
        $insert_sanpham = $sanpham ->insert_sanpham($_POST, $_FILES);
    }
?>

<div class="contener-one">
    <h1>Thêm sản phẩm</h1>
    <form action="" method="POST" enctype="multipart/form-data">

        <label for="">Nhập tên sản phẩm<span style="color: red;">*</span></label>
        <input name="ten_sanpham" type="text" required>

        <label for="">Chọn danh mục<span style="color: red;">*</span></label>
        <select name="ten_danhmuc">
            <option value="">--Chọn--</option>
            <?php
                $show_danhmuc = $sanpham->Show_danhmuc();
                if ($show_danhmuc) {
                    while ($result = $show_danhmuc->fetch_assoc()) {
                        echo "<option value='{$result['ten_danhmuc']}'>{$result['ten_danhmuc']}</option>";
                    }
                }
            ?>
        </select>

        <label for="">Giá sản phẩm<span style="color: red;">*</span></label>
        <input name="giasp" type="text" required>

        <label for="">Số lượng<span style="color: red;">*</span></label>
        <input name="soluong" type="text" required>
        
        <label for="">Mô tả sản phẩm<span style="color: red;">*</span></label>
        <textarea name="mota" id="" cols="30" rows="10"></textarea>

        <label for="">Ảnh sản phẩm<span style="color: red;">*</span></label>
        <input name="anh" type="file" required>

        <button name="submit">Thêm</button>
    </form>
</div>

<?php
    include "script.php";
?>