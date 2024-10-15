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
    $cand_no = mysqli_real_escape_string($connection, $_POST['cand_no']);
    $cand_ln = mysqli_real_escape_string($connection, $_POST['cand_ln']);
    $cand_fn = mysqli_real_escape_string($connection, $_POST['cand_fn']);
    $cand_gender = mysqli_real_escape_string($connection, $_POST['cand_gender']);
    
    $cand_team = mysqli_real_escape_string($connection, $_POST['cand_team']);
    $cand_course = mysqli_real_escape_string($connection, $_POST['cand_course']);

    if (empty($cand_team) || empty($cand_course)) {
        $_SESSION['error_message'] = "Invalid team or course selection.";
        header("Location: ../add_candidate.php");
        exit();
    }

    $query = "INSERT INTO candidates (cand_no, cand_team, cand_ln, cand_fn, cand_gender, cand_course) 
              VALUES ('$cand_no', '$cand_team', '$cand_ln', '$cand_fn', '$cand_gender', '$cand_course')";

    if (mysqli_query($connection, $query)) {
        $_SESSION['success_message'] = "Candidate added successfully!";
        header("Location: ../add_candidate.php"); 
        exit();
    } else {
        $_SESSION['error_message'] = "Error: " . mysqli_error($connection);
        header("Location: ../add_candidate.php");
        exit();
    }
}

mysqli_close($connection);
?>
