<?php
require_once("db/connect.php");
$limit = 12; // แสดงในแต่ละหน้าเป็น 12 ชิ้น
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <?php require_once('layout/navbar.php'); ?>

        <div class="container mt-5">
            <h1 class="text-center">สินค้าทั้งหมด</h1>

            <div class="row" id="product-list">
                <!-- รายการสินค้า จะถูกแสดงที่นี่ผ่าน AJAX -->
            </div>

            <!-- Pagination -->
            <nav class="d-flex justify-content-center">
                <ul class="pagination" id="pagination">
                    <!-- Pagination buttons จะถูกแสดงที่นี่ผ่าน AJAX -->
                </ul>
            </nav>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            function loadProducts(page = 1) {
                $.ajax({
                    url: 'fetch_products.php',
                    type: 'GET',
                    data: {
                        page: page
                    },
                    success: function(response) {
                        // แบ่งข้อมูล response เป็น productList และ paginationHTML
                        let result = JSON.parse(response);
                        $('#product-list').html(result.productList);
                        $('#pagination').html(result.paginationHTML);
                    }
                });
            }

            // โหลดข้อมูลครั้งแรก
            loadProducts();

            // จัดการ event คลิกที่ pagination
            $(document).on('click', '.page-link', function(e) {
                e.preventDefault();
                let page = $(this).data('page');
                loadProducts(page);
            });
        });
    </script>

</body>

</html>