<?php


$db = mysqli_connect("localhost","root","","task-2");


$roleid = "";
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobileno = $_POST['mobileno'];
    $address = $_POST['address'];
    $roleid = $_POST['roleid']; 

    $sql = $db->query("INSERT INTO register (name, email, password, mobileno, address, roleid) VALUES ('$name', '$email', '$password', '$mobileno', '$address', '$roleid')");

    if ($sql) {
        echo "New record created successfully";
    }
}



?>
