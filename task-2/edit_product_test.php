<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .center-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-control {
            width: 100%;
        }
        .form-label {
            padding-top: 10px;
        }
        h1 {
            text-align: center;
            margin-bottom: 5%;
        }
        .form-container {
            border: 1px solid #ccc;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            border-radius: 10px;
        }
        #submit-btn {
            background-color: green;
            margin-left: 35%;
        }
    </style>
</head>
<body>
    <div class="center-form">
        <div class="form-container">
            <h1>Edit Product</h1>
            <form action="display_product_table.php" method="POST">
            <input type="hidden" name="edit_id" value="<?php echo isset($_POST['edit_id']) ? $_POST['edit_id'] : ''; ?>">   
                <div class="mb-3">
                    <label for="inputname" class="form-label">Name:</label>
                    <select class="form-select" id="inputname" name="name">
                        <option selected disabled>Select Name</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="inputsku" class="form-label">SKU (Stock Keeping Unit):</label>
                    <input type="text" class="form-control" id="inputsku" name="sku" required>
                </div>
                <div class="mb-3">
                    <label for="inputcatid" class="form-label">Category ID:</label>
                    <select class="form-select" id="inputcatname" name="catid" required>
                    <option selected disabled >Select Category</option>
                        <option value="category1">Category 1</option>
                        <option value="category2">Category 2</option>
                        <option value="category3">Category 3</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="inputprice" class="form-label">Price:</label>
                    <input type="number" class="form-control" id="inputprice" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="inputimg" class="form-label">Image:</label>
                    <input type="file" class="form-control" id="inputimg" name="img">
                </div>
                <button type="submit" class="btn btn-primary" id="submit-btn">Update</button>
                <a href="display_product_table.php" class="btn btn-outline-danger">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>
