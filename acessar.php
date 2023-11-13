<?php

include "include/header.php";
session_start();
require_once('class/login.php');

if (isset($_SESSION['usuario'])) {

    header("Location: dashboard.php");

} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        $login = new Login();
        if ($login->autenticar($usuario, $senha)) {
            $_SESSION['usuario'] = $usuario;
            header("Location: acessar.php");
            exit();
        } else {
            $erroconnmsg = "Erro: dados inválidos!";
            // Não redirecione, exiba o alerta aqui
            echo "<script>mostrarErroConexao('$erroconnmsg');</script>";
        }
    }
    ?>

    <body>

        <!-- Body Wrapper -->
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
            data-sidebar-position="fixed" data-header-position="fixed">
            <div
                class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
                <div class="d-flex align-items-center justify-content-center w-100">
                    <div class="row justify-content-center w-100">
                        <div class="col-md-8 col-lg-6 col-xxl-3">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <a href="" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                        <img src="img/logocongresso200px.png" width="200" alt="">
                                    </a>
                                    <?php
                                    // Exibir alerta de erro de conexão se houver
                                    if (isset($erroconnmsg) && !empty($erroconnmsg)) {
                                        echo '<div class="alert alert-danger mt-3" role="alert">' . $erroconnmsg . '</div>';
                                    }
                                    ?>
                                    <form method="post">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Usuário</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="usuario"
                                                aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="exampleInputPassword1" class="form-label">Senha</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1"
                                                name="senha" required>
                                        </div>

                                        <button type="submit"
                                            class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Entrar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "include/footer.php"; ?>

        <script>
            // Função para mostrar alerta SweetAlert
            function mostrarErroConexao(erro) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro na Conexão',
                    text: erro,
                });
            }
        </script>

        <?php
        // Verificar se houve erro de conexão e exibir o alerta
        if (isset($login) && $login instanceof Login && $login->conn->connect_error) {
            $login->mostrarErroConexao($login->conn->connect_error);
        }
        ?>

    </body>

    </html>

    <?php
    // Fechar a conexão com o banco de dados
    if (isset($login) && $login instanceof Login) {
        $login->fecharConexao();
    }
}
?>