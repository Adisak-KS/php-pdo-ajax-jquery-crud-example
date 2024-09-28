<?php
$servername = "localhost";
$username = "root";
$password = "";
$dns = "mysql:host=$servername;dbname=crud_example";

try {
    $conn = new PDO($dns, $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    require_once('controller/ProductController.php');
    $ProductController = new ProductController($conn);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
