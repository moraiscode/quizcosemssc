<?php

session_start();

if (isset($_SESSION['whatsapp'])) {
    $whatsappDoJogador = $_SESSION['whatsapp'];
}

include "include/header.php";
?>

<link rel="stylesheet" href="css/jogo.css">

<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="">

                                <div class="w-100 p-3">
                                    <div class="row text-center">

                                        <div class="col-md-12 align-middle">
                                            <h1 class="align-middle">
                                                <i class="ti ti-gauge"></i>
                                                <span id="timer"></span>
                                            </h1>
                                        </div>
                                        <div class="col-md-12 align-middle p-3">
                                            <div class="progress align-middle">
                                                <div id="timerBar" class="progress-bar"></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div id="questionContainer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jogo.js"></script>

    <?php include "include/footer.php"; ?>