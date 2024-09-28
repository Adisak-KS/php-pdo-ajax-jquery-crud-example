<?php
require_once('db/connect.php');

$ProductController = new ProductController($conn);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start = $_POST['start'] ?? 0;
    $length = $_POST['length'] ?? 10;
    $search = $_POST['search']['value'] ?? '';

    // รับคอลัมน์ที่ใช้จัดเรียงและทิศทางการจัดเรียงจาก DataTable
    $orderColumn = $_POST['order'][0]['column'] ?? 0;
    $orderDir = $_POST['order'][0]['dir'] ?? 'asc';

    $data = $ProductController->manageProductsServerSide($start, $length, $search, $orderColumn, $orderDir);

    echo json_encode([
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $data['total'],
        "recordsFiltered" => $data['total'],
        "data" => $data['data']
    ]);
    exit;
}
