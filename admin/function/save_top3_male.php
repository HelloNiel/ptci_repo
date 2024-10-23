<?php
session_start();
include '../../partial/connection.php';

$cand_no = $_POST['cand_no'];
$cand_fn = $_POST['cand_fn'];
$cand_team = $_POST['cand_team'];
$total_score = $_POST['total_score'];

for ($i = 0; $i < count($cand_no); $i++) {
    $query = "INSERT INTO top3_candidate_male (cand_no, cand_fn, cand_team, score, percentage_score) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('issss', $cand_no[$i], $cand_fn[$i], $cand_team[$i], $total_score[$i], number_format($total_score[$i], 2));
    $stmt->execute();
}

$_SESSION['success'] = "Top 3 male candidates have been successfully saved.";
header("Location: ../top3_finalists.php");
exit();
