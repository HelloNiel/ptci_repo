<?php
include '../../partial/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $candidateNumbers = $_POST['cand_no'];
    $candidateFirstNames = $_POST['cand_fn'];
    $candidateTeams = $_POST['cand_team'];

    $stmt = $conn->prepare("INSERT INTO top3_candidate_male (cand_no, cand_fn, cand_team) VALUES (?, ?, ?)");

    foreach ($candidateNumbers as $index => $candNo) {
        $candFn = $candidateFirstNames[$index];
        $candTeam = $candidateTeams[$index];
        
        $stmt->bind_param("sss", $candNo, $candFn, $candTeam);
        $stmt->execute();
    }

    $stmt->close();
    header("Location: ../top3_list.php");
    exit;
} else {
    echo "Required data not received.";
}
?>
