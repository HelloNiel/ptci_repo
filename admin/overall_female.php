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
                    <h1 class="mt-4">Overall Scores - Female Candidates</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Overall Scores
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Candidate No</th>
                                        <th>Full Name</th>
                                        <th>Overall Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../partial/connection.php';

                                    $sql = "
                                        SELECT candidate_no, fullname, overall_score, 
                                               RANK() OVER (ORDER BY overall_score DESC) AS rank
                                        FROM (
                                            SELECT c.cand_no AS candidate_no, 
                                                   CONCAT(c.cand_fn, ' ', c.cand_ln) AS fullname,
                                                   AVG(tal_total_score) AS overall_score 
                                            FROM (
                                                SELECT candidate_no, tal_total_score FROM tal_judge1_female
                                                UNION ALL
                                                SELECT candidate_no, tal_total_score FROM tal_judge2_female
                                                UNION ALL
                                                SELECT candidate_no, tal_total_score FROM tal_judge3_female
                                            ) AS all_scores
                                            JOIN candidates c ON c.cand_no = all_scores.candidate_no
                                            WHERE c.cand_gender = 'Female'  -- Filter for female candidates
                                            GROUP BY c.cand_no
                                        ) AS ranked_scores
                                    ";

                                    $result = $conn->query($sql);

                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row['rank']}</td>
                                                    <td>{$row['candidate_no']}</td>
                                                    <td>{$row['fullname']}</td>
                                                    <td>" . number_format($row['overall_score'], 2) . "</td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No data available</td></tr>";
                                    }

                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Scores from Each Judge
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Course</th>
                                        <th>Team</th>
                                        <th>Candidate No</th>
                                        <th>Score (Judge 1)</th>
                                        <th>Score (Judge 2)</th>
                                        <th>Score (Judge 3)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../partial/connection.php';

                                    $sql = "
                                        SELECT c.cand_fn AS fullname, c.cand_ln AS lastname, c.cand_course AS course, c.cand_team AS team, c.cand_no AS candidate_no,
                                               j1.tal_total_score AS score_judge1,
                                               j2.tal_total_score AS score_judge2,
                                               j3.tal_total_score AS score_judge3
                                        FROM candidates c
                                        LEFT JOIN tal_judge1_female j1 ON c.cand_no = j1.candidate_no
                                        LEFT JOIN tal_judge2_female j2 ON c.cand_no = j2.candidate_no
                                        LEFT JOIN tal_judge3_female j3 ON c.cand_no = j3.candidate_no
                                        WHERE c.cand_gender = 'Female'  -- Filter for female candidates
                                    ";

                                    $result = $conn->query($sql);

                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row['fullname']} {$row['lastname']}</td>
                                                    <td>{$row['course']}</td>
                                                    <td>{$row['team']}</td>
                                                    <td>{$row['candidate_no']}</td>
                                                    <td>" . number_format($row['score_judge1'], 2) . "</td>
                                                    <td>" . number_format($row['score_judge2'], 2) . "</td>
                                                    <td>" . number_format($row['score_judge3'], 2) . "</td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No data available</td></tr>";
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
