<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        function confirmDelete(productId) {
            if (confirm("Are you sure you want to delete this product?")) {
                window.location.href = "display_product_table.php?delete_id=" + productId;
            }
        }
    </script>
</head>


<body>
<div class="container">
        <div class="row">
            <div class="col-12">
                <a href="product-form.php" class="btn btn-primary">ADD</a>
            </div>
        </div>
    </div>
    <?php
    require_once "dbconfig2.php";

    // Check if delete request is received
    if (isset($_GET['delete_id'])) {
        $deleteId = $_GET['delete_id'];
        $deleteQuery = "DELETE FROM product WHERE id = :id";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bindParam(':id', $deleteId);
        $stmt->execute();

        // Redirect to the same page with a success message
        header("Location: display_product_table.php?msg=Product deleted successfully");
        exit();
    }

    if (isset($_REQUEST['msg'])) {
        echo "<h4>{$_REQUEST['msg']}</h4>";
    }

    // Handle form submission for editing a product
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
        $editId = $_POST['edit_id'];
        $name = $_POST['name'];
        $sku = $_POST['sku'];
        $catid = $_POST['catid'];
        $price = $_POST['price'];
        $img = $_POST['img'];

        $updateQuery = "UPDATE product SET name = :name, sku = :sku, catid = :catid, price = :price, img = :img WHERE id = :id";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':catid', $catid);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':img', $img);
        $stmt->bindParam(':id', $editId);
        $stmt->execute();

        // Redirect to the same page with a success message
        header("Location: display_product_table.php?msg=Product updated successfully");
        exit();
    }
    ?>

    <table class="table table-bordered border-primary">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Sku</th>
                <th>category_Name</th>
                <th>Price</th>
                <th>Image</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $selectQuery = "SELECT * FROM product";
            $stmt = $conn->query($selectQuery);
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch()) {
                    ?>
                    <tr >
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['sku']; ?></td>
                        <td><?php echo $row['catid']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><img width="100" src="<?php echo $row['img']; ?>"></td>
                        <td>
                        <form method="POST" action="edit_product_test.php">
                            <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </td>

                        <td>
                            <button type="button" class="btn btn-danger" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>
