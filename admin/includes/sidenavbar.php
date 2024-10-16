<div class="sb-sidenav-menu">
    <div class="nav">
        <div class="sb-sidenav-menu-heading"></div>
        <a class="nav-link" href="<?php echo "dashboard.php"; ?>">
            <div class="sb-nav-link-icon"><i class="fas fa-gauge-high"></i></div>
            <span class="nav-link-text">Dashboard</span>
        </a>
        <div class="sb-sidenav-menu-heading">Scoreboard</div>
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseScoreboard" aria-expanded="false" aria-controls="collapseScoreboard">
            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
            Talent Scoreboard
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            
        </a>
        
        <div class="collapse" id="collapseScoreboard" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="<?php echo "judge1.php"; ?>">Talent Judge 1</a>
                <a class="nav-link" href="<?php echo "judge2.php"; ?>">Talent Judge 2</a>
                <a class="nav-link" href="<?php echo "judge3.php"; ?>">Talent Judge 3</a>
                <a class="nav-link" href="<?php echo "overall.php"; ?>">overall Score male</a>
                <a class="nav-link" href="<?php echo "overall_female.php"; ?>">overall Score female</a>
            </nav>
        </div>
        <div class="sb-sidenav-menu-heading">Settings</div>
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStudents" aria-expanded="false" aria-controls="collapseStudents">
            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
            Manage Candidates
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseStudents" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="<?php echo "add_candidate.php"; ?>">Add Candidates</a>
                <a class="nav-link" href="<?php echo "viewall.php"; ?>">View Candidates</a>
            </nav>
        </div>
        <a class="nav-link" href="<?php echo "add_judge.php"; ?>"> 
            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
            Add Judge
        </a>
    </div>
</div>
<div class="sb-sidenav-footer">
    <div class="small">Logged in as:</div>
    Administrator
</div>
