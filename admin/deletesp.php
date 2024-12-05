<?php
    include "class/sanpham_class.php";
    $sanpham = new sanpham;
    if(!isset($_GET['id_sanpham']) || $_GET['id_sanpham']==NULL){
        echo "<script>window.location = 'sp.php'</script>";
    }
    else{
        $id_sanpham = $_GET['id_sanpham'];
    }
    $delete_sanpham = $sanpham -> delete_sanpham($id_sanpham);
?>