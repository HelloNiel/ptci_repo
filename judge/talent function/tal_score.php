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

    // Prepare the insert statement
    $stmt = $conn->prepare("INSERT INTO talent (tal_mastery, tal_performance, tal_impression, tal_audience, tal_total_score, fullname, course, team, candidate_no, jdg_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check for errors in preparing the statement
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Debugging: Check POST data
    if (empty($_POST)) {
        die("No data received.");
    }

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'mastery_') === 0) {
            $cand_no = str_replace('mastery_', '', $key);
            $mastery = (int)$value;
            $performance = (int)$_POST["performance_$cand_no"];
            $impression = (int)$_POST["impression_$cand_no"];
            $audience = (int)$_POST["audience_$cand_no"];
            $total_score = ($mastery + $performance + $impression + $audience) * 0.1;


            // Get candidate details
            $query = $conn->prepare("SELECT cand_fn, cand_ln, cand_course, cand_team FROM candidates WHERE cand_no = ?");
            $query->bind_param("s", $cand_no);
            $query->execute();
            $result = $query->get_result();
            $candidate = $result->fetch_assoc();

            if (!$candidate) {
                echo "Candidate not found for candidate_no: $cand_no<br>";
                continue;
            }

            $fullname = $candidate['cand_fn'] . ' ' . $candidate['cand_ln'];

            // Bind parameters
            $stmt->bind_param("iiiiiisssi", $mastery, $performance, $impression, $audience, $total_score, $fullname, $candidate['cand_course'], $candidate['cand_team'], $cand_no, $jdg_id);

            // Execute and check for errors
            if (!$stmt->execute()) {
                echo "Error executing statement for candidate_no $cand_no: " . $stmt->error . "<br>";
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
