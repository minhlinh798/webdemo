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
    <link href="css/magg.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

<?php
    include "headerr.php";
?>

<?php
    include "class/voucher_class.php";
    $voucher = new voucher;
    $show_voucher = $voucher ->show_voucher();
?>

<div class="connten-brem">
    <h1>Danh sách Mã Voucher</h1>
    <table>
        <tr>
            <th>Stt</th>
            <th>ID</th>
            <th>Mã Voucher</th>
            <th>Giá Trị Giảm Giá (%)</th>
            <th>Ngày Bắt Đầu</th>
            <th>Ngày Kết Thúc</th>
            <th>Tùy biến</th>
        </tr>
        <?php
            if($show_voucher){$i=0;
                while($result = $show_voucher->fetch_assoc()) {$i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $result ['id_voucher'] ?></td>
            <td><?php echo $result ['ten_voucher'] ?></td>
            <td><?php echo $result ['noidung'] ?></td>
            <td><?php echo $result ['ngay_bat_dau'] ?></td>
            <td><?php echo $result ['ngay_ket_thuc'] ?></td>
            <td><a href="updatemagg.php?id_voucher=<?php echo $result['id_voucher'] ?>">Sửa</a> | <a href="deletemagg.php?id_voucher=<?php echo $result['id_voucher'] ?>">Xóa</a></td>
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