<div class="sb-sidenav-menu">
    <div class="nav">
        <div class="sb-sidenav-menu-heading"></div>
        <a class="nav-link" href="<?php echo "home.php" ?>">
            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
            <span class="nav-link-text">Home</span>
        </a>
        <div class="sb-sidenav-menu-heading">Candidates</div>
        <a class="nav-link" href="<?php echo "candidatesinfo.php" ?>">
            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
            <span class="nav-link-text">Candidates Info</span>
        </a>
        <div class="sb-sidenav-menu-heading">Judging Section</div>
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMale" aria-expanded="false" aria-controls="collapseMale">
            <div class="sb-nav-link-icon"><i class="fas fa-male"></i></div>
            Male Candidates
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseMale" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="<?php echo "maletalent.php" ?>">Talent</a>
                <a class="nav-link" href="<?php echo "maleuniform.php" ?>">Uniform</a>
                <a class="nav-link" href="<?php echo "maleswimwear.php" ?>">Swimwear</a>
                <a class="nav-link" href="<?php echo "male_barong.php" ?>">Barong</a>
                <a class="nav-link" href="<?php echo "maleqna.php" ?>">Question & Answer</a>
            </nav>
        </div>

        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseFemale" aria-expanded="false" aria-controls="collapseFemale">
            <div class="sb-nav-link-icon"><i class="fas fa-female"></i></div>
            Female Candidates
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseFemale" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="<?php echo "femaletalent.php" ?>">Talent</a>
                <a class="nav-link" href="<?php echo "femaleuniform.php" ?>">Uniform</a>
                <a class="nav-link" href="<?php echo "femaleswimwear.php" ?>">Swimwear</a>
                <a class="nav-link" href="<?php echo "female_gown.php" ?>">Gown</a>
                <a class="nav-link" href="<?php echo "femaleqna.php" ?>">Question & Answer</a>
            </nav>
        </div>

        <div class="sb-sidenav-menu-heading">Top 5 Candidates</div>
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTop5" aria-expanded="false" aria-controls="collapseTop5">
            <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
            Top 5 Candidates
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseTop5" aria-labelledby="headingTop5" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="<?php echo 'top5_male.php'; ?>">Top 5 Male</a>
                <a class="nav-link" href="<?php echo 'top5_female.php'; ?>">Top 5 Female</a>
            </nav>
        </div>

        <div class="sb-sidenav-menu-heading">Top 3 Candidates</div>
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTop5" aria-expanded="false" aria-controls="collapseTop5">
            <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
            Top 3 Candidates
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseTop5" aria-labelledby="headingTop5" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="<?php echo 'top3_male.php'; ?>">Top 3 Male</a>
                <a class="nav-link" href="<?php echo 'top3_female.php'; ?>">Top 3 Female</a>
            </nav>
        </div>
    </div>
</div>
