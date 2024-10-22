<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    session_start();
    include 'includes/header.php'; 
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
                    <h1 class="mt-4">Total Score</h1>

                    <?php
                    include '../partial/connection.php';


                    if (isset($_SESSION['success_message'])) {
                        echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_message'] . '</div>';
                        unset($_SESSION['success_message']);
                    }

                    // Male
                    $query_male_scores = "
                        SELECT c.cand_no, 
                               c.cand_fn, 
                               c.cand_ln, 
                               c.cand_team,
                               m.unif_total, 
                               m.swim_total, 
                               m.barong_total, 
                               m.qna_total,
                               m.talent_total,
                               (m.talent_total * 0.10 + 
                               m.unif_total * 0.20 + 
                               m.swim_total * 0.20 + 
                               m.barong_total * 0.20 + 
                               m.qna_total * 0.30) AS total_score,
                               ((m.talent_total * 0.10 + 
                               m.unif_total * 0.20 + 
                               m.swim_total * 0.20 + 
                               m.barong_total * 0.20 + 
                               m.qna_total * 0.30) / 10) * 100 AS percentage_score
                        FROM male_candidate_total_scores m
                        JOIN candidates c ON m.cand_no = c.cand_no
                        WHERE c.cand_gender = 'Male'
                        ORDER BY percentage_score DESC
                        LIMIT 3";

                    $result_male_scores = $conn->query($query_male_scores);
                    if (!$result_male_scores) {
                        die("Query failed: " . $conn->error);
                    }
                    ?>

                    <h2>Top 5 Male Candidates Total Scores</h2>
                    <form action="./function/save_top3_male.php" method="POST">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Candidate No</th>
                                    <th>Full Name</th>
                                    <th>Team</th>
                                    <th>Talent Score</th>
                                    <th>Uniform Score</th>
                                    <th>Swimwear Score</th>
                                    <th>Barong Score</th>
                                    <th>Q&A Score</th>
                                    <th>Percentage Total Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result_male_scores->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['cand_no']; ?></td>
                                        <td><?php echo $row['cand_fn'] . ' ' . $row['cand_ln']; ?></td>
                                        <td><?php echo $row['cand_team']; ?></td>
                                        <td><?php echo number_format($row['talent_total'], 2); ?></td>
                                        <td><?php echo number_format($row['unif_total'], 2); ?></td>
                                        <td><?php echo number_format($row['swim_total'], 2); ?></td>
                                        <td><?php echo number_format($row['barong_total'], 2); ?></td>
                                        <td><?php echo number_format($row['qna_total'], 2); ?></td>
                                        <td><?php echo number_format($row['percentage_score'], 2); ?>%</td>
                                        <input type="hidden" name="cand_no[]" value="<?php echo $row['cand_no']; ?>">
                                        <input type="hidden" name="cand_fn[]" value="<?php echo $row['cand_fn']; ?>">
                                        <input type="hidden" name="cand_ln[]" value="<?php echo $row['cand_ln']; ?>">
                                        <input type="hidden" name="cand_team[]" value="<?php echo $row['cand_team']; ?>">
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Save Top 3 Male Candidates</button>
                    </form>

                    <?php
                    // Female
                    $query_female_scores = "
                        SELECT c.cand_no, 
                               c.cand_fn, 
                               c.cand_ln, 
                               c.cand_team,
                               f.unif_total, 
                               f.swim_total, 
                               f.gown_total, 
                               f.qna_total,
                               f.talent_total,
                               (f.talent_total * 0.10 + 
                               f.unif_total * 0.20 + 
                               f.swim_total * 0.20 + 
                               f.gown_total * 0.20 + 
                               f.qna_total * 0.30) AS total_score,
                               ((f.talent_total * 0.10 + 
                               f.unif_total * 0.20 + 
                               f.swim_total * 0.20 + 
                               f.gown_total * 0.20 + 
                               f.qna_total * 0.30) / 10) * 100 AS percentage_score
                        FROM female_candidate_total_scores f
                        JOIN candidates c ON f.cand_no = c.cand_no
                        WHERE c.cand_gender = 'Female'
                        ORDER BY percentage_score DESC
                        LIMIT 3";

                    $result_female_scores = $conn->query($query_female_scores);
                    if (!$result_female_scores) {
                        die("Query failed: " . $conn->error);
                    }
                    ?>
                    <h2>Top 3 Female Candidates Total Scores</h2>
                    <form action="./function/save_top3_female.php" method="POST">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Candidate No</th>
                                    <th>Full Name</th>
                                    <th>Team</th>
                                    <th>Talent Score</th>
                                    <th>Uniform Score</th>
                                    <th>Swimwear Score</th>
                                    <th>Gown Score</th>
                                    <th>Q&A Score</th>
                                    <th>Percentage Total Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result_female_scores->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['cand_no']; ?></td>
                                        <td><?php echo $row['cand_fn'] . ' ' . $row['cand_ln']; ?></td>
                                        <td><?php echo $row['cand_team']; ?></td>
                                        <td><?php echo number_format($row['talent_total'], 2); ?></td>
                                        <td><?php echo number_format($row['unif_total'], 2); ?></td>
                                        <td><?php echo number_format($row['swim_total'], 2); ?></td>
                                        <td><?php echo number_format($row['gown_total'], 2); ?></td>
                                        <td><?php echo number_format($row['qna_total'], 2); ?></td>
                                        <td><?php echo number_format($row['percentage_score'], 2); ?>%</td>
                                        <input type="hidden" name="cand_no[]" value="<?php echo $row['cand_no']; ?>">
                                        <input type="hidden" name="cand_fn[]" value="<?php echo $row['cand_fn']; ?>">
                                        <input type="hidden" name="cand_ln[]" value="<?php echo $row['cand_ln']; ?>">
                                        <input type="hidden" name="cand_team[]" value="<?php echo $row['cand_team']; ?>">
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Save Top 3 Female Candidates</button>
                    </form>

                </div>
            </main>
        </div>
    </div>
    <?php include 'includes/script.php'; ?>
</body>
</html>
