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
                    <h1 class="mt-4">Judge 1</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Candidates Scores
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

                                    $jdg_id = 34; // Judge ID
                                    $stmt = $conn->prepare("
                                        SELECT CONCAT(c.cand_fn, ' ', c.cand_ln) AS fullname, 
                                               t.tal_mastery, 
                                               t.tal_performance, 
                                               t.tal_impression, 
                                               t.tal_audience, 
                                               t.tal_total_score, 
                                               t.candidate_no, 
                                               c.cand_course AS course, 
                                               c.cand_team AS team
                                        FROM talent t
                                        JOIN candidates c ON t.candidate_no = c.cand_no
                                        WHERE t.jdg_id = ?
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
                                        echo "<tr><td colspan='9'>No candidates found for this judge</td></tr>";
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
