<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Candidate</title>
    <?php 
    session_start();
    include 'includes/header.php'; 
    include '../session_check.php'; 
    checkLogin();
    ?>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        #layoutSidenav_content {
            padding-bottom: 0;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="layoutSidenav" class="flex-grow-1">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <?php include 'includes/sidenavbar.php'; ?>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                <?php include 'includes/topnavbar.php'; ?>
            </nav>
            <div class="container mt-4">
                <h1>Add Candidate</h1>

                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success" role="alert">
                        <?php
                        echo $_SESSION['success_message'];
                        unset($_SESSION['success_message']);
                        ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo $_SESSION['error_message'];
                        unset($_SESSION['error_message']);
                        ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="./function/process_candidate.php">
                    <div class="mb-3">
                        <label for="cand_no" class="form-label">Candidate Number</label>
                        <input type="text" class="form-control" id="cand_no" name="cand_no" required>
                    </div>
                    <div class="mb-3">
                        <label for="cand_fn" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="cand_fn" name="cand_fn" required>
                    </div>
                    <div class="mb-3">
                        <label for="cand_ln" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="cand_ln" name="cand_ln" required>
                    </div>
                    <div class="mb-3">
                        <label for="cand_team" class="form-label">Team</label>
                        <select class="form-select" id="cand_team" name="cand_team" required>
                            <option value="" disabled selected>Select a team</option>
                            <option value="Team 1 - Orange Wolves">Team 1 - Orange Wolves</option>
                            <option value="Team 2 - Yellow Tigers">Team 2 - Yellow Tigers</option>
                            <option value="Team 3 - Green Tamaraws">Team 3 - Green Tamaraws</option>
                            <option value="Team 4 - Blue Eagles">Team 4 - Blue Eagles</option>
                            <option value="Team 5 - Red Phoenix">Team 5 - Red Phoenix</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cand_gender" class="form-label">Gender</label>
                        <select class="form-select" id="cand_gender" name="cand_gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cand_course" class="form-label">Course</label>
                        <select class="form-select" id="cand_course" name="cand_course" required>
                            <option value="" disabled selected>Select a course</option>
                            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>
                            <option value="Bachelor of Science in Hotel Management">Bachelor of Science in Hotel Management</option>
                            <option value="Bachelor of Science in Information Systems">Bachelor of Science in Information Systems</option>
                            <option value="Associate in Computer Technology">Associate in Computer Technology</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Candidate</button>
                </form>
            </div>

            <footer class="py-2 bg-light mt-auto">
                <?php include 'includes/footer.php'; ?>
            </footer>
        </div>
    </div>

    <?php include 'includes/script.php'; ?>
</body>
</html>
