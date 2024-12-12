<?php
    $conn = new mysqli("localhost", "root", "", "webdemo");
    if($conn->connect_error){
        die("kết nối thất bại: " . $conn->connect_error);
    }
    if(isset($_GET['id'])){
        $id = intval($_GET['id']);

        $sql = "DELETE FROM users WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Xóa thông tin người dùng thành công.";
        } else {
            echo "Lỗi khi xóa thông tin: " . $conn->error;
        }
    } else {
        echo "ID người dùng không được cung cấp.";
    }
    header("Location: qluser.php");
    exit();
    
    $conn->close();
?>