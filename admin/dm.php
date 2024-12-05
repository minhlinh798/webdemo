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
    $show_danhmuc = $danhmuc ->show_danhmuc();
?>

<div class="connten">
    <h1>Danh sách danh mục</h1>
    <table>
        <tr>
            <th>Stt</th>
            <th>ID</th>
            <th>Danh mục</th>
            <th>Tùy biến</th>
        </tr>
        <?php
            if($show_danhmuc){$i=0;
                while($result = $show_danhmuc->fetch_assoc()) {$i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $result ['id_danhmuc'] ?></td>
            <td><?php echo $result ['ten_danhmuc'] ?></td>
            <td><a href="updatedm.php?id_danhmuc=<?php echo $result['id_danhmuc'] ?>">Sửa</a> | <a href="deletedm.php?id_danhmuc=<?php echo $result['id_danhmuc'] ?>">Xóa</a></td>
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