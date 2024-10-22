<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/header.php'; ?>
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
                    <h1 class="mt-4">Q&A Scores</h1>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Top 5 Male Candidates Scores
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Candidate No</th>
                                        <th>Full Name</th>
                                        <th>Team</th>
                                        <th>Judge 1 Score</th>
                                        <th>Judge 2 Score</th>
                                        <th>Judge 3 Score</th>
                                        <th>Judge 4 Score</th>
                                        <th>Judge 5 Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../partial/connection.php';

                                    $query_top5_male = "
                                        SELECT cand_no, 
                                               cand_fn, 
                                               cand_ln, 
                                               cand_team,
                                               MAX(CASE WHEN judge_id = 1 THEN score END) AS judge_1_score,
                                               MAX(CASE WHEN judge_id = 2 THEN score END) AS judge_2_score,
                                               MAX(CASE WHEN judge_id = 3 THEN score END) AS judge_3_score,
                                               MAX(CASE WHEN judge_id = 4 THEN score END) AS judge_4_score,
                                               MAX(CASE WHEN judge_id = 5 THEN score END) AS judge_5_score
                                        FROM top5_scores_male
                                        GROUP BY cand_no
                                        ORDER BY MAX(score) DESC
                                        LIMIT 5
                                    ";

                                    $result_top5_male = $conn->query($query_top5_male);
                                    if ($result_top5_male && $result_top5_male->num_rows > 0) {
                                        while ($row_top5 = $result_top5_male->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row_top5['cand_no']}</td>
                                                    <td>{$row_top5['cand_fn']} {$row_top5['cand_ln']}</td>
                                                    <td>{$row_top5['cand_team']}</td>
                                                    <td>" . ($row_top5['judge_1_score'] !== null ? $row_top5['judge_1_score'] : 'N/A') . "</td>
                                                    <td>" . ($row_top5['judge_2_score'] !== null ? $row_top5['judge_2_score'] : 'N/A') . "</td>
                                                    <td>" . ($row_top5['judge_3_score'] !== null ? $row_top5['judge_3_score'] : 'N/A') . "</td>
                                                    <td>" . ($row_top5['judge_4_score'] !== null ? $row_top5['judge_4_score'] : 'N/A') . "</td>
                                                    <td>" . ($row_top5['judge_5_score'] !== null ? $row_top5['judge_5_score'] : 'N/A') . "</td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>No scores available.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Top 5 Female Candidates Scores
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Candidate No</th>
                                        <th>Full Name</th>
                                        <th>Team</th>
                                        <th>Judge 1 Score</th>
                                        <th>Judge 2 Score</th>
                                        <th>Judge 3 Score</th>
                                        <th>Judge 4 Score</th>
                                        <th>Judge 5 Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_top5_female = "
                                        SELECT cand_no, 
                                               cand_fn, 
                                               cand_ln, 
                                               cand_team,
                                               MAX(CASE WHEN judge_id = 1 THEN score END) AS judge_1_score,
                                               MAX(CASE WHEN judge_id = 2 THEN score END) AS judge_2_score,
                                               MAX(CASE WHEN judge_id = 3 THEN score END) AS judge_3_score,
                                               MAX(CASE WHEN judge_id = 4 THEN score END) AS judge_4_score,
                                               MAX(CASE WHEN judge_id = 5 THEN score END) AS judge_5_score
                                        FROM top5_scores_female
                                        GROUP BY cand_no
                                        ORDER BY MAX(score) DESC
                                        LIMIT 5
                                    ";

                                    $result_top5_female = $conn->query($query_top5_female);
                                    if ($result_top5_female && $result_top5_female->num_rows > 0) {
                                        while ($row_top5_female = $result_top5_female->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row_top5_female['cand_no']}</td>
                                                    <td>{$row_top5_female['cand_fn']} {$row_top5_female['cand_ln']}</td>
                                                    <td>{$row_top5_female['cand_team']}</td>
                                                    <td>" . ($row_top5_female['judge_1_score'] !== null ? $row_top5_female['judge_1_score'] : 'N/A') . "</td>
                                                    <td>" . ($row_top5_female['judge_2_score'] !== null ? $row_top5_female['judge_2_score'] : 'N/A') . "</td>
                                                    <td>" . ($row_top5_female['judge_3_score'] !== null ? $row_top5_female['judge_3_score'] : 'N/A') . "</td>
                                                    <td>" . ($row_top5_female['judge_4_score'] !== null ? $row_top5_female['judge_4_score'] : 'N/A') . "</td>
                                                    <td>" . ($row_top5_female['judge_5_score'] !== null ? $row_top5_female['judge_5_score'] : 'N/A') . "</td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>No scores available.</td></tr>";
                                    }
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
