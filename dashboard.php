<?php

include "class/verificasessao.php";
include "include/header.php";
include "class/conexao.php";

?>

<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <div class="body-wrapper">

            <?php include "include/navbar.php"; ?>

            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-lg-7 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body p-4">
            
            <?php

// Crie uma instância da classe Conexao
$conexao = new Conexao();
$conn = $conexao->getConnection();

// Consulta para obter a quantidade total de registros
$queryTotalRegistros = "SELECT COUNT(*) as totalRegistros FROM jogador";
$resultTotalRegistros = $conn->query($queryTotalRegistros);
$rowTotalRegistros = $resultTotalRegistros->fetch_assoc();
$totalRegistros = $rowTotalRegistros['totalRegistros'];

// Consulta para obter o total de vencedores
$queryTotalVencedores = "SELECT COUNT(*) as totalVencedores FROM jogador WHERE vitorioso = 1";
$resultTotalVencedores = $conn->query($queryTotalVencedores);
$rowTotalVencedores = $resultTotalVencedores->fetch_assoc();
$totalVencedores = $rowTotalVencedores['totalVencedores'];

// Consulta para obter o total de kits entregues
$queryTotalKitsEntregues = "SELECT COUNT(*) as totalKitsEntregues FROM jogador WHERE entregue = 1";
$resultTotalKitsEntregues = $conn->query($queryTotalKitsEntregues);
$rowTotalKitsEntregues = $resultTotalKitsEntregues->fetch_assoc();
$totalKitsEntregues = $rowTotalKitsEntregues['totalKitsEntregues'];

$conexao->fecharConexao();

// -------------- CHART

// Função para obter as últimas horas do dia atual
function getLastDayHoursFromDatabase() {
    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    // Consulta para obter as últimas horas do dia atual
    //$query = "SELECT DISTINCT HOUR(datetime) as hour FROM jogador WHERE DATE(datetime) = CURDATE() ORDER BY hour ASC LIMIT 5";
    $query = "SELECT DISTINCT HOUR(datetime) as hour FROM jogador ORDER BY hour ASC LIMIT 5";
    $result = $conn->query($query);

    $hours = array();
    while ($row = $result->fetch_assoc()) {
        $hours[] = (int)$row['hour'];
    }

    $result->free();
    $conexao->fecharConexao();

    return $hours;
}


// Função para obter os registros das últimas horas do dia atual
function getLastDayRegistrationsFromDatabase() {
    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    // Consulta para obter os registros das últimas horas do dia atual
    // $query = "SELECT HOUR(datetime) as hour, COUNT(*) as registrations FROM jogador WHERE DATE(datetime) = CURDATE() GROUP BY hour ORDER BY hour ASC";
    $query = "SELECT HOUR(datetime) as hour, COUNT(*) as registrations FROM jogador GROUP BY hour ORDER BY hour ASC";
    $result = $conn->query($query);

    $registrations = array();
    while ($row = $result->fetch_assoc()) {
        $registrations[] = (int)$row['registrations'];
    }

    $result->free();
    $conexao->fecharConexao();

    return $registrations;
}


// Função para obter o número máximo de registros
function getMaxRegistrations() {
    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    // Consulta para obter o número máximo de registros
    $query = "SELECT COUNT(*) as maxRegistrations FROM jogador";
    $result = $conn->query($query);
    $maxRegistrations = $result->fetch_assoc()['maxRegistrations'];

    $result->free();
    $conexao->fecharConexao();

    return $maxRegistrations;
}

// -------------- END

?>

            <div class="alert alert-secondary" role="alert">
                    <h5 class="card-title fw-semibold mb-4">Estatísticas e Liberações:</h5> 
                    <span class="badge bg-dark rounded-3 fw-semibold"><?php echo " Cadastros: " . $totalRegistros . "<br>"; ?></span>
                    <span class="badge bg-primary rounded-3 fw-semibold"><?php echo " Vencedores: " . $totalVencedores . "<br>"; ?></span>
                    <span class="badge bg-danger rounded-3 fw-semibold"><?php echo " Kits Entregues: " . $totalKitsEntregues . "<br>"; ?></span>
            </div>
            

<?php
// ... Seu código existente ...

// Chama a função para obter os registros das últimas horas do dia atual
$registrationsArray = getLastDayRegistrationsFromDatabase();
$hoursArray = getLastDayHoursFromDatabase();

// Converte os arrays para strings JSON para uso no JavaScript
$hoursString = json_encode($hoursArray);
$registrationsString = json_encode($registrationsArray);

// Função para obter o número de vencedores por hora
function getLastDayWinnersFromDatabase() {
    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    // Consulta para obter o número de vencedores por hora
    $query = "SELECT HOUR(datetime) as hour, COUNT(*) as winners FROM jogador WHERE vitorioso = 1 GROUP BY hour ORDER BY hour ASC";
    $result = $conn->query($query);

    $winners = array();
    while ($row = $result->fetch_assoc()) {
        $winners[] = (int)$row['winners'];
    }

    $result->free();
    $conexao->fecharConexao();

    return $winners;
}

// ... Seu código existente ...

// Chama a função para obter os registros dos vencedores das últimas horas do dia atual
$winnersArray = getLastDayWinnersFromDatabase();

// Converte o array de vencedores para uma string JSON para uso no JavaScript
$winnersString = json_encode($winnersArray);

?>

<canvas id="areaChart"></canvas><br/>

<script>
    // Dados do PHP
    const hoursArray = ['<?php echo join("', '", $hoursArray); ?>'];
    const registrationsArray = [<?php echo join(', ', $registrationsArray); ?>];
    const winnersArray = [<?php echo join(', ', $winnersArray); ?>];

    // Usamos os dados do PHP
    const data = {
        labels: hoursArray,
        datasets: [{
            label: 'Cadastros x Hora (Total)',
            data: registrationsArray,
            backgroundColor: 'rgba(161, 208, 245, 0.2)',
            borderColor: '#a1d0f5',
            borderWidth: 1,
            borderCapStyle: 'round',
            fill: true
        }, {
            label: 'Vencedores',
            data: winnersArray,
            backgroundColor: 'rgba(132, 191, 63, 0.2)', // Cor de fundo vermelha com opacidade
            borderColor: '#84bf3f', // Cor da borda vermelha
            borderWidth: 1,
            borderCapStyle: 'round',
            fill: true
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom'
                },
                y: {
                    min: 0
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        },
        drawTime: 'beforeDatasetsDraw'
    };

    // Crie o gráfico de linha
    const ctx = document.getElementById('areaChart').getContext('2d');
    const myChart = new Chart(ctx, config);
</script>




            
            <div class="table-responsive" id="dataTable">
    <?php

    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    // Configurações para a páginação
    $registrosPorPagina = 5;
    $paginaAtual = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($paginaAtual - 1) * $registrosPorPagina;

    $query = "SELECT * FROM jogador WHERE codigoretirada IS NOT NULL ORDER BY datetime DESC LIMIT $registrosPorPagina OFFSET $offset";
    $resultado = $conn->query($query);

    if ($resultado) {

        echo '<table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Data</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Hora</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Nome</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Código</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Entrega</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>';

        while ($row = $resultado->fetch_assoc()) {
            $data = date("d/m", strtotime($row['datetime']));
            $hora = date("H:i", strtotime($row['datetime']));
            $nome = $row['nome'];
            $codigoretirada = $row['codigoretirada'];
            $entregue = $row['entregue'];

            $btnClass = $entregue ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm';

            echo '<tr>
                    <td><p class="mb-0 fw-normal">' . $data . '</p></td>
                    <td><p class="mb-0 fw-normal">' . $hora . '</p></td>
                    <td><p class="mb-0 fw-normal">' . $nome . '</p></td>
                    <td><p class="mb-0 fw-normal">' . $codigoretirada . '</p></td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <a href="" class="' . $btnClass . '" data-id="' . $row['id'] . '" onclick="liberarRegistro(' . $row['id'] . ')">Liberar</a>
                        </div>
                    </td>
                </tr>';
        }

        echo '</tbody></table>';

        // Adiciona a navegação da páginação
        $totalRegistros = $conn->query("SELECT COUNT(*) as totalRegistros FROM jogador")->fetch_assoc()['totalRegistros'];
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

        echo '<br/><nav aria-label="Page navigation example">
                <ul class="pagination">';

        $maxLinksBeforeAfter = 4;

        for ($i = 1; $i <= $totalPaginas; $i++) {
            if ($i <= $maxLinksBeforeAfter || $i > $totalPaginas - $maxLinksBeforeAfter || ($i >= $paginaAtual - $maxLinksBeforeAfter && $i <= $paginaAtual + $maxLinksBeforeAfter)) {
                $activeClass = ($paginaAtual == $i) ? 'active' : '';
                echo '<li class="page-item ' . $activeClass . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
            } elseif ($i == $maxLinksBeforeAfter + 1 || $i == $totalPaginas - $maxLinksBeforeAfter) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
        }

        echo '</ul>
            </nav>';

        $resultado->free();
    } else {

        echo "Erro na consulta: " . $conn->error;
    }

    $conexao->fecharConexao();

    ?>
</div>


        </div>
    </div>
</div>

                    
                    <div class="col-lg-5 d-flex align-items-stretch">
                        <div class=" w-100"> <!-- <div class="card w-100"> -->
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <h5 class="card-title fw-semibold">Atividade recente</h5>
                                </div>
                                <ul class="timeline-widget mb-0 position-relative">

                                    <?php

                  $conexao = new Conexao();
                  $conn = $conexao->getConnection();

                  $query = "SELECT datetime, nome FROM jogador ORDER BY datetime DESC LIMIT 17";
                  $resultado = $conn->query($query);

                  if ($resultado) {

                    while ($row = $resultado->fetch_assoc()) {
                      $hora = date("H:i", strtotime($row['datetime']));
                      $nome = $row['nome'];

                      echo '<li class="timeline-item d-flex position-relative overflow-hidden">
                <div class="timeline-time text-dark flex-shrink-0 text-end">' . $hora . '</div>
                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                    <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                </div>
                <div class="timeline-desc fs-3 text-dark mt-n1">' . $nome . '</div>
            </li>';
                    }

                    $resultado->free();
                  } else {

                    echo "Erro na consulta: " . $conn->error;
                  }

                  $conexao->fecharConexao();

                  ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>

                <?php include "include/devby.php"; ?>

            </div>

        </div>
    </div>

    <script>
    
     $(document).ready(function() {
        $('#dataTable').DataTable({
            "pagingType": "simple", // Adiciona uma paginação mais simples
            "pageLength": 5 // Define o número de registros por página
        });
    });
    
    function liberarRegistro(id) {
    console.log('Antes da solicitação AJAX');

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        console.log('Estado: ' + xhr.readyState + ', Status: ' + xhr.status);
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log('Após a solicitação AJAX');

            let btnElement = document.querySelector('.btn[data-id="' + id + '"]');
            btnElement.classList.remove('btn-outline-primary');
            btnElement.classList.add('btn-primary');
        }
    };

    xhr.open('GET', 'class/liberar_registro.php?id=' + id, true);

    xhr.onerror = function() {
    console.log("Erro na solicitação XHR");
};
    xhr.send();
}

setInterval(function() {
            location.reload();
        }, 60000);

    </script>

    <?php 
    
    include "include/footer.php"; 
    
    header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    
    ?>