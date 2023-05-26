<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit;
}

$name = $_SESSION['name'];
$roleid = isset($_SESSION['roleid']) ? $_SESSION['roleid'] : "N/A";


$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "task-2";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT permission FROM addrole WHERE rolename = '$roleid'";
$result = $conn->query($sql);

$permission = "";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $permission = $row['permission'];
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/d98a6653af.js" crossorigin="anonymous"></script>
    <style>
        .center-message {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            font-size: 40px;
        }

        .deco{
            color : blue;
            margin-left:20px;
            margin-right:20px;
        }

        .navbar-nav {
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home_Page</title>

    <?php
    if (basename($_SERVER['PHP_SELF']) === "login.php" && isset($_SESSION['name'])) {
        echo '<script>window.location.href = "home_page.php";</script>';
    }
    ?>

</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button type="button" class="btn btn-outline-dark" onclick="displayHomeMessage()">Home</button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <?php
                    if (strpos($permission, 'register') !== false) {
                        echo '<button type="button" class="btn btn-outline-success" onclick="window.location.href = \'register.php\'">Register</button>';
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <?php
                    if (strpos($permission, 'user_update') !== false) {
                        echo '<button type="button" class="btn btn-outline-dark" onclick="window.location.href = \'user_update.php\'">User Update</button>';
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <?php
                    if (strpos($permission, 'add_role') !== false) {
                        echo '<button type="button" class="btn btn-outline-danger" onclick="window.location.href = \'select_role.php\'">Add Role</button>';
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-outline-primary" onclick="window.location.href = 'contact_us.php'">Contact Us</button>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#"><?php echo $name; ?></a>
                        <a class="dropdown-item" href="#"><?php echo $roleid; ?></a>
                        <a class="dropdown-item" href="#">
                            <?php
                            if (isset($_SESSION['name'])) {
                                echo '<button type="button" class="btn btn-outline-danger" onclick="window.location.href = \'logout.php\'">Logout</button>';
                            }
                            ?>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

    
    <h1 class="center-message">Welcome, <span class="deco"><?php echo $name.' '; ?> </span>  You're  <?php echo $roleid; ?> !! </h1>
    
</body>
</html>
