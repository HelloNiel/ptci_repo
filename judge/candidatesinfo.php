<!DOCTYPE html>
<html lang="en">
    <head>
        <?php  include 'includes/header.php' ?>
        <style>
        body {
            background-color: white;
            margin: 0;
        }
        p {
            font-size: 21px;
        }
        h1 {
            text-align: center;
            font-size: 100px;
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            font-size: 50px;
            margin-top: 50px;
        }
        h3 {
            margin-top: 15px;
        }
        h4 {
            letter-spacing: 1px;
            font-size: 26px;
            font-weight: bold;
            margin-top: 15px;
        }
        .container-fluid {
            display: flex;
            flex-wrap: nowrap;
            justify-content: center;
        }
        .candidate {
            background-color: white;
            border-radius: 10px;
            margin: 10px;
            padding: 15px;
            border: 1px solid gray;
            width: 400px;
            text-align: center;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        .candidate img {
            width: 100%;
            border-radius: 5px;
        }
        .modal {
            display: none;
            position: fixed;
            left: 32%;
            top: 0;
        }
        .modal img {
            width: 700px;
            height: 950px;
            cursor: pointer;
        }
    </style>
    </head>
    <body class="sb-nav-fixed">
        <div id="layoutSidenav_nav">
            <div id="layoutSidenav_content mt-5">
                <main>
                    <h1>Pageant Candidates</h1>
                    <h2>Male Candidates</h2>
                    <div class="container-fluid">
                        <div class="candidate" onclick="openModal('../candidate/Evanry1.jpeg')">
                            <img src="../candidate/Evanry1.jpeg" alt="CandidateMale1" >
                            <h3>1</h3>
                            <h4>Evanry<br>Villanueva</h4>
                            <p>Team 5 - Red Pheonix</p>
                        </div>
                        <div class="candidate" onclick="openModal('../candidate/Hans2.jpeg')">
                            <img src="../candidate/Hans2.jpeg" alt="CandidateMale2" >
                            <h3>2</h3>
                            <h4>Hans<br>Babor</h4>
                            <p>Team 5 - Blue Eagles </p>
                        </div>
                        <div class="candidate" onclick="openModal('../candidate/JayMark3.jpeg')">
                            <img src="../candidate/JayMark3.jpeg" alt="CandidateMale3">
                            <h3>3</h3>
                            <h4>Jay Mark<br>Mahilum</h4>
                            <p>Team 3 - Green Tamaraws</p>
                        </div>
                        <div class="candidate" onclick="openModal('../candidate/JohnRick4.jpeg')">
                            <img src="../candidate/JohnRick4.jpeg" alt="CandidateMale4">
                            <h3>4</h3>
                            <h4>John Rick<br>Cañete</h4>
                            <p>Team 2 - Yellow Tigers</p>
                        </div>
                        <div class="candidate" onclick="openModal('../candidate/KeanCarl5.jpeg')">
                            <img src="../candidate/KeanCarl5.jpeg" alt="CandidateMale5">
                            <h3>5</h3>
                            <h4>Kean Carl<br>Remiendo</h4>
                            <p>Team 1 - Orange Wolves</p>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="candidate" onclick="openModal('../candidate/Wenex6.jpeg')">
                            <img src="../candidate/Wenex6.jpeg" alt="CandidateMale6">
                            <h3>6</h3>
                            <h4>Wenex<br>Pastolero</h4>
                            <p>Team 4 - Blue Eagles</p>
                        </div>
                        <div class="candidate" onclick="openModal('../candidate/Charles7.jpeg')">
                            <img src="../candidate/Charles7.jpeg" alt="CandidateMale7">
                            <h3>7</h3>
                            <h4>Charles<br>Repalbor</h4>
                            <p>Team 5 - Red Pheonix</p>
                        </div>
                        <div class="candidate" onclick="openModal('../candidate/ChristianJay8.jpeg')">
                            <img src="../candidate/ChristianJay8.jpeg" alt="CandidateMale8">
                            <h3>8</h3>
                            <h4>Christian Jay<br>Soberano</h4>
                            <p>Team 3 - Green Tamaraws</p>
                        </div>
                        <div class="candidate" onclick="openModal('../candidate/Raffy9.jpeg')">
                            <img src="../candidate/Raffy9.jpeg" alt="CandidateMale9">
                            <h3>9</h3>
                            <h4>Raffy<br>Maulion</h4>
                            <p>Team 9 - Orange Wolves</p>
                        </div>
                        <div class="candidate" onclick="openModal('../candidate/Kevin10.jpeg')">
                            <img src="../candidate/Kevin10.jpeg" alt="CandidateMale10">
                            <h3>10</h3>
                            <h4>Kevin San<br>Buenaventura</h4>
                            <p>Team 2 - Yellow Tigers</p>
                        </div>
                    </div>

                    <h2>Female Candidates</h2>
                    <div class="container-fluid">
                        <div class="candidate" onclick="openModal('../candidate/Kristel1.jpeg')">
                            <img src="../candidate/Kristel1.jpeg " alt="CandidateFemale1">
                            <h3>1</h3>
                            <h4>Kristel<br>Vera</h4>
                            <p>Team 5 - Red Pheonix</p>
                        </div>
                        <div class="candidate" onclick="openModal('../candidate/Angel2.jpeg')">
                            <img src="../candidate/Angel2.jpeg" alt="CandidateFemale2">
                            <h3>2</h3>
                            <h4>Angel<br>Pantanilla</h4>
                            <p>Team 4 - Blue Eagles</p>
                        </div>
                        <div class="candidate" onclick="openModal('../candidate/Arianne3.jpeg')">
                            <img src="../candidate/Arianne3.jpeg" alt="CandidateFemale3">
                            <h3>3</h3>
                            <h4>Arianne<br>Batayo</h4>
                            <p>Team 3 - Green Tamaraws</p>
                        </div>
                        <div class="candidate" onclick="openModal('../candidate/IMG_8672.jpeg')">
                            <img src="../candidate/Shekayna4.jpeg" alt="CandidateFemale4">
                            <h3>4</h3>
                            <h4>Shekayna<br>Paguia</h4>
                            <p>Team 2 - Yellow Tigers</p>
                        </div>
                        <div class="candidate" onclick="openModal('../candidate/JudyMae5.jpeg')">
                            <img src="../candidate/JudyMae5.jpeg" alt="CandidateFemale5">
                            <h3>5</h3>
                            <h4>Judy Mae<br>Ortega</h4>
                            <p>Team 1 - Orange Wolves</p>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="candidate" onclick="openModal('../candidate/VanMichaela6.jpeg')">
                            <img src="../candidate/VanMichaela6.jpeg" alt="CandidateFemale6">
                            <h3>6</h3>
                            <p>Van Michaela<br>Jagmis</p>
                            <p>Team 4 - Blue Eagles</p>
                        </div>
                        <div class="candidate" onclick="openModal('../candidate/Pauline7.jpeg')">
                            <img src="../candidate/Pauline7.jpeg" alt="CandidateFemale7">
                            <h3>7</h3>
                            <p>Pauline Jean<br>Pantollano</p>
                            <p>Team 5 - Red Pheonix</p>
                        </div>
                        <div class="candidate" onclick="openModal('../candidate/Princess8.jpeg')">
                            <img src="../candidate/Princess8.jpeg" alt="CandidateFemale8">
                            <h3>8</h3>
                            <p>Princess Kaye<br>Jagmis</p>
                            <p>Team 3 - Green Tamaraws</p>
                        </div>
                        <div class="candidate" onclick="openModal('../candidate/Antonette9.jpeg')">
                            <img src="../candidate/Antonette9.jpeg" alt="CandidateFemale9">
                            <h3>9</h3>
                            <p>Antonette<br>Carpio</p>
                            <p>Team 1 - Orange Wolves</p>
                        </div>
                        <div class="candidate" onclick="openModal('../candidate/Sharmaine10.jpeg')" >
                            <img src="../candidate/Sharmaine10.jpeg" alt="CandidateFemale10">
                            <h3>10</h3>
                            <p>Sharmaine<br>Parapina</p>
                            <p>Team 2 - Yellow Tigers</p>
                        </div>
                    </div>

                    <div class="modal" id="myModal">
                        <img id="modalImg" onclick="closeModal()">
                    </div>
                    </div>
                </main>
            </div>
        </div>
        <script>
    function openModal(imgSrc) {
        document.getElementById("myModal").style.display = "block";
        document.getElementById("modalImg").src = imgSrc;
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }
    
</script>
        <?php  include 'includes/script.php'; ?>
    </body>
</html>
