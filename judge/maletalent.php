<?php
session_start();
include 'includes/header.php'; 
include '../partial/connection.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Male Candidates</title>
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
                    <h1 class="mt-4">Male Candidates</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Male Candidates/Talent</li>
                    </ol>

                    <?php
                    if (isset($_SESSION['success_message'])) {
                        echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_message'] . '</div>';
                        unset($_SESSION['success_message']);
                    }
                    ?>

                    <div class="table-responsive">
                        <form method="POST" action="./talent function//tal_score.php">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Candidate No</th>
                                        <th>Full Name</th>
                                        <th>Course</th>
                                        <th>Team</th>
                                        <th>Mastery (30%)</th>
                                        <th>Performance (40%)</th>
                                        <th>Impression (20%)</th>
                                        <th>Audience (10%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT cand_no, cand_ln, cand_fn, cand_course, cand_team FROM candidates WHERE cand_gender = 'Male'";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>{$row['cand_no']}</td>";
                                            echo "<td>{$row['cand_fn']} {$row['cand_ln']}</td>";
                                            echo "<td>{$row['cand_course']}</td>";
                                            echo "<td>{$row['cand_team']}</td>";
                                            echo "<td><input type='number' name='mastery_{$row['cand_no']}' placeholder='Score' class='form-control' min='0' max='30' required></td>";
                                            echo "<td><input type='number' name='performance_{$row['cand_no']}' placeholder='Score' class='form-control' min='0' max='40' required></td>";
                                            echo "<td><input type='number' name='impression_{$row['cand_no']}' placeholder='Score' class='form-control' min='0' max='20' required></td>";
                                            echo "<td><input type='number' name='audience_{$row['cand_no']}' placeholder='Score' class='form-control' min='0' max='10' required></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8' class='text-center'>No male candidates found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary">Submit Scores</button>
                        </form>
                    </div>
                </div>
            </main>
            <?php include 'includes/script.php'; ?>
        </div>
    </div>
</body>
</html>
