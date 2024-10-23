<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/header.php'; 
    ?>
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
                    <h1 class="mt-4">Barong Scores</h1>
                    
                    <!-- Male Candidates Scores -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Male Barong Candidates Scores
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
                                        SELECT c.cand_no, 
                                        CONCAT(c.cand_fn, ' ', c.cand_ln) AS full_name, 
                                        c.cand_team,
                                        MAX(CASE WHEN us.judge_id = $judge_id_1 THEN us.score END) AS judge_1_score,
                                        MAX(CASE WHEN us.judge_id = $judge_id_2 THEN us.score END) AS judge_2_score,
                                        MAX(CASE WHEN us.judge_id = $judge_id_3 THEN us.score END) AS judge_3_score,
                                        MAX(CASE WHEN us.judge_id = $judge_id_4 THEN us.score END) AS judge_4_score,
                                        MAX(CASE WHEN us.judge_id = $judge_id_5 THEN us.score END) AS judge_5_score
                                        FROM candidates c
                                        LEFT JOIN barong_score_male us ON c.cand_no = us.cand_no
                                        WHERE c.cand_gender = 'male'
                                        GROUP BY c.cand_no
                                    ";

                                    $result = $conn->query($query);
                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row['cand_no']}</td>
                                                    <td>{$row['full_name']}</td>
                                                    <td>{$row['cand_team']}</td>
                                                    <td>" . ($row['judge_1_score'] !== null ? $row['judge_1_score'] : 'N/A') . "</td>
                                                    <td>" . ($row['judge_2_score'] !== null ? $row['judge_2_score'] : 'N/A') . "</td>
                                                    <td>" . ($row['judge_3_score'] !== null ? $row['judge_3_score'] : 'N/A') . "</td>
                                                    <td>" . ($row['judge_4_score'] !== null ? $row['judge_4_score'] : 'N/A') . "</td>
                                                    <td>" . ($row['judge_5_score'] !== null ? $row['judge_5_score'] : 'N/A') . "</td>
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

                    <!-- Female Candidates Scores -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Female Gown Candidates Scores
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
                                    $query_female = "
                                        SELECT c.cand_no, 
                                        CONCAT(c.cand_fn, ' ', c.cand_ln) AS full_name, 
                                        c.cand_team,
                                        MAX(CASE WHEN us.judge_id = $judge_id_1 THEN us.score END) AS judge_1_score,
                                        MAX(CASE WHEN us.judge_id = $judge_id_2 THEN us.score END) AS judge_2_score,
                                        MAX(CASE WHEN us.judge_id = $judge_id_3 THEN us.score END) AS judge_3_score,
                                        MAX(CASE WHEN us.judge_id = $judge_id_4 THEN us.score END) AS judge_4_score,
                                        MAX(CASE WHEN us.judge_id = $judge_id_5 THEN us.score END) AS judge_5_score
                                        FROM candidates c
                                        LEFT JOIN gown_score_female us ON c.cand_no = us.cand_no
                                        WHERE c.cand_gender = 'female'
                                        GROUP BY c.cand_no
                                    ";

                                    $result_female = $conn->query($query_female);
                                    if ($result_female && $result_female->num_rows > 0) {
                                        while ($row_female = $result_female->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row_female['cand_no']}</td>
                                                    <td>{$row_female['full_name']}</td>
                                                    <td>{$row_female['cand_team']}</td>
                                                    <td>" . ($row_female['judge_1_score'] !== null ? $row_female['judge_1_score'] : 'N/A') . "</td>
                                                    <td>" . ($row_female['judge_2_score'] !== null ? $row_female['judge_2_score'] : 'N/A') . "</td>
                                                    <td>" . ($row_female['judge_3_score'] !== null ? $row_female['judge_3_score'] : 'N/A') . "</td>
                                                    <td>" . ($row_female['judge_4_score'] !== null ? $row_female['judge_4_score'] : 'N/A') . "</td>
                                                    <td>" . ($row_female['judge_5_score'] !== null ? $row_female['judge_5_score'] : 'N/A') . "</td>
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
