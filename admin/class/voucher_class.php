<?php
include "database.php";

class voucher {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }
    public function insert_voucher($ten_voucher, $noidung, $ngay_bat_dau, $ngay_ket_thuc) {
        $query = "INSERT INTO voucher (ten_voucher, noidung, ngay_bat_dau, ngay_ket_thuc) VALUES ('$ten_voucher', '$noidung', '$ngay_bat_dau', '$ngay_ket_thuc')";
        $result = $this->db->insert($query);
        return $result;
    }
    public function show_voucher() {
        $query = "SELECT * FROM voucher ORDER BY id_voucher DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function delete_voucher($id_voucher){
        $query = "DELETE FROM voucher WHERE id_voucher = '$id_voucher'";
        $result = $this->db->delete($query);

        if ($result) {
            header('Location: voucher.php');
            exit;
        }
        return $result;
    }
    public function get_voucher($id_voucher){
        $query = "SELECT * FROM voucher WHERE id_voucher = '$id_voucher'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_voucher($ten_voucher, $id_voucher, $ngay_bat_dau, $noidung, $ngay_ket_thuc){
        $query = "UPDATE voucher SET
                    ten_voucher = '$ten_voucher',
                    noidung = '$noidung',
                    ngay_bat_dau = '$ngay_bat_dau',
                    ngay_ket_thuc = '$ngay_ket_thuc'
                  WHERE id_voucher = '$id_voucher'";
        $result = $this->db->update($query);

        if ($result) {
            // header('Location: voucher.php');
            exit;
        }
        return $result;
    }
}
?>