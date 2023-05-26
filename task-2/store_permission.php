<?php
// store_permissions.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted role name
    $roleName = $_POST['roleid'];

    // Retrieve the selected permissions
    $selectedPermissions = $_POST['permission'];

    // Convert the array to a string
    $permissionsString = implode(', ', $selectedPermissions);

    // Process the selected permissions
    // ...

    // Database connection details
    $servername = 'localhost:3306';
    $username = 'root';
    $password = '';
    $dbname = 'task-2';

    // Create a new database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare('INSERT INTO addrole (rolename, permission) VALUES (?, ?)');
    
    // Bind the parameters to the SQL statement
    $stmt->bind_param('ss', $roleName, $permissionsString);
    
    // Execute the SQL statement
    if ($stmt->execute()) {
        echo 'Permissions stored successfully.';
    } else {
        echo 'Error storing permissions: ' . $conn->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}
?>
