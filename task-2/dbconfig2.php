<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "task-1";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // $product_table = "CREATE TABLE product (
    //     id INT PRIMARY KEY AUTO_INCREMENT,
    //     name VARCHAR(255) NOT NULL,
    //     sku VARCHAR(255) NOT NULL,
    //     catid VARCHAR(255) NOT NULL,
    //     price INT NOT NULL,
    //     img BLOB
    // )";

    // $conn->exec($product_table);
    // echo "Table 'product' is creaed";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
