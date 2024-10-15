<!DOCTYPE html>
<html lang="en">
    <head>
        <?php  include 'includes/header.php'; ?>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <?php  include 'includes/topnavbar.php'; ?>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <?php  include 'includes/sidenavbar.php'; ?>
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
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Candidate No.</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Team</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Catriona</td>
                                            <td>BSIT</td>
                                            <td>Red Phoenix</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                <?php  include 'includes/footer.php'; ?>
                </footer>
            </div>
        </div>
        <?php  include 'includes/script.php'; ?>
    </body>
</html>
