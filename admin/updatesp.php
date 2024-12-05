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
    if(!isset($_GET['id_sanpham']) || $_GET['id_sanpham']==NULL){
        echo "<script>window.location = 'sp.php'</script>";
    }
    else{
        $id_sanpham = $_GET['id_sanpham'];
    }
    $get_sanpham = $sanpham -> get_sanpham($id_sanpham);
    if($get_sanpham){
        $result = $get_sanpham -> fetch_assoc();
    }
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ten_sanpham = $_POST['ten_sanpham'];
        $ten_danhmuc = $_POST['ten_danhmuc'];
        $giasp = $_POST['giasp'];
        $soluong = $_POST['soluong'];
        $mota = $_POST['mota'];
        // Giữ ảnh cũ nếu không upload ảnh mới
        $anh = !empty($_FILES['anh']['name']) ? $_FILES['anh']['name'] : $result['anh'];
        $update_sanpham = $sanpham->update_sanpham($ten_sanpham, $id_sanpham, $ten_danhmuc, $giasp, $soluong, $mota, $anh);
    }
    
?>
<div class="contener-one">
    <h1>Sửa sản phẩm</h1>
    <form action="" method="POST" enctype="multipart/form-data">

        <label for="">Nhập tên sản phẩm<span style="color: red;">*</span></label>
        <input required name="ten_sanpham" type="text" value="<?php echo $result['ten_sanpham'] ?>">

        <label for="">Chọn danh mục<span style="color: red;">*</span></label>
        <select name="ten_danhmuc">
            <option value="">--Chọn--</option>
            <?php
                $show_danhmuc = $sanpham->Show_danhmuc();
                if ($show_danhmuc) {
                    while ($danhmuc = $show_danhmuc->fetch_assoc()) {
                        $selected = ($danhmuc['ten_danhmuc'] == $result['ten_danhmuc']) ? 'selected' : '';
                        echo "<option value='{$danhmuc['ten_danhmuc']}' $selected>{$danhmuc['ten_danhmuc']}</option>";
                    }
                }
            ?>
        </select>

        <label for="">Giá sản phẩm<span style="color: red;">*</span></label>
        <input required name="giasp" type="text" value="<?php echo $result['giasp'] ?>">

        <label for="">Số lượng<span style="color: red;">*</span></label>
        <input required name="soluong" type="text" value="<?php echo $result['soluong'] ?>">
        
        <label for="">Mô tả sản phẩm<span style="color: red;">*</span></label>
        <textarea name="mota" id="" cols="30" rows="10"><?php echo $result['mota'] ?>"</textarea>

        <label for="">Ảnh sản phẩm<span style="color: red;">*</span></label>
        <input required name="anh" type="file" value="<?php echo $result['anh'] ?>">

        <button name="submit">Sửa</button>
    </form>
</div>
<?php
    include "script.php";
?>