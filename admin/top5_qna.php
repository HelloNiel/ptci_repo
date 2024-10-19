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
                    <h1 class="mt-4">Top 5 Candidates</h1>

                    <?php
                    include '../partial/connection.php';

                    $query_male = "SELECT c.cand_no, CONCAT(c.cand_fn, ' ', c.cand_ln) AS full_name, c.cand_team, 
                                          (cat.cat_talent + cat.cat_production + cat.cat_schoolunif + cat.cat_swimwear + cat.cat_gownBarong + cat.cat_qa) AS total_score
                                   FROM categories cat
                                   JOIN candidates c ON cat.cand_id = c.cand_id
                                   WHERE c.cand_gender = 'male'
                                   ORDER BY total_score DESC
                                   LIMIT 5";

                    $result_male = $conn->query($query_male);
                    ?>

                    <h2>Top 5 Male Candidates</h2>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Candidate No</th>
                                <th>Full Name</th>
                                <th>Team</th>
                                <th>Total Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result_male->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row['cand_no']; ?></td>
                                    <td><?php echo $row['full_name']; ?></td>
                                    <td><?php echo $row['cand_team']; ?></td>
                                    <td><?php echo $row['total_score']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <?php
                    $query_female = "SELECT c.cand_no, CONCAT(c.cand_fn, ' ', c.cand_ln) AS full_name, c.cand_team, 
                                            (cat.cat_talent + cat.cat_production + cat.cat_schoolunif + cat.cat_swimwear + cat.cat_gownBarong + cat.cat_qa) AS total_score
                                     FROM categories cat
                                     JOIN candidates c ON cat.cand_id = c.cand_id
                                     WHERE c.cand_gender = 'female'
                                     ORDER BY total_score DESC
                                     LIMIT 5";

                    $result_female = $conn->query($query_female);
                    ?>

                    <h2>Top 5 Female Candidates</h2>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Candidate No</th>
                                <th>Full Name</th>
                                <th>Team</th>
                                <th>Total Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result_female->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row['cand_no']; ?></td>
                                    <td><?php echo $row['full_name']; ?></td>
                                    <td><?php echo $row['cand_team']; ?></td>
                                    <td><?php echo $row['total_score']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <?php include 'includes/script.php'; ?>
</body>
</html>
