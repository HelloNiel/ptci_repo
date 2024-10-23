<?php
session_start();

$dbServer = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "ptci_db";

$connection = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_name = mysqli_real_escape_string($connection, $_POST['admin_name']);
    $admin_username = mysqli_real_escape_string($connection, $_POST['admin_username']);
    $admin_pass = mysqli_real_escape_string($connection, $_POST['admin_pass']);

    $hashed_pass = password_hash($admin_pass, PASSWORD_DEFAULT);

    $query = "INSERT INTO admin_accounts (username, password) VALUES ('$admin_username', '$hashed_pass')";

    if (mysqli_query($connection, $query)) {
        $_SESSION['success_message'] = "Admin added successfully!";
        header("Location: ../add_admin.php"); 
        exit();
    } else {
        $_SESSION['error_message'] = "Error: " . mysqli_error($connection);
        header("Location: ../add_admin.php");
        exit();
    }
}

mysqli_close($connection);
?>
