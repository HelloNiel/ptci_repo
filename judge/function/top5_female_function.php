<?php 
session_start();
include '../../partial/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judge_id = isset($_SESSION['jdg_id']) ? intval($_SESSION['jdg_id']) : null;

    if ($judge_id !== null) {
        foreach ($_POST['score'] as $cand_no => $score) {
            if (!empty($score) && is_numeric($score) && $score >= 6 && $score <= 10) {
                $stmt = $conn->prepare("INSERT INTO top5_scores_female (cand_no, score, judge_id, cand_fn, cand_ln, cand_team) 
                                        VALUES (?, ?, ?, ?, ?, ?)
                                        ON DUPLICATE KEY UPDATE score = VALUES(score)");
                if ($stmt) {
                    $candidate_stmt = $conn->prepare("SELECT cand_fn, cand_ln, cand_team FROM top5_candidate_female WHERE cand_no = ?");
                    $candidate_stmt->bind_param("i", $cand_no);
                    $candidate_stmt->execute();
                    $candidate_stmt->bind_result($cand_fn, $cand_ln, $cand_team);
                    $candidate_stmt->fetch();
                    $candidate_stmt->close();

                    $score = intval($score);

                    error_log("cand_no: $cand_no, score: $score, judge_id: $judge_id, cand_fn: $cand_fn, cand_ln: $cand_ln, cand_team: $cand_team");

                    if ($cand_no !== null && $score !== null && $judge_id !== null && $cand_fn !== null && $cand_ln !== null && $cand_team !== null) {
                        $stmt->bind_param("iiisss", $cand_no, $score, $judge_id, $cand_fn, $cand_ln, $cand_team);
                        if (!$stmt->execute()) {
                            $_SESSION['error_message'] = "Failed to submit score for candidate {$cand_no}. Error: " . $stmt->error;
                        }
                    } else {
                        $_SESSION['error_message'] = "One or more candidate details are missing or invalid.";
                    }
                    $stmt->close();
                } else {
                    $_SESSION['error_message'] = "Database error: Unable to prepare statement.";
                }
            } else {
                $_SESSION['error_message'] = "Please complete all required fields before submitting your vote for the candidates.";
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
header("Location: ../top5_female.php"); // Adjusted redirection to female page
exit();
?>
