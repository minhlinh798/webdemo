<?php
include "connect.php";
session_start();

if (isset($_GET['id'])) {
    $id_giohang = $_GET['id'];

    $delete_query = "DELETE FROM giohang WHERE id_giohang = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $id_giohang);
    $stmt->execute();

    header("Location: giohang.php");
    exit();
}
?>
