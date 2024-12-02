<?php
include "database.php";

class sanpham {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }
    public function Show_danhmuc() {
        $query = "SELECT * FROM danhmuc";
        $result = $this->db->select($query);
        return $result;
    }
    public function insert_sanpham() {
        $ten_sanpham = $_POST['ten_sanpham'];
        $ten_danhmuc = $_POST['ten_danhmuc'];
        $giasp = $_POST['giasp'];
        $soluong = $_POST['soluong'];
        $mota = $_POST['mota'];
        $anh = $_FILES['anh']['name'];
    
        $upload_path = "class/uploads/";
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }
        move_uploaded_file($_FILES['anh']['tmp_name'], $upload_path . $anh);
    
        $query = "INSERT INTO sanpham (ten_sanpham, ten_danhmuc, giasp, soluong, mota, anh) 
                  VALUES ('$ten_sanpham', '$ten_danhmuc', '$giasp', '$soluong', '$mota', '$anh')";
        $result = $this->db->insert($query);
        return $result;
    }
    public function show_sanpham(){
        $id_sanpham = 'id_sanpham';
        $ten_sanpham = 'ten_sanpham';
        $ten_danhmuc = 'ten_danhmuc';
        $giasp = 'giasp';
        $soluong = 'soluong';
        $mota = 'mota';
        $anh = 'anh';
        
        $query ="INSERT INTO sanpham (id_sanpham, ten_sanpham, ten_danhmuc, giasp, soluong, mota, anh) 
                  VALUES ('$id_sanpham', '$ten_sanpham', '$ten_danhmuc', '$giasp', '$soluong', '$mota', '$anh')";
        $result = $this->db->insert($query);
        return $result;
    }   
    
}
?>
