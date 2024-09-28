<?php
require_once('db/connect.php');
header('Content-Type: application/json'); // กำหนดว่า output เป็น JSON
$ProductController = new ProductController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productCode = $_POST['productCode'] ?? '';

    // ตรวจสอบค่าที่รับมา
    if (empty($productCode)) {
        echo json_encode(['success' => false, 'message' => 'รหัสสินค้าไม่ถูกต้อง']);
        exit;
    }

    // เรียกใช้ฟังก์ชันใน ProductController เพื่อลบข้อมูล
    $Delete = $ProductController->deleteProduct($productCode);

    if ($Delete) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการลบข้อมูล']);
    }
}
