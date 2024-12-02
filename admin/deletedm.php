<?php
    include "class/danhmuc_class.php";
    $danhmuc = new danhmuc;
    if(!isset($_GET['id_danhmuc']) || $_GET['id_danhmuc']==NULL){
        echo "<script>window.location = 'dm.php'</script>";
    }
    else{
        $id_danhmuc = $_GET['id_danhmuc'];
    }
    $delete_danhmuc = $danhmuc -> delete_danhmuc($id_danhmuc);
?>

