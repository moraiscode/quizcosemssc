<?php

include "class/resgatarcodigo.php";
include "include/header.php";

?>

<body>
    <!--  Body Wrapper -->

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="alert alert-success" role="alert">
                                            Parabéns! Este é o seu código exclusivo para retirada do kit. Guarde-o com
                                            cuidado, pois será necessário apresentá-lo para receber o seu prêmio. O
                                            código é:
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="alert alert-secondary" role="alert">
                                            <?php
                                            echo "<h1 style=\"text-align: center; font-size: 4em;\"><strong>" . $codigo . "</strong></h1>";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

    include "include/footer.php";

    ?>