<!--  Header Start -->
<header class="app-header card">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-link">
                <!-- <p style="margin: unset;"><img src="img/logo50px.png"></p> -->
                <!-- <p style="margin: unset;"><strong>🗓️ COSEMS/SC</strong></p> -->
                <a href="perguntas.php" class="btn btn-primary">
                    <!--<i class="ti ti-server"></i>--> Perguntas
                </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="img/avatar.png" alt="" width="35" height="35" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="dashboard.php" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-gauge fs-6"></i>
                                <p class="mb-0 fs-3">Dashboard</p>
                            </a>
                            <a href="perguntas.php" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-checklist fs-6"></i>
                                <p class="mb-0 fs-3">Perguntas</p>
                            </a>
                            <a href="index.php" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-list-details fs-6"></i>
                                <p class="mb-0 fs-3">Cadastro</p>
                            </a>
                            <a href="include/logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Sair</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>