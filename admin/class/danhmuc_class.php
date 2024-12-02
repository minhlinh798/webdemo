<?php
include "database.php";

class danhmuc {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function insert_danhmuc($ten_danhmuc) {
        $query = "INSERT INTO danhmuc (ten_danhmuc) VALUES ('$ten_danhmuc')";
        $result = $this->db->insert($query);
        return $result;
    }

    public function Show_danhmuc() {
        $query = "SELECT * FROM danhmuc ORDER BY id_danhmuc DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_danhmuc($id_danhmuc) {
        $query = "SELECT * FROM danhmuc WHERE id_danhmuc = '$id_danhmuc'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_danhmuc($ten_danhmuc, $id_danhmuc) {
        $query = "UPDATE danhmuc SET ten_danhmuc = '$ten_danhmuc' WHERE id_danhmuc = '$id_danhmuc'";
        $result = $this->db->update($query);

        if ($result) {
            // header('Location: dm.php');
            exit;
        }
        return $result;
    }

    public function delete_danhmuc($id_danhmuc) {
        $query = "DELETE FROM danhmuc WHERE id_danhmuc = '$id_danhmuc'";
        $result = $this->db->delete($query);

        if ($result) {
            header('Location: dm.php');
            exit;
        }
        return $result;
    }
}
?>
