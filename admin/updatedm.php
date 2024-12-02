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
<?php
    include "headerr.php";
?>
<?php
    include "class/danhmuc_class.php";
    $danhmuc = new danhmuc;
    if(!isset($_GET['id_danhmuc']) || $_GET['id_danhmuc']==NULL){
        echo "<script>window.location = 'dm.php'</script>";
    }
    else{
        $id_danhmuc = $_GET['id_danhmuc'];
    }
    $get_danhmuc = $danhmuc -> get_danhmuc($id_danhmuc);
    if($get_danhmuc){
        $result = $get_danhmuc -> fetch_assoc();
    }
?>
<?php
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $ten_danhmuc = $_POST['ten_danhmuc'];
        $update_danhmuc = $danhmuc ->update_danhmuc($ten_danhmuc,$id_danhmuc);
    }
?>
<div class="contener-main">
    <h1>Sửa Danh Mục</h1>
    <form action="" method="POST">
        <input name="ten_danhmuc" type="text" placeholder="Nhập tên danh mục" value="<?php echo $result['ten_danhmuc'] ?>">
        <button type="submit">Sửa</button>
    </form>
</div>
<?php
    include "script.php";
?>