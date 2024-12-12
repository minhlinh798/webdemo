<?php
    include "class/voucher_class.php";
    $voucher = new voucher;
    if(!isset($_GET['id_voucher']) || $_GET['id_voucher']==NULL){
        echo "<script>window.location = 'voucher.php'</script>";
    }
    else{
        $id_voucher = $_GET['id_voucher'];
    }
    $delete_voucher = $voucher -> delete_voucher($id_voucher);
?>
