<?php
require_once('db/connect.php');
header('Content-Type: application/json'); // กำหนดว่า output เป็น JSON
$ProductController = new ProductController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productCode = $_POST['productCode'] ?? '';
    $productName = $_POST['productName'] ?? '';
    $buyPrice = $_POST['buyPrice'] ?? '';

    // ตรวจสอบค่าที่รับมา
    if (empty($productCode) || empty($productName) || empty($buyPrice)) {
        echo json_encode(['success' => false, 'message' => 'กรุณากรอกข้อมูลให้ครบ และถูกต้อง']);
        exit;
    }

    // เรียกใช้ฟังก์ชันใน ProductController เพื่อแก้ไขข้อมูล
    $Update = $ProductController->updateProduct($productCode, $productName, $buyPrice);

    if ($Update) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการแก้ไขข้อมูล']);
    }
}
