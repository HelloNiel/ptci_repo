<?php
session_start();
require './partial/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT jdg_id, jdg_name, jdg_pass FROM judge WHERE jdg_username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['jdg_pass'])) {
            $_SESSION['jdg_id'] = $row['jdg_id'];
            $_SESSION['jdg_name'] = $row['jdg_name'];
            header("Location: ./judge/home.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: judgelogin.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: judgelogin.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
