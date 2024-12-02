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
    $show_sanpham = $sanpham ->show_sanpham();
?>

<div class="connten">
    <h1>Danh sách sản phẩm</h1>
    <table>
        <tr>
            <th>Stt</th>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Tên danh mục</th>
            <th>Giá sản phẩm</th>
            <th>Số lượng</th>
            <th>Mô tả</th>
            <th>Hình ảnh</th>
            <th>Tùy biến</th>
        </tr>
        <?php
            if($show_sanpham){$i=0;
                while($result = $show_sanpham ->fetch_assoc()) {$i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $result ['id_sanpham'] ?></td>
            <td><?php echo $result ['ten_sanpham'] ?></td>
            <td><?php echo $result ['ten_danhmuc'] ?></td>
            <td><?php echo $result ['giasp'] ?></td>
            <td><?php echo $result ['soluong'] ?></td>
            <td><?php echo $result ['mota'] ?></td>
            <td><?php echo $result ['anh'] ?></td>
            <td><a href="updatesp.php?id_sanpham=<?php echo $result['id_sanpham'] ?>">Sửa</a> | <a href="deletesp.php?id_sanpham=<?php echo $result['id_'] ?>">Xóa</a></td>
        </tr>
        <?php
                }
            }
        ?>
</div>

<?php
    include "script.php";
?>