<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" class="css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .form-check {
            display: inline-block;
            margin-right: 20px;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Registration Form</h1>
        <?php
        $db = mysqli_connect("localhost", "root", "", "task-2");

        $roleid = "";
        if (isset($_POST['submitted'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $mobileno = $_POST['mobileno'];
            $address = $_POST['address'];
            $roleid = $_POST['roleid'];

            $sql = $db->query("INSERT INTO register (name, email, password, mobileno, address, roleid) VALUES ('$name', '$email', '$password', '$mobileno', '$address', '$roleid')");

            if ($sql) {
                $message = "New person inserted successfully";
                $alertClass = "alert-success";
            } else {
                $message = "Invalid details";
                $alertClass = "alert-danger";
            }
        }

        // Fetch checkbox options from the database table
        $roleQuery = $db->query("SELECT rolename FROM addrole");
        $checkboxOptions = array();
        while ($row = mysqli_fetch_assoc($roleQuery)) {
            $checkboxOptions[] = $row['rolename'];
        }
        ?>

        <?php if (isset($message)) : ?>
            <div class="alert <?php echo $alertClass; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <form id="registrationForm" method="POST">
            <input type="hidden" name="submitted" value="true"> <!-- Add a hidden input field to track form submission -->
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" name="mobileno" id="mobileno">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" name="address" id="address"></textarea>
            </div>
            <div class="form-group">
                <label for="roleSelect">Select Role :-</label>
                <?php foreach ($checkboxOptions as $option) : ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="roleid" value="<?php echo $option; ?>">
                        <label class="form-check-label"><?php echo $option; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

            <button class="btn btn-outline-success" type="submit" name="submit">SUBMIT</button>
            <div class="sign-in">
                <p>Already Have An Account ?<p><a href='login.php'>Signin</a>
            </div>
        </form>
    </div>

    <script>
    $(document).ready(function () {
        $("#registrationForm").on("submit", function (e) {
            e.preventDefault();

            var formData = {
                name: $("#name").val().trim(),
                roleid: $("input[name='roleid']:checked").val(),
                email: $("#email").val().trim(),
                address: $("#address").val().trim(),
                mobileno: $("#mobileno").val().trim(),
                password: $("#password").val().trim(),
                submitted: true
            };

            $.ajax({
                url: "register.php",
                type: "POST",
                data: formData,
                success: function (response) {
                    console.log(response);
                    var result = JSON.parse(response);
                    var message = result.message;
                    var alertClass = result.success ? 'alert-success' : 'alert-danger';
                    $('.alert').remove();
                    $('#registrationForm').prepend('<div class="alert ' + alertClass + '">' + message + '</div>');
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    $('.alert').remove();
                    $('#registrationForm').prepend('<div class="alert alert-danger">An error occurred. Please try again later.</div>');
                }
            });
        });
    });
</script>


</body>

</html>
