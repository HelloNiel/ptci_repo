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
                    <h1 class="mt-4">Candidates</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Candidates
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Candidate No.</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                        <th>Team</th>
                                        <th>Gender</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Candidate No.</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                        <th>Team</th>
                                        <th>Gender</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include '../partial/connection.php';

                                    $sql = "SELECT cand_no, CONCAT(cand_fn, ' ', cand_ln) AS name, cand_course, cand_team, cand_gender FROM candidates";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>" . $row['cand_no'] . "</td>
                                                    <td>" . $row['name'] . "</td>
                                                    <td>" . $row['cand_course'] . "</td>
                                                    <td>" . $row['cand_team'] . "</td>
                                                    <td>" . $row['cand_gender'] . "</td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No candidates found</td></tr>";
                                    }
                                    
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <?php include 'includes/footer.php'; ?>
            </footer>
        </div>
    </div>
    <?php include 'includes/script.php'; ?>
</body>
</html>
