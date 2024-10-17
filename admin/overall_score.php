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
                    <h1 class="mt-4">Scores from Each Judge - Male Candidates</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Male Candidates Scores from Each Judge
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
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
                                    
                                    $sql_male = "
                                        SELECT 
                                            CONCAT(c.cand_fn, ' ', c.cand_ln) AS fullname, 
                                            c.cand_team AS team, 
                                            c.cand_no AS candidate_no,
                                            COALESCE(SUM(CASE WHEN t.jdg_id = 34 THEN t.tal_total_score END), 0) AS score_judge1,
                                            COALESCE(SUM(CASE WHEN t.jdg_id = 35 THEN t.tal_total_score END), 0) AS score_judge2,
                                            COALESCE(SUM(CASE WHEN t.jdg_id = 36 THEN t.tal_total_score END), 0) AS score_judge3
                                        FROM candidates c
                                        LEFT JOIN male_talent t ON c.cand_no = t.candidate_no
                                        WHERE c.cand_gender = 'Male'  
                                        GROUP BY c.cand_no, c.cand_fn, c.cand_ln, c.cand_team
                                    ";

                                    $result_male = $conn->query($sql_male);

                                    if ($result_male && $result_male->num_rows > 0) {
                                        while ($row = $result_male->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row['fullname']}</td>
                                                    <td>{$row['team']}</td>
                                                    <td>{$row['candidate_no']}</td>
                                                    <td>" . number_format($row['score_judge1'], 2) . "</td>
                                                    <td>" . number_format($row['score_judge2'], 2) . "</td>
                                                    <td>" . number_format($row['score_judge3'], 2) . "</td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No data available</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <h1 class="mt-4">Scores from Each Judge - Female Candidates</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Female Candidates Scores from Each Judge
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Team</th>
                                        <th>Candidate No</th>
                                        <th>Score (Judge 1)</th>
                                        <th>Score (Judge 2)</th>
                                        <th>Score (Judge 3)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql_female = "
                                        SELECT 
                                            CONCAT(c.cand_fn, ' ', c.cand_ln) AS fullname, 
                                            c.cand_team AS team, 
                                            c.cand_no AS candidate_no,
                                            COALESCE(SUM(CASE WHEN t.jdg_id = 34 THEN t.tal_total_score END), 0) AS score_judge1,
                                            COALESCE(SUM(CASE WHEN t.jdg_id = 35 THEN t.tal_total_score END), 0) AS score_judge2,
                                            COALESCE(SUM(CASE WHEN t.jdg_id = 36 THEN t.tal_total_score END), 0) AS score_judge3
                                        FROM candidates c
                                        LEFT JOIN female_talent t ON c.cand_no = t.candidate_no
                                        WHERE c.cand_gender = 'Female'  
                                        GROUP BY c.cand_no, c.cand_fn, c.cand_ln, c.cand_team
                                    ";

                                    $result_female = $conn->query($sql_female);

                                    if ($result_female && $result_female->num_rows > 0) {
                                        while ($row = $result_female->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row['fullname']}</td>
                                                    <td>{$row['team']}</td>
                                                    <td>{$row['candidate_no']}</td>
                                                    <td>" . number_format($row['score_judge1'], 2) . "</td>
                                                    <td>" . number_format($row['score_judge2'], 2) . "</td>
                                                    <td>" . number_format($row['score_judge3'], 2) . "</td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No data available</td></tr>";
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
