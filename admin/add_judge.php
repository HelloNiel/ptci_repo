<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Judge</title>
    <?php include 'includes/header.php'; ?>
</head>
<body>
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
                <h1>Add Judge</h1>

                <?php
                session_start();
                if (isset($_SESSION['success_message'])): ?>
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

                <form method="POST" action="./function/process_judge.php">
                    <div class="mb-3">
                        <label for="jdg_name" class="form-label">Judge Name</label>
                        <input type="text" class="form-control" id="jdg_name" name="jdg_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="jdg_username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="jdg_username" name="jdg_username" required>
                    </div>
                    <div class="mb-3">
                        <label for="jdg_pass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="jdg_pass" name="jdg_pass" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Judge</button>
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
