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
    $jdg_name = mysqli_real_escape_string($connection, $_POST['jdg_name']);
    $jdg_username = mysqli_real_escape_string($connection, $_POST['jdg_username']);
    $jdg_pass = mysqli_real_escape_string($connection, $_POST['jdg_pass']);

    $hashed_pass = password_hash($jdg_pass, PASSWORD_DEFAULT);

    $query = "INSERT INTO judge (jdg_name, jdg_username, jdg_pass) VALUES ('$jdg_name', '$jdg_username', '$hashed_pass')";

    if (mysqli_query($connection, $query)) {
        $_SESSION['success_message'] = "Judge added successfully!";
        header("Location: ../add_judge.php"); 
        exit();
    } else {
        $_SESSION['error_message'] = "Error: " . mysqli_error($connection);
        header("Location: ../add_judge.php");
        exit();
    }
}

mysqli_close($connection);
?>
