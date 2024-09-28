<?php
class ProductController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function getProducts($limit, $offset)
    {
        try {
            $sql = "SELECT * FROM products LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
            return false;
        }
    }

    public function getTotalProducts()
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM products";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
            return false;
        }
    }


    // public function manageProductsServerSide($start, $length, $search)
    // {
    //     try {
    //         // เริ่มสร้าง SQL Query
    //         $sql = "SELECT productCode, productName, buyPrice FROM products";

    //         // ตรวจสอบว่ามีการค้นหาหรือไม่
    //         if (!empty($search)) {
    //             $sql .= " WHERE productCode LIKE :search OR productName LIKE :search OR buyPrice LIKE :search";
    //         }

    //         // เพิ่มเงื่อนไข limit
    //         $sql .= " LIMIT :start, :length";

    //         // เตรียม query
    //         $stmt = $this->conn->prepare($sql);

    //         // ถ้ามีการค้นหา ให้ bind ค่า %search%
    //         if (!empty($search)) {
    //             $searchParam = "%$search%";
    //             $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
    //         }

    //         $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    //         $stmt->bindParam(':length', $length, PDO::PARAM_INT);
    //         $stmt->execute();

    //         // ดึงผลลัพธ์
    //         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //         // นับจำนวนข้อมูลทั้งหมด
    //         $totalSql = "SELECT COUNT(*) as total FROM products";
    //         $totalStmt = $this->conn->query($totalSql);
    //         $totalCount = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];

    //         return [
    //             'data' => $result,
    //             'total' => $totalCount
    //         ];
    //     } catch (PDOException $e) {
    //         echo "Error: " . $e->getMessage();
    //         return false;
    //     }
    // }

    public function manageProductsServerSide($start, $length, $search, $orderColumn, $orderDir)
    {
        try {
            // เริ่มสร้าง SQL Query
            $sql = "SELECT productCode, productName, buyPrice FROM products";

            // ตรวจสอบว่ามีการค้นหาหรือไม่
            if (!empty($search)) {
                $sql .= " WHERE productCode LIKE :search OR productName LIKE :search OR buyPrice LIKE :search";
            }

            // เพิ่มเงื่อนไขการจัดเรียง
            $columns = ['productCode', 'productName', 'buyPrice']; // คอลัมน์ที่จัดเรียงได้
            if (isset($columns[$orderColumn])) {
                $sql .= " ORDER BY " . $columns[$orderColumn] . " " . strtoupper($orderDir);
            }

            // เพิ่มเงื่อนไข limit
            $sql .= " LIMIT :start, :length";

            // เตรียม query
            $stmt = $this->conn->prepare($sql);

            // ถ้ามีการค้นหา ให้ bind ค่า %search%
            if (!empty($search)) {
                $searchParam = "%$search%";
                $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
            }

            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $stmt->bindParam(':length', $length, PDO::PARAM_INT);
            $stmt->execute();

            // ดึงผลลัพธ์
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // นับจำนวนข้อมูลทั้งหมด
            $totalSql = "SELECT COUNT(*) as total FROM products";
            $totalStmt = $this->conn->query($totalSql);
            $totalCount = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];

            return [
                'data' => $result,
                'total' => $totalCount
            ];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function addProduct($productName, $buyPrice)
    {
        try {
            $sql = "INSERT INTO products (productName, buyPrice) VALUES ( :productName, :buyPrice)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':productName', $productName);
            $stmt->bindParam(':buyPrice', $buyPrice);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function updateProduct($productCode, $productName, $buyPrice)
    {
        try {
            $sql = "UPDATE products 
                    SET productName = :productName, 
                        buyPrice = :buyPrice 
                    WHERE productCode = :productCode";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':productName', $productName);
            $stmt->bindParam(':buyPrice', $buyPrice);
            $stmt->bindParam(':productCode', $productCode);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function deleteProduct($productCode)
    {
        try {
            $sql = "DELETE FROM products WHERE productCode = :productCode";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':productCode', $productCode);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
