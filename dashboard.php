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
          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <div class="mb-4">
                  <h5 class="card-title fw-semibold">Atividade recente</h5>
                </div>
                <ul class="timeline-widget mb-0 position-relative">

                  <?php

                  $conexao = new Conexao();
                  $conn = $conexao->getConnection();

                  $query = "SELECT datetime, nome FROM jogador ORDER BY datetime DESC LIMIT 5";
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
          <div class="col-lg-7 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Liberações</h5>
                <div class="table-responsive">

                  <?php

                  $conexao = new Conexao();
                  $conn = $conexao->getConnection();

                  $query = "SELECT * FROM jogador WHERE codigoretirada IS NOT NULL";
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
                  <h6 class="fw-semibold mb-0">Assigned</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Name</h6>
                </th>
              </tr>
            </thead>
            <tbody>';

                    while ($row = $resultado->fetch_assoc()) {
                      $data = date("d/m", strtotime($row['datetime']));
                      $hora = date("H:i", strtotime($row['datetime']));
                      $nome = $row['nome'];
                      $entregue = $row['entregue'];

                      $btnClass = $entregue ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm';

                      echo '<tr>
                <td><p class="mb-0 fw-normal">' . $data . '</p></td>
                <td><p class="mb-0 fw-normal">' . $hora . '</p></td>
                <td><p class="mb-0 fw-normal">' . $nome . '</p></td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <a href="#" class="' . $btnClass . '" data-id="' . $row['id'] . '" onclick="liberarRegistro(' . $row['id'] . ')">Liberar</a>
                    </div>
                </td>
            </tr>';
                    }

                    echo '</tbody></table>';
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
        </div>

        <?php include "include/devby.php"; ?>

      </div>

    </div>
  </div>

  <script>
    function liberarRegistro(id) {

      let xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {

          let btnElement = document.querySelector('.btn[data-id="' + id + '"]');
          btnElement.classList.remove('btn-outline-primary');
          btnElement.classList.add('btn-primary');
        }
      };

      xhr.open('GET', 'class/liberar_registro.php?id='.id, true);
      xhr.send();
    }
  </script>

  <?php include "include/footer.php"; ?>