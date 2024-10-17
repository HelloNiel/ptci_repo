<?php 
session_start();
include 'includes/header.php'; 

// Check if the judge is logged in
if (!isset($_SESSION['jdg_id'])) {
    die("You must be logged in as a judge to view this page.");
}

$jdg_id = $_SESSION['jdg_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <?php include 'includes/topnavbar.php'; ?>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <?php include 'includes/sidenavbar.php'; ?>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Judge <?php echo $jdg_id; ?></h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Male Candidates Scores
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Course</th>
                                        <th>Team</th>
                                        <th>Candidate No</th>
                                        <th>Mastery</th>
                                        <th>Performance</th>
                                        <th>Impression</th>
                                        <th>Audience</th>
                                        <th>Total Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../partial/connection.php';

                                    $stmt = $conn->prepare("
                                        SELECT 
                                            CONCAT(c.cand_fn, ' ', c.cand_ln) AS fullname, 
                                            c.cand_course AS course, 
                                            c.cand_team AS team, 
                                            t.candidate_no, 
                                            MAX(t.tal_mastery) AS tal_mastery, 
                                            MAX(t.tal_performance) AS tal_performance, 
                                            MAX(t.tal_impression) AS tal_impression, 
                                            MAX(t.tal_audience) AS tal_audience, 
                                            MAX(t.tal_total_score) AS tal_total_score
                                        FROM male_talent t
                                        JOIN candidates c ON t.cand_id = c.cand_id
                                        WHERE t.jdg_id = ? AND c.cand_gender = 'Male'
                                        GROUP BY t.candidate_no
                                        ORDER BY t.candidate_no
                                    ");
                                    $stmt->bind_param("i", $jdg_id);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row['fullname']}</td>
                                                    <td>{$row['course']}</td>
                                                    <td>{$row['team']}</td>
                                                    <td>{$row['candidate_no']}</td>
                                                    <td>{$row['tal_mastery']}</td>
                                                    <td>{$row['tal_performance']}</td>
                                                    <td>{$row['tal_impression']}</td>
                                                    <td>{$row['tal_audience']}</td>
                                                    <td>{$row['tal_total_score']}</td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>No male candidates found for this judge</td></tr>";
                                    }
                                    $stmt->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Female Candidates Scores
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Course</th>
                                        <th>Team</th>
                                        <th>Candidate No</th>
                                        <th>Mastery</th>
                                        <th>Performance</th>
                                        <th>Impression</th>
                                        <th>Audience</th>
                                        <th>Total Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $conn->prepare("
                                        SELECT 
                                            CONCAT(c.cand_fn, ' ', c.cand_ln) AS fullname, 
                                            c.cand_course AS course, 
                                            c.cand_team AS team, 
                                            t.candidate_no, 
                                            MAX(t.tal_mastery) AS tal_mastery, 
                                            MAX(t.tal_performance) AS tal_performance, 
                                            MAX(t.tal_impression) AS tal_impression, 
                                            MAX(t.tal_audience) AS tal_audience, 
                                            MAX(t.tal_total_score) AS tal_total_score
                                        FROM female_talent t
                                        JOIN candidates c ON t.cand_id = c.cand_id
                                        WHERE t.jdg_id = ? AND c.cand_gender = 'Female'
                                        GROUP BY t.candidate_no
                                        ORDER BY t.candidate_no
                                    ");
                                    $stmt->bind_param("i", $jdg_id);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row['fullname']}</td>
                                                    <td>{$row['course']}</td>
                                                    <td>{$row['team']}</td>
                                                    <td>{$row['candidate_no']}</td>
                                                    <td>{$row['tal_mastery']}</td>
                                                    <td>{$row['tal_performance']}</td>
                                                    <td>{$row['tal_impression']}</td>
                                                    <td>{$row['tal_audience']}</td>
                                                    <td>{$row['tal_total_score']}</td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>No female candidates found for this judge</td></tr>";
                                    }

                                    $stmt->close();
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
    <?php include 'includes/script.php'; ?>
</body>
</html>
