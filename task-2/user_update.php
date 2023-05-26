<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit;
}

$name = $_SESSION['name'];
$roleid = isset($_SESSION['roleid']) ? $_SESSION['roleid'] : "N/A";

// Database connection
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "task-2";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['name'];
    $newRoleId = $_POST['roleid'];

    // Update the roleid in the database based on the name
    $sql = "UPDATE register SET roleid = '$newRoleId' WHERE name = '$newName'";
    if (mysqli_query($conn, $sql)) {
        // Update successful
        $roleid = $newRoleId;
        $message = "Data Updated Succesfully";
        $alertClass = "alert-success";
    } else {
        // Update failed
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        

        .navbar-nav {
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            width: 400px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 100px;
        }

        h1{
            margin-top : 100px;
        }

        
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user_update</title>
</head>
<body>
    <h1 class="text-center mb-4">user_update</h1>
    <form class="form-container" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Username</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
        </div> 
        <div class="mb-3">
            <label for="roleid" class="form-label">Role ID:-</label>
            <input type="text" class="form-control" id="roleid" name="roleid" value="<?php echo $roleid; ?>">
        </div>
        <button type="submit" class="btn btn-success btn-block">Login</button>
    </form>
    <?php if(isset($message)): ?>
        <div class="alert mt-3 <?php echo $alertClass; ?>"><?php echo $message; ?></div>
    <?php endif; ?>
</body>
</html>
