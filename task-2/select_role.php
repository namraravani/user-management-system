<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
        }
        

        .form-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-submit {
            margin-top: 20px;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>select_role</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault(); // Prevent form submission
                var form = $(this);
                var url = form.attr('action');
                var formData = new FormData(form[0]);

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        
                        $('.alert').remove();
                        form.prepend('<div class="alert alert-success">Role added successfully.</div>');
                        form[0].reset(); 
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        
                        $('.alert').remove();
                        form.prepend('<div class="alert alert-danger">An error occurred while adding the role. Please try again later.</div>');
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">ADD_Role</h1>

        <form action="store_permission.php" method="POST">
            <div class="mb-3">
                <label for="roleid" class="form-label">Role Name</label>
                <input type="text" class="form-control" id="roleid" name="roleid">
            </div>
            <div class="mb-3">
                <label class="form-label">Permissions</label>
                <div class="row">
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="product" id="permission-product">
                            <label class="form-check-label" for="permission-product">Product</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="contact_us" id="permission-contact">
                            <label class="form-check-label" for="permission-contact">Contact Us</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="Home" id="permission-home">
                            <label class="form-check-label" for="permission-home">Home</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="user_update" id="permission-user">
                            <label class="form-check-label" for="permission-user">User Update</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="add_role" id="permission-add-role">
                            <label class="form-check-label" for="permission-add-role">Add Role</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="login" id="permission-login">
                            <label class="form-check-label" for="permission-login">Login</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permission[]" value="register" id="permission-register">
                            <label class="form-check-label" for="permission-register">Register</label>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-submit">ADD</button>
        </form>
    </div>
</body>
</html>
