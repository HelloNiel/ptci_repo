<?php
session_start();    
include '../../partial/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cand_no = $_POST['cand_no'];
    $cand_fn = $_POST['cand_fn'];
    $cand_ln = $_POST['cand_ln'];
    $cand_team = $_POST['cand_team'];

    $conn->query("DELETE FROM top5_candidate_male");

    $stmt = $conn->prepare("INSERT INTO top5_candidate_male (cand_no, cand_fn, cand_ln, cand_team) VALUES (?, ?, ?, ?)");
    
    for ($i = 0; $i < count($cand_no); $i++) {
        $stmt->bind_param("isss", $cand_no[$i], $cand_fn[$i], $cand_ln[$i], $cand_team[$i]);
        $stmt->execute();
    }

    $stmt->close();
    $_SESSION['success_message'] = "Top 5 Male Candidates saved successfully!";
    header("Location: ../top5_list.php");
    exit;
}
?>
