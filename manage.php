<?php
require_once("db/connect.php");
$ProductController = new ProductController($conn);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


</head>

<body>
    <div class="container">

        <?php require_once('layout/navbar.php'); ?>

        <div class="container mt-5">
            <h1 class="text-center">จัดการ</h1>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                เพิ่มสินค้า
            </button>

            <!-- Modal สำหรับการเพิ่มสินค้า -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <form id="addProductForm">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">เพิ่มสินค้า</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="productName" class="form-label">ชื่อสินค้า</label>
                                    <input type="text" class="form-control" name="productName" id="productName" placeholder="ชื่อสินค้า" maxlength="70">
                                </div>
                                <div class="mb-3">
                                    <label for="buyPrice" class="form-label">ราคาสินค้า</label>
                                    <input type="number" class="form-control" name="buyPrice" id="buyPrice" placeholder="ราคาซื้อ">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <!-- Modal สำหรับการแก้ไขสินค้า -->
            <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProductModalLabel">แก้ไขสินค้า</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form novalidate id="editProductForm">
                                <input type="hidden" class="form-control" id="editProductCode" name="editProductCode" readonly>
                                <div class="mb-3">
                                    <label for="editProductName" class="form-label">ชื่อสินค้า</label>
                                    <input type="text" class="form-control" id="editProductName" name="editProductName" placeholder="ชื่อสินค้า">
                                </div>
                                <div class="mb-3">
                                    <label for="editBuyPrice" class="form-label">ราคาสินค้า</label>
                                    <input type="number" class="form-control" id="editBuyPrice" name="editBuyPrice" placeholder="ราคาสินค้า">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                    <button type="submit" class="btn btn-warning">บันทึกการเปลี่ยนแปลง</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <table id="example" class="table table-striped " style="width:100%">
                    <thead>
                        <tr>
                            <th>รหัส</th>
                            <th>ชื่อ</th>
                            <th>ราคา</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- แสดงด้วย AJAX  -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/additional-methods.min.js" integrity="sha512-owaCKNpctt4R4oShUTTraMPFKQWG9UdWTtG6GRzBjFV4VypcFi6+M3yc4Jk85s3ioQmkYWJbUl1b2b2r41RTjA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- select  -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                // layout: {
                //     topStart: {
                //         buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                //     }
                // },
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: 'fetch_data.php', // ไฟล์ PHP ที่ดึงข้อมูล
                    type: 'POST'
                },
                columns: [{
                        data: 'productCode'
                    },
                    {
                        data: 'productName'
                    },
                    {
                        data: 'buyPrice'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-warning edit-button" data-product-code="' + row.productCode + '" data-product-name="' + row.productName + '" data-buy-price="' + row.buyPrice + '">แก้ไข</button>';
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-danger delete-button" data-product-code="' + row.productCode + '">ลบ</button>';
                        }
                    }
                ]
            });
        });
    </script>


    <!-- insert  -->
    <script>
        $(document).ready(function() {
            // กำหนดการตรวจสอบฟอร์ม
            $('#addProductForm').validate({
                rules: {
                    productName: {
                        required: true,
                        maxlength: 70 // จำกัดความยาวสูงสุด
                    },
                    buyPrice: {
                        required: true,
                        number: true,
                        min: 0, // ราคาไม่ควรเป็นลบ
                        max: 9999999999
                    }
                },
                messages: {
                    productName: {
                        required: "กรุณากรอกชื่อสินค้า",
                        maxlength: "ชื่อสินค้าต้องไม่เกิน 70 ตัวอักษร"
                    },
                    buyPrice: {
                        required: "กรุณากรอกราคาสินค้า",
                        number: "กรุณากรอกหมายเลขที่ถูกต้อง",
                        min: "ราคาสินค้าต้องไม่น้อยกว่า 0",
                        max: "ราคาสินค้าต้องไม่น้อยกว่า 9,999,999,999.00"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.mb-3').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                // ปรับแต่งสีของข้อความ error
                errorClass: 'text-danger',

                submitHandler: function(form) {
                    // ถ้าผ่านการตรวจสอบให้ส่งฟอร์ม
                    let formData = {
                        productName: $('#productName').val(),
                        buyPrice: $('#buyPrice').val()
                    };

                    // ส่งข้อมูลด้วย AJAX
                    $.ajax({
                        url: 'addProduct.php', // ไฟล์ PHP ที่จะใช้เพิ่มข้อมูล
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            console.log(response); // ตรวจสอบการตอบกลับของเซิร์ฟเวอร์
                            if (response.success) {
                                $('#example').DataTable().ajax.reload(); // โหลดข้อมูลใหม่ใน DataTable
                                $('#staticBackdrop').modal('hide'); // ปิด modal
                                $('#addProductForm')[0].reset(); // รีเซ็ตฟอร์ม
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เกิดข้อผิดพลาด!',
                                    text: response.message,
                                    confirmButtonText: 'ตกลง'
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR.responseText); // แสดงข้อผิดพลาดของการส่งข้อมูล
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!',
                                text: 'เกิดข้อผิดพลาดในการส่งข้อมูล',
                                confirmButtonText: 'ตกลง'
                            });
                        }
                    });
                }
            });
        });

        // แบบไม่ใช้ Jquery Validation form
        // $(document).ready(function() {
        //     $('#addProductForm').on('submit', function(e) {
        //         e.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

        //         // ดึงข้อมูลจากฟอร์ม
        //         let formData = {
        //             productName: $('#productName').val(),
        //             buyPrice: $('#buyPrice').val()
        //         };

        //         // ส่งข้อมูลด้วย AJAX
        //         $.ajax({
        //             url: 'addProduct.php', // ไฟล์ PHP ที่จะใช้เพิ่มข้อมูล
        //             type: 'POST',
        //             data: formData,
        //             success: function(response) {
        //                 console.log(response); // ตรวจสอบการตอบกลับของเซิร์ฟเวอร์
        //                 // ถ้าสำเร็จ อัปเดตตารางข้อมูล
        //                 if (response.success) {
        //                     $('#example').DataTable().ajax.reload(); // โหลดข้อมูลใหม่ใน DataTable
        //                     $('#staticBackdrop').modal('hide'); // ปิด modal
        //                     $('#addProductForm')[0].reset(); // รีเซ็ตฟอร์ม

        //                     // แสดงการแจ้งเตือนเมื่อเพิ่มสินค้าเรียบร้อย
        //                     Swal.fire({
        //                         icon: 'success',
        //                         title: 'สำเร็จ!',
        //                         text: 'เพิ่มสินค้าเรียบร้อยแล้ว!',
        //                         confirmButtonText: 'ตกลง'
        //                     });
        //                 } else {
        //                     // แสดงข้อผิดพลาดด้วย SweetAlert2
        //                     Swal.fire({
        //                         icon: 'error',
        //                         title: 'เกิดข้อผิดพลาด!',
        //                         text: response.message,
        //                         confirmButtonText: 'ตกลง'
        //                     });
        //                 }
        //             },
        //             error: function(jqXHR, textStatus, errorThrown) {
        //                 console.log(jqXHR.responseText); // แสดงข้อผิดพลาดของการส่งข้อมูล
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'เกิดข้อผิดพลาด!',
        //                     text: 'เกิดข้อผิดพลาดในการส่งข้อมูล',
        //                     confirmButtonText: 'ตกลง'
        //                 });
        //             }
        //         });

        //     });
        // });
    </script>

    <!-- edit -->
    <script>
        // จับเหตุการณ์การคลิกปุ่ม "แก้ไข"
        $('#example').on('click', '.edit-button', function() {
            const productCode = $(this).data('product-code');
            const productName = $(this).data('product-name');
            const buyPrice = $(this).data('buy-price');

            // กรอกข้อมูลลงในฟอร์ม
            $('#editProductCode').val(productCode);
            $('#editProductName').val(productName);
            $('#editBuyPrice').val(buyPrice);

            // แสดง Modal
            $('#editProductModal').modal('show');
        });

        // ใช้ jQuery Validation
        $('#editProductForm').validate({
            rules: {
                editProductName: {
                    required: true,
                    maxlength: 70 // จำกัดความยาวสูงสุด

                },
                editBuyPrice: {
                    required: true,
                    number: true,
                    min: 0, // ราคาไม่ควรเป็นลบ
                    max: 9999999999
                }
            },
            messages: {
                editProductName: {
                    required: "กรุณากรอกชื่อสินค้า",
                    maxlength: "ชื่อสินค้าต้องไม่เกิน 70 ตัวอักษร"
                },
                editBuyPrice: {
                    required: "กรุณากรอกราคาสินค้า",
                    number: "กรุณากรอกหมายเลขที่ถูกต้อง",
                    min: "ราคาสินค้าต้องไม่น้อยกว่า 0",
                    max: "ราคาสินค้าต้องไม่น้อยกว่า 9,999,999,999.00"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.mb-3').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            // ปรับแต่งสีของข้อความ error
            errorClass: 'text-danger',

            submitHandler: function(form) {
                // ดึงข้อมูลจากฟอร์ม
                let formData = {
                    productCode: $('#editProductCode').val(),
                    productName: $('#editProductName').val(),
                    buyPrice: $('#editBuyPrice').val()
                };

                // ส่งข้อมูลด้วย AJAX
                $.ajax({
                    url: 'editProduct.php', // ไฟล์ PHP ที่จะใช้แก้ไขข้อมูล
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response); // ตรวจสอบการตอบกลับของเซิร์ฟเวอร์
                        // ถ้าสำเร็จ อัปเดตตารางข้อมูล
                        if (response.success) {
                            $('#example').DataTable().ajax.reload(); // โหลดข้อมูลใหม่ใน DataTable
                            $('#editProductModal').modal('hide'); // ปิด modal

                            // แสดงการแจ้งเตือนเมื่อแก้ไขสินค้าเรียบร้อย
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ!',
                                text: 'แก้ไขสินค้าเรียบร้อยแล้ว!',
                                confirmButtonText: 'ตกลง'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!',
                                text: response.message,
                                confirmButtonText: 'ตกลง'
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.responseText); // แสดงข้อผิดพลาดของการส่งข้อมูล
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            text: 'เกิดข้อผิดพลาดในการส่งข้อมูล',
                            confirmButtonText: 'ตกลง'
                        });
                    }
                });
            }
        });

        // แบบไม่ใช้ Jquery Validation form
        // // จับเหตุการณ์การคลิกปุ่ม "แก้ไข"
        // $('#example').on('click', '.edit-button', function() {
        //     const productCode = $(this).data('product-code');
        //     const productName = $(this).data('product-name');
        //     const buyPrice = $(this).data('buy-price');

        //     // กรอกข้อมูลลงในฟอร์ม
        //     $('#editProductCode').val(productCode);
        //     $('#editProductName').val(productName);
        //     $('#editBuyPrice').val(buyPrice);

        //     // แสดง Modal
        //     $('#editProductModal').modal('show');
        // });

        // // จับเหตุการณ์การส่งฟอร์มแก้ไข
        // $('#editProductForm').on('submit', function(e) {
        //     e.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

        //     // ดึงข้อมูลจากฟอร์ม
        //     let formData = {
        //         productCode: $('#editProductCode').val(),
        //         productName: $('#editProductName').val(),
        //         buyPrice: $('#editBuyPrice').val()
        //     };

        //     // ส่งข้อมูลด้วย AJAX
        //     $.ajax({
        //         url: 'editProduct.php', // ไฟล์ PHP ที่จะใช้แก้ไขข้อมูล
        //         type: 'POST',
        //         data: formData,
        //         success: function(response) {
        //             console.log(response); // ตรวจสอบการตอบกลับของเซิร์ฟเวอร์
        //             // ถ้าสำเร็จ อัปเดตตารางข้อมูล
        //             if (response.success) {
        //                 $('#example').DataTable().ajax.reload(); // โหลดข้อมูลใหม่ใน DataTable
        //                 $('#editProductModal').modal('hide'); // ปิด modal

        //                 // แสดงการแจ้งเตือนเมื่อเพิ่มสินค้าเรียบร้อย
        //                 Swal.fire({
        //                     icon: 'success',
        //                     title: 'สำเร็จ!',
        //                     text: 'แก้ไขสินค้าเรียบร้อยแล้ว!',
        //                     confirmButtonText: 'ตกลง'
        //                 });
        //             } else {
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'เกิดข้อผิดพลาด!',
        //                     text: response.message,
        //                     confirmButtonText: 'ตกลง'
        //                 });
        //             }
        //         },
        //         error: function(jqXHR, textStatus, errorThrown) {
        //             console.log(jqXHR.responseText); // แสดงข้อผิดพลาดของการส่งข้อมูล
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: 'เกิดข้อผิดพลาด!',
        //                 text: 'เกิดข้อผิดพลาดในการส่งข้อมูล',
        //                 confirmButtonText: 'ตกลง'
        //             });
        //         }
        //     });
        // });
    </script>


    <!-- Delete  -->
    <script>
        // จับเหตุการณ์การคลิกปุ่ม "ลบ"
        $('#example').on('click', '.delete-button', function() {
            const productCode = $(this).data('product-code');

            // แสดง SweetAlert2 เพื่อยืนยันการลบ
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณจะไม่สามารถกู้คืนข้อมูลนี้ได้!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    // ส่งข้อมูลด้วย AJAX เพื่อลบข้อมูล
                    $.ajax({
                        url: 'deleteProduct.php', // ไฟล์ PHP ที่จะใช้ลบข้อมูล
                        type: 'POST',
                        data: {
                            productCode: productCode
                        },
                        success: function(response) {
                            console.log(response); // ตรวจสอบการตอบกลับของเซิร์ฟเวอร์
                            if (response.success) {
                                $('#example').DataTable().ajax.reload(); // โหลดข้อมูลใหม่ใน DataTable
                                Swal.fire({
                                    icon: 'success',
                                    title: 'ลบสำเร็จ!',
                                    text: 'ข้อมูลได้ถูกลบเรียบร้อยแล้ว.',
                                    confirmButtonText: 'ตกลง'
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เกิดข้อผิดพลาด!',
                                    text: response.message,
                                    confirmButtonText: 'ตกลง'
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR.responseText); // แสดงข้อผิดพลาดของการส่งข้อมูล
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!',
                                text: 'เกิดข้อผิดพลาดในการส่งข้อมูล',
                                confirmButtonText: 'ตกลง'
                            });
                        }
                    });
                }
            });
        });
    </script>


</body>

</html>