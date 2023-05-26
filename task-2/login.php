<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = mysqli_connect("localhost","root","","task-2");

    $name = $_POST['name'];
    $password = $_POST['password'];
    $roleid = $_POST['roleid'];

    $query = "SELECT name, password, roleid FROM register WHERE name = '$name' AND password = '$password' AND roleid = '$roleid'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Login successful
        $message = "Connection Successfully";
        $alertClass = "alert-success";

        session_start();
        $_SESSION['name'] = $name;
        $_SESSION['roleid'] = $roleid;
        header("Location: home_page.php");
        exit;
    } else {
        // Invalid username or password
        $message = "Invalid username or password.";
        $alertClass = "alert-danger";
    }

    mysqli_close($db);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: cyan;
            margin: 0;
            padding: 0;
        }
        .form-container {
            animation: fadeIn 1s;
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 form-container">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Login</h1>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Username</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="roleid" class="form-label">Role ID:-</label>
                                <input type="roleid" class="form-control" id="roleid" name="roleid">
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Login</button>
                        </form>

                        <?php if(isset($message)): ?>
                            <div class="alert mt-3 <?php echo $alertClass; ?>"><?php echo $message; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
