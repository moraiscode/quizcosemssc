<?php

include "conexao.php";

if (isset($_GET['whatsapp'])) {
    $whatsappDoJogador = $_GET['whatsapp'];

    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    // Verifique a conexão
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // Atualize o campo "vitorioso" para true
    $updateQuery = "UPDATE jogador SET vitorioso = true WHERE whatsapp = '$whatsappDoJogador'";
    $conn->query($updateQuery);

    // Gere o código
    $codigo = strtoupper(substr($whatsappDoJogador, 0, 2) . rand(10000, 99999));

    // Atualize o campo "codigoretirada" com o código gerado
    $updateCodigoQuery = "UPDATE jogador SET codigoretirada = '$codigo' WHERE whatsapp = '$whatsappDoJogador'";
    $conn->query($updateCodigoQuery);

    // Feche a conexão
    $conn->close();
}
?>