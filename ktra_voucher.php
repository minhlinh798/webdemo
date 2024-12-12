<?php
include "connect.php"; // Kết nối database
$response = array('success' => false, 'discount' => 0, 'final_price' => 0);
// Nhận mã voucher từ yêu cầu Ajax
$voucher_code = isset($_POST['voucher']) ? trim($_POST['voucher']) : '';
if (!empty($voucher_code)) {
    $query_voucher = "SELECT * FROM voucher WHERE ten_voucher = ?";
    $stmt_voucher = $conn->prepare($query_voucher);
    $stmt_voucher->bind_param("s", $voucher_code);
    $stmt_voucher->execute();
    $result_voucher = $stmt_voucher->get_result();

    if ($result_voucher->num_rows > 0) {
        $voucher = $result_voucher->fetch_assoc();
        $current_date = date("Y-m-d");
        $start_date = date("Y-m-d", strtotime($voucher['ngay_bat_dau']));
        $end_date = date("Y-m-d", strtotime($voucher['ngay_ket_thuc']));

        if ($current_date >= $start_date && $current_date <= $end_date) {
            $discount = (float)$voucher['noidung'];
            $total_price = 100000; // Giả sử tổng tiền là 100,000 VNĐ, bạn cần lấy từ bảng giỏ hàng
            $final_price = $total_price - ($total_price * $discount / 100);

            $response['success'] = true;
            $response['discount'] = $discount;
            $response['final_price'] = number_format($final_price);
        }
    }
}
echo json_encode($response);
?>
