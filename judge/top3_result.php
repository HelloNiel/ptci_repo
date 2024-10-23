<?php
session_start();
?>

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
                    if (isset($_SESSION['success_message'])) {
                        echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_message'] . '</div>';
                        unset($_SESSION['success_message']);
                    }
                    if (isset($_SESSION['error_message'])) {
                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
                        unset($_SESSION['error_message']);
                    }
                    ?>
                    <h1 class="mt-4">Finalists</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Candidates</li>
                    </ol>

                    <!-- Male Finalists Table -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3>Top 3 Male Finalists</h3>
                            <table class="table table-striped table-bordered" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Cand No</th>
                                        <th>Full Name</th>
                                        <th>Team</th>
                                        <th>Percentage Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../partial/connection.php';

                                    $sql = "SELECT `cand_no`, `cand_fn`, `cand_ln`, `cand_team`, `score` FROM `top3_candidate_male` ORDER BY `score` DESC LIMIT 3";
                                    $result = $conn->query($sql);
                                    $rank = 1;

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $fullName = $row['cand_fn'] . ' ' . $row['cand_ln'];
                                            $percentageScore = $row['score'];
                                            echo "<tr>
                                                <td>{$rank}</td>
                                                <td>{$row['cand_no']}</td>
                                                <td>{$fullName}</td>
                                                <td>{$row['cand_team']}</td>
                                                <td>{$percentageScore}%</td>
                                            </tr>";
                                            $rank++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No results found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Female Finalists Table -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3>Top 3 Female Finalists</h3>
                            <table class="table table-striped table-bordered" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Cand No</th>
                                        <th>Full Name</th>
                                        <th>Team</th>
                                        <th>Percentage Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT `cand_no`, `cand_fn`, `cand_ln`, `cand_team`, `score` FROM `top3_candidate_female` ORDER BY `score` DESC LIMIT 3";
                                    $result = $conn->query($sql);
                                    $rank = 1;

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $fullName = $row['cand_fn'] . ' ' . $row['cand_ln'];
                                            $percentageScore = $row['score'];
                                            echo "<tr>
                                                <td>{$rank}</td>
                                                <td>{$row['cand_no']}</td>
                                                <td>{$fullName}</td>
                                                <td>{$row['cand_team']}</td>
                                                <td>{$percentageScore}%</td>
                                            </tr>";
                                            $rank++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No results found</td></tr>";
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
