<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "dbconfig2.php";

    // Check if 'id' key exists in $_POST array
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        $id = null; // Set default value or handle the error
    }

    $name = $_POST['name'];
    $sku = $_POST['sku'];
    $catid = $_POST['catid'];
    $price = $_POST['price'];
    $img = $_POST['img'];

    $insertQuery = "INSERT INTO `product` (`id`, `name`, `sku`, `catid`, `price`, `img`) VALUES (:id, :name, :sku, :catid, :price, :img)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':sku', $sku);
    $stmt->bindParam(':catid', $catid);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':img', $img);
    $stmt->execute();
    echo "Data inserted successfully";
}
?>
