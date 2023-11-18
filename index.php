<?php 

session_start();
include "include/header.php"; 

?>

<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">

                    <!-- <button type="button" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-list"></i>
                    </button> -->

                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">

<?php
include "class/conexao.php";

$conexao = new Conexao();
$conn = $conexao->getConnection();

$query = "SELECT COUNT(*) as total_registros FROM jogador";
$resultado = $conn->query($query);

if ($resultado) {
    $totalRegistros = $resultado->fetch_assoc()['total_registros'];
    echo "<span class=\"timeline-badge border-2 border border-success flex-shrink-0 my-8\"></span>";
    $resultado->free();
} else {
    echo "Erro na consulta: " . $conn->error;
}
$conexao->fecharConexao();
?>


                                <a href="" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="img/logocongresso200px.png" width="200" alt="">
                                </a>

                                <form method="post" action="class/cadastro.php"
                                    onsubmit="return verificarAcessoAntesDeEnviar()">

                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input style="text-transform: capitalize;" type="text" class="form-control" id="nome" name="nome"
                                            aria-describedby="nomeHelp" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="whatsapp" class="form-label">WhatsApp</label>
                                        <input type="tel" class="form-control" id="whatsapp" name="whatsapp"
                                            aria-describedby="whatsappHelp" placeholder="Exemplo: (47) 98273-4573"
                                            required>
                                    </div>

                                    <div id="whatsappAlert" class="alert d-none" role="alert"></div>

                                    <script src="js/mascarawhatsapp.js"></script>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            aria-describedby="emailHelp" placeholder="seuemail@gmail.com" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="estado" class="form-label">Estado</label>
                                        <select class="form-select" id="estado" name="estado"
                                            aria-describedby="estadoHelp" required>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espírito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>

                                        </select>
                                        <small id="estadoHelp" class="form-text text-muted">Selecione o estado</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="profissao" class="form-label">Profissão</label>
                                        <select class="form-select" id="profissao" name="profissao"
                                            aria-describedby="profissaoHelp" required>
                                            <option value="Nutricionista">Nutricionista</option>
                                            <option value="Estudante">Estudante</option>
                                            <option value="Professor">Professor</option>
                                            <option value="Gestor">Gestor</option>
                                            <option value="Outro">Outro</option>
                                        </select>

                                        <div id="outroProfissao" class="mb-3" style="display: none;">
                                            <label for="outroProfissao" class="form-label">Outro</label>
                                            <input type="text" class="form-control" id="outroProfissao"
                                                name="outroProfissao" aria-describedby="outroProfissaoHelp">
                                            <small id="outroProfissaoHelp" class="form-text text-muted">Adicione sua
                                                profissão</small>
                                        </div>

                                        <script>
                                        document.getElementById('profissao').addEventListener('change', function() {
                                            var outroProfissao = document.getElementById('outroProfissao');
                                            if (this.value === 'Outro') {
                                                outroProfissao.style.display = 'block';
                                            } else {
                                                outroProfissao.style.display = 'none';
                                            }
                                        });
                                        </script>
                                    </div>

                                    <button id="cadastrarButton" type="submit"
                                        class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Cadastrar
                                    </button>

                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Já tem cadastro?</p>
                                        <a class="fw-bold fs-4 ms-2 text-primary" href="#verificationModal"
                                            data-bs-toggle="modal" data-bs-target="#verificationModal">Clique e acesse
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <small>
                                            <br /><a href="acessar.php" class="text-info fw-bold">Painel
                                                Administrativo</a>
                                        </small>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuario = new Usuario();
        $usuario->cadastrar($_POST['nome'], $_POST['whatsapp'], $_POST['email'], $_POST['estado'], $_POST['profissao']);
    }
    ?>

    <!-- Modal -->
    <div class="modal fade" id="verificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Digite seu WhatsApp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <input type="tel" class="form-control" id="whatsappmodal" name="whatsappmodal"
                            aria-describedby="whatsappHelp" placeholder="Exemplo: (47) 98273-4573" required>
                    </div>

                    <script src="js/mascarawhatsappmodal.js"></script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onclick="verificarAcesso()">Entrar</button>
                </div>
            </div>
        </div>
    </div>

    <?php include "include/footer.php"; ?>

    <script src="js/verificarwhatsapp.js"></script>
    <script src="js/cadastro.js"></script>

    <?php
    if (isset($login) && $login instanceof Login && $login->conn->connect_error) {
        $login->mostrarErroConexao($login->conn->connect_error);
    }
    ?>

</body>

</html>