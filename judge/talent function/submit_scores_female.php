<?php
session_start();
include '../../partial/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judge_id = isset($_SESSION['jdg_id']) ? intval($_SESSION['jdg_id']) : null;

    if ($judge_id !== null) {
        foreach ($_POST['score'] as $cand_no => $score) {
            if (!empty($score) && is_numeric($score) && $score >= 7 && $score <= 10) {
                $stmt = $conn->prepare("INSERT INTO unif_score_female (cand_no, score, judge_id) VALUES (?, ?, ?)
                                        ON DUPLICATE KEY UPDATE score = VALUES(score)");
                if ($stmt) {
                    $stmt->bind_param("sii", $cand_no, $score, $judge_id);
                    if (!$stmt->execute()) {
                        $_SESSION['error_message'] = "Failed to submit score for candidate {$cand_no}.";
                    }
                    $stmt->close();
                } else {
                    $_SESSION['error_message'] = "Database error: Unable to prepare statement.";
                }
            } else {
                $_SESSION['error_message'] = "Invalid score for candidate {$cand_no}.";
            }
        }
        if (!isset($_SESSION['error_message'])) {
            $_SESSION['success_message'] = "Scores submitted successfully!";
        }
    } else {
        $_SESSION['error_message'] = "Invalid judge ID.";
    }
}

$conn->close();
header("Location: ../maleuniform.php");
exit();
