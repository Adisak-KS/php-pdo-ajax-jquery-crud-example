<?php
require_once('db/connect.php');

$ProductController = new ProductController($conn);

$limit = 12; // แสดงในแต่ละหน้าเป็น 12 ชิ้น
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$totalProducts = $ProductController->getTotalProducts();
$totalPages = ceil($totalProducts / $limit);

if ($page > $totalPages) {
    $page = $totalPages;
}
if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $limit;
$products = $ProductController->getProducts($limit, $offset);

// สร้าง HTML สำหรับแสดงสินค้ากับ pagination
$productList = '';
foreach ($products as $row) {
    $productList .= '
        <div class="col-3">
            <div class="border border-4 border-dark text-center mx-3 my-3 px-2 py-2">
                <p><strong>ID :</strong> ' . $row['productCode'] . '</p>
                <p><strong>Name :</strong> ' . $row['productName'] . '</p>
                <p><strong>Price :</strong> ฿' . number_format($row['buyPrice'],2) . '</p>
            </div>
        </div>';
}

// สร้าง HTML สำหรับ pagination
$paginationHTML = '';

if ($totalPages > 1) {
    $paginationHTML .= '<li class="page-item ' . ($page == 1 ? 'disabled' : '') . '">
                        <a class="page-link" href="#" data-page="' . ($page - 1) . '">Previous</a></li>';

    for ($i = 1; $i <= $totalPages; $i++) {
        $paginationHTML .= '<li class="page-item ' . ($i == $page ? 'active' : '') . '">
                            <a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
    }

    $paginationHTML .= '<li class="page-item ' . ($page == $totalPages ? 'disabled' : '') . '">
                        <a class="page-link" href="#" data-page="' . ($page + 1) . '">Next</a></li>';
}

// ส่งข้อมูลกลับไปในรูปแบบ JSON
echo json_encode([
    'productList' => $productList,
    'paginationHTML' => $paginationHTML
]);
