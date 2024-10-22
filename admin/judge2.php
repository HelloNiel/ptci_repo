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
                    <?php
                    include '../partial/connection.php';

                    $jdg_id = 47;
                    $judge_stmt = $conn->prepare("SELECT jdg_name FROM judge WHERE jdg_id = ?");
                    $judge_stmt->bind_param("i", $jdg_id);
                    $judge_stmt->execute();
                    $judge_stmt->bind_result($jdg_name);
                    $judge_stmt->fetch();
                    $judge_stmt->close();
                    ?>
                    <h1 class="mt-4">Judge <?php echo htmlspecialchars($jdg_name); ?></h1>

                    <?php
                    function displayCandidatesScores($gender, $jdg_id) {
                        global $conn;
                        $table_name = $gender === 'Female' ? 'female_talent' : 'male_talent';
                        $stmt = $conn->prepare("
                            SELECT CONCAT(c.cand_fn, ' ', c.cand_ln) AS fullname, 
                                   t.tal_mastery, 
                                   t.tal_performance, 
                                   t.tal_impression, 
                                   t.tal_audience, 
                                   t.tal_total_score, 
                                   c.cand_no AS candidate_no, 
                                   c.cand_course AS course, 
                                   c.cand_team AS team
                            FROM $table_name t
                            JOIN candidates c ON t.cand_id = c.cand_id
                            WHERE t.jdg_id = ? AND c.cand_gender = ?
                        ");
                        $stmt->bind_param("is", $jdg_id, $gender);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['candidate_no']}</td>
                                        <td>{$row['fullname']}</td>
                                        <td>{$row['course']}</td>
                                        <td>{$row['team']}</td>
                                        <td>{$row['tal_mastery']}</td>
                                        <td>{$row['tal_performance']}</td>
                                        <td>{$row['tal_impression']}</td>
                                        <td>{$row['tal_audience']}</td>
                                        <td>{$row['tal_total_score']}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>No {$gender} candidates found for this judge</td></tr>";
                        }

                        $stmt->close();
                    }

                    echo '<div class="card mb-4">';
                    echo '<div class="card-header"><i class="fas fa-table me-1"></i> Male Candidates Scores</div>';
                    echo '<div class="card-body">';
                    echo '<table class="table table-bordered"><thead><tr>
                            <th>Candidate No</th>
                            <th>Full Name</th>
                            <th>Course</th>
                            <th>Team</th>
                            <th>Mastery</th>
                            <th>Performance</th>
                            <th>Impression</th>
                            <th>Audience</th>
                            <th>Total Score</th>
                          </tr></thead><tbody>';
                    displayCandidatesScores('Male', $jdg_id);
                    echo '</tbody></table></div></div>';

                    echo '<div class="card mb-4">';
                    echo '<div class="card-header"><i class="fas fa-table me-1"></i> Female Candidates Scores</div>';
                    echo '<div class="card-body">';
                    echo '<table class="table table-bordered"><thead><tr>
                            <th>Candidate No</th>
                            <th>Full Name</th>
                            <th>Course</th>
                            <th>Team</th>
                            <th>Mastery</th>
                            <th>Performance</th>
                            <th>Impression</th>
                            <th>Audience</th>
                            <th>Total Score</th>
                          </tr></thead><tbody>';
                    displayCandidatesScores('Female', $jdg_id);
                    echo '</tbody></table></div></div>';

                    $conn->close();
                    ?>

                </div>
            </main>
        </div>
    </div>
    <?php include 'includes/script.php'; ?>
</body>
</html>
