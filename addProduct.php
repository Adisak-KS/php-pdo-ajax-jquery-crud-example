<?php
require_once('db/connect.php');
header('Content-Type: application/json'); // กำหนดว่า output เป็น JSON
$ProductController = new ProductController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['productName'] ?? '';
    $buyPrice = $_POST['buyPrice'] ?? '';

    // ตรวจสอบค่าที่รับมา
    if (empty($productName) || empty($buyPrice)) {
        echo json_encode(['success' => false, 'message' => 'กรุณากรอกข้อมูลให้ครบ']);
        exit;
    }

    // เรียกใช้ฟังก์ชันใน ProductController เพื่อเพิ่มข้อมูล
    $isAdded = $ProductController->addProduct( $productName, $buyPrice);

    if ($isAdded) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการเพิ่มข้อมูล']);
    }
}
