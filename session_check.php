<?php
session_start();

function checkLogin() {
    if (!isset($_SESSION['admin_id']) || !isset($_SESSION['username'])) {
        header("Location: ./adminlogin.php");
        exit();
    }
}
?>
