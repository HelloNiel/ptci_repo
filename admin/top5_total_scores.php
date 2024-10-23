<!DOCTYPE html>
<html lang="en">
<head>
    <?php include'includes/header.php'; 
    ?>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <?php include'includes/topnavbar.php'; ?>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <?php include'includes/sidenavbar.php' ?>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Top 5 Candidates</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Male Candidates Scores
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Candidate No</th>
                                        <th>Full Name</th>
                                        <th>Team</th>
                                        <th>Judge 1 Score</th>
                                        <th>Judge 2 Score</th>
                                        <th>Judge 3 Score</th>
                                        <th>Judge 4 Score</th>
                                        <th>Judge 5 Score</th>
                                        <th>Total Score (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../partial/connection.php';

                                    $judge_ids = [];
                                    $judge_query = "SELECT jdg_id FROM judge ORDER BY jdg_id"; 
                                    $judge_result = $conn->query($judge_query);

                                    if ($judge_result && $judge_result->num_rows > 0) {
                                        while ($row = $judge_result->fetch_assoc()) {
                                            $judge_ids[] = $row['jdg_id'];
                                        }
                                    } else {
                                        die("No judges found.");
                                    }

                                    if (count($judge_ids) < 5) {
                                        die("Not enough judges available.");
                                    }

                                    list($judge_id_1, $judge_id_2, $judge_id_3, $judge_id_4, $judge_id_5) = $judge_ids;

                                    $query = "
                                        SELECT 
                                            c.cand_no, 
                                            CONCAT(c.cand_fn, ' ', c.cand_ln) AS full_name, 
                                            c.cand_team,
                                            MAX(CASE WHEN us.judge_id = $judge_id_1 THEN us.score END) AS judge_1_score,
                                            MAX(CASE WHEN us.judge_id = $judge_id_2 THEN us.score END) AS judge_2_score,
                                            MAX(CASE WHEN us.judge_id = $judge_id_3 THEN us.score END) AS judge_3_score,
                                            MAX(CASE WHEN us.judge_id = $judge_id_4 THEN us.score END) AS judge_4_score,
                                            MAX(CASE WHEN us.judge_id = $judge_id_5 THEN us.score END) AS judge_5_score,
                                            (IFNULL(MAX(CASE WHEN us.judge_id = $judge_id_1 THEN us.score END), 0) +
                                            IFNULL(MAX(CASE WHEN us.judge_id = $judge_id_2 THEN us.score END), 0) +
                                            IFNULL(MAX(CASE WHEN us.judge_id = $judge_id_3 THEN us.score END), 0) +
                                            IFNULL(MAX(CASE WHEN us.judge_id = $judge_id_4 THEN us.score END), 0) +
                                            IFNULL(MAX(CASE WHEN us.judge_id = $judge_id_5 THEN us.score END), 0)) / 5 AS total_score,
                                            ROW_NUMBER() OVER (ORDER BY total_score DESC) AS rank
                                        FROM top5_candidate_male c
                                        LEFT JOIN top5_scores_male us ON c.cand_no = us.cand_no
                                        GROUP BY c.cand_no
                                        ORDER BY total_score DESC
                                    ";

                                    $result = $conn->query($query);
                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $scores = [
                                                $row['judge_1_score'] !== null ? $row['judge_1_score'] : 0,
                                                $row['judge_2_score'] !== null ? $row['judge_2_score'] : 0,
                                                $row['judge_3_score'] !== null ? $row['judge_3_score'] : 0,
                                                $row['judge_4_score'] !== null ? $row['judge_4_score'] : 0,
                                                $row['judge_5_score'] !== null ? $row['judge_5_score'] : 0,
                                            ];
                                            $totalScore = array_sum($scores) / (count($scores) * 10) * 100;

                                            echo "<tr>
                                                    <td>{$row['rank']}</td>
                                                    <td>{$row['cand_no']}</td>
                                                    <td>{$row['full_name']}</td>
                                                    <td>{$row['cand_team']}</td>
                                                    <td>" . ($row['judge_1_score'] !== null ? $row['judge_1_score'] : 'N/A') . "</td>
                                                    <td>" . ($row['judge_2_score'] !== null ? $row['judge_2_score'] : 'N/A') . "</td>
                                                    <td>" . ($row['judge_3_score'] !== null ? $row['judge_3_score'] : 'N/A') . "</td>
                                                    <td>" . ($row['judge_4_score'] !== null ? $row['judge_4_score'] : 'N/A') . "</td>
                                                    <td>" . ($row['judge_5_score'] !== null ? $row['judge_5_score'] : 'N/A') . "</td>
                                                    <td>" . number_format($totalScore, 2) . "%</td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='10'>No scores available.</td></tr>";
                                    }
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
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Candidate No</th>
                                        <th>Full Name</th>
                                        <th>Team</th>
                                        <th>Judge 1 Score</th>
                                        <th>Judge 2 Score</th>
                                        <th>Judge 3 Score</th>
                                        <th>Judge 4 Score</th>
                                        <th>Judge 5 Score</th>
                                        <th>Total Score (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_female = "
                                        SELECT 
                                            c.cand_no, 
                                            CONCAT(c.cand_fn, ' ', c.cand_ln) AS full_name, 
                                            c.cand_team,
                                            MAX(CASE WHEN us.judge_id = $judge_id_1 THEN us.score END) AS judge_1_score,
                                            MAX(CASE WHEN us.judge_id = $judge_id_2 THEN us.score END) AS judge_2_score,
                                            MAX(CASE WHEN us.judge_id = $judge_id_3 THEN us.score END) AS judge_3_score,
                                            MAX(CASE WHEN us.judge_id = $judge_id_4 THEN us.score END) AS judge_4_score,
                                            MAX(CASE WHEN us.judge_id = $judge_id_5 THEN us.score END) AS judge_5_score,
                                            (IFNULL(MAX(CASE WHEN us.judge_id = $judge_id_1 THEN us.score END), 0) +
                                            IFNULL(MAX(CASE WHEN us.judge_id = $judge_id_2 THEN us.score END), 0) +
                                            IFNULL(MAX(CASE WHEN us.judge_id = $judge_id_3 THEN us.score END), 0) +
                                            IFNULL(MAX(CASE WHEN us.judge_id = $judge_id_4 THEN us.score END), 0) +
                                            IFNULL(MAX(CASE WHEN us.judge_id = $judge_id_5 THEN us.score END), 0)) / 5 AS total_score,
                                            ROW_NUMBER() OVER (ORDER BY total_score DESC) AS rank
                                        FROM top5_candidate_female c
                                        LEFT JOIN top5_scores_female us ON c.cand_no = us.cand_no
                                        GROUP BY c.cand_no
                                        ORDER BY total_score DESC
                                    ";
                                
                                    $result_female = $conn->query($query_female);
                                    if ($result_female && $result_female->num_rows > 0) {
                                        while ($row_female = $result_female->fetch_assoc()) {
                                            $scores_female = [
                                                $row_female['judge_1_score'] !== null ? $row_female['judge_1_score'] : 0,
                                                $row_female['judge_2_score'] !== null ? $row_female['judge_2_score'] : 0,
                                                $row_female['judge_3_score'] !== null ? $row_female['judge_3_score'] : 0,
                                                $row_female['judge_4_score'] !== null ? $row_female['judge_4_score'] : 0,
                                                $row_female['judge_5_score'] !== null ? $row_female['judge_5_score'] : 0,
                                            ];
                                            $totalScore_female = array_sum($scores_female) / (count($scores_female) * 10) * 100;

                                            echo "<tr>
                                                    <td>{$row_female['rank']}</td>
                                                    <td>{$row_female['cand_no']}</td>
                                                    <td>{$row_female['full_name']}</td>
                                                    <td>{$row_female['cand_team']}</td>
                                                    <td>" . ($row_female['judge_1_score'] !== null ? $row_female['judge_1_score'] : 'N/A') . "</td>
                                                    <td>" . ($row_female['judge_2_score'] !== null ? $row_female['judge_2_score'] : 'N/A') . "</td>
                                                    <td>" . ($row_female['judge_3_score'] !== null ? $row_female['judge_3_score'] : 'N/A') . "</td>
                                                    <td>" . ($row_female['judge_4_score'] !== null ? $row_female['judge_4_score'] : 'N/A') . "</td>
                                                    <td>" . ($row_female['judge_5_score'] !== null ? $row_female['judge_5_score'] : 'N/A') . "</td>
                                                    <td>" . number_format($totalScore_female, 2) . "%</td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='10'>No scores available.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'includes/footer.php'; ?>
        </div>
    </div>
    <script src="../js/scripts.js"></script>
</body>
</html>
