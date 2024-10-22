<?php 
session_start();
include '../../partial/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judge_id = isset($_SESSION['jdg_id']) ? intval($_SESSION['jdg_id']) : null;

    if ($judge_id !== null) {
        foreach ($_POST['score'] as $cand_no => $score) {
            if (!empty($score) && is_numeric($score) && $score >= 7 && $score <= 10) {
                $stmt = $conn->prepare("INSERT INTO unif_score_male (cand_no, score, judge_id) 
                                        VALUES (?, ?, ?)
                                        ON DUPLICATE KEY UPDATE score = VALUES(score)");
                if ($stmt) {
                    $stmt->bind_param("iii", $cand_no, $score, $judge_id);
                    if (!$stmt->execute()) {
                        $_SESSION['error_message'] = "Failed to submit score for candidate. Error: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    $_SESSION['error_message'] = "Database error: Unable to prepare statement.";
                }
            } else {
                $_SESSION['error_message'] = "Please complete all required fields before submitting your vote for the candidates.";
            }
        }

        $total_stmt = $conn->prepare("
            INSERT INTO male_candidate_total_scores (cand_no, unif_total)
            SELECT cand_no, AVG(score) -- Use AVG for the actual average calculation
            FROM unif_score_male
            GROUP BY cand_no
            ON DUPLICATE KEY UPDATE unif_total = VALUES(unif_total); -- Update unif_total correctly
        ");
        
        if ($total_stmt) {
            $total_stmt->execute();
            $total_stmt->close();
        } else {
            $_SESSION['error_message'] = "Failed to update total scores.";
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
?>
