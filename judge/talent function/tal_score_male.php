<?php
session_start();
include '../../partial/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['jdg_id'])) {
        $_SESSION['error_message'] = "You must be logged in to submit scores.";
        header("Location: ../maletalent.php");
        exit();
    }

    $jdg_id = $_SESSION['jdg_id'];

    $stmt = $conn->prepare("INSERT INTO male_talent (tal_mastery, tal_performance, tal_impression, tal_audience, tal_total_score, fullname, course, team, candidate_no, cand_id, jdg_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        $_SESSION['error_message'] = "Database error: Unable to prepare statement.";
        header("Location: ../maletalent.php");
        exit();
    }

    if (empty($_POST)) {
        $_SESSION['error_message'] = "No data received.";
        header("Location: ../maletalent.php");
        exit();
    }

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'mastery_') === 0) {
            $cand_no = str_replace('mastery_', '', $key);
            $mastery = (int)$value;
            $performance = (int)$_POST["performance_$cand_no"];
            $impression = (int)$_POST["impression_$cand_no"];
            $audience = (int)$_POST["audience_$cand_no"];
            $total_score = ($mastery + $performance + $impression + $audience) * 0.1;

            $query = $conn->prepare("SELECT cand_id, cand_fn, cand_ln, cand_course, cand_team FROM candidates WHERE cand_no = ?");
            $query->bind_param("s", $cand_no);
            $query->execute();
            $result = $query->get_result();
            $candidate = $result->fetch_assoc();

            if (!$candidate) {
                $_SESSION['error_message'] = "Candidate not found for candidate_no: $cand_no.";
                header("Location: ../maletalent.php");
                exit();
            }

            $fullname = $candidate['cand_fn'] . ' ' . $candidate['cand_ln'];
            $cand_id = $candidate['cand_id'];

            $stmt->bind_param("iiiiiissssi", $mastery, $performance, $impression, $audience, $total_score, $fullname, $candidate['cand_course'], $candidate['cand_team'], $cand_no, $cand_id, $jdg_id);

            if (!$stmt->execute()) {
                $_SESSION['error_message'] = "Error executing statement for candidate_no $cand_no: " . $stmt->error;
                header("Location: ../maletalent.php");
                exit();
            }
        }
    }

    $stmt->close();
    $query->close();
    $conn->close();

    $_SESSION['success_message'] = "Scores submitted successfully!";
    header("Location: ../maletalent.php");
    exit();
} else {
    header("Location: ../maletalent.php");
    exit();
}
