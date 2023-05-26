<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script>
  $(document).ready(function() {
    // Custom validation method to check file extension
    $.validator.addMethod('fileExtension', function(value, element, param) {
      param = typeof param === 'string' ? param.replace(/,/g, '|') : 'png|jpe?g';
      return this.optional(element) || value.match(new RegExp('.(' + param + ')$', 'i'));
    }, 'Only PNG and JPEG images are allowed.');

    // Form validation
    $('#product-form').validate({
      rules: {
        name: {
          required: true
        },
        
        price: {
          required: true,
          number: true
        },
        img: {
          fileExtension: 'png,jpg,jpeg'
        }
      },
      messages: {
        name: {
          required: 'Please select a name for the product.'
        },
       
        price: {
          required: 'Please enter the price.',
          number: 'Please enter a valid number for the price.'
        },
        img: {
          fileExtension: 'Only PNG and JPEG images are allowed.'
        }
      }
    });
  });
</script>


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
      <h1>Product</h1>
      <form id="product-form" action="add_data_product.php" method="POST">
        <div class="mb-3">
          <label for="inputname" class="form-label">Name:</label>
          <input type="text" class="form-control" id="inputname" name="name" required>
        </div>
        <div class="mb-3">
          <label for="inputsku" class="form-label">SKU (Stock Keeping Unit):</label>
          <input type="text" class="form-control" id="inputsku" name="sku" required>
        </div>
        <div class="mb-3">
          <label for="inputcatid" class="form-label">Category name:</label>
          <select class="form-select" id="inputcatname" name="catid" required>
          <option selected disabled >Select Category</option>
            <option value="category1">Category 1</option>
            <option value="category2">Category 2</option>
            <option value="category3">Category 3</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="inputprice" class="form-label" id="label_price">Price:</label>
          <input type="number" class="form-control" id="inputprice" name="price" required>
        </div>
        <div class="mb-3">
          <label for="inputimg" class="form-label">Image:</label>
          <input type="file" class="form-control" id="inputimg" name="img">
        </div>
        <button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>
        <a href="display_product_table.php" class="btn btn-outline-danger">View</a>
      </form>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('#product-form').validate();
    });
  </script>
</body>
</html>
