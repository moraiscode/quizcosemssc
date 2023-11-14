<?php

include "conexao.php";

// Se o número de WhatsApp estiver disponível na sessão
if (isset($_SESSION['whatsapp'])) {
    $whatsappDoJogador = $_SESSION['whatsapp'];

    // Crie uma instância da classe Conexao
    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    // Atualize o campo "vitorioso" para true
    $updateQuery = "UPDATE jogador SET vitorioso = true WHERE whatsapp = '$whatsappDoJogador'";
    $conn->query($updateQuery);

    // Gere o código
    $codigo = strtoupper(substr($whatsappDoJogador, 0, 2) . rand(1000, 9999));

    // Atualize o campo "codigoretirada" com o código gerado
    $updateCodigoQuery = "UPDATE jogador SET codigoretirada = '$codigo' WHERE whatsapp = '$whatsappDoJogador'";
    $conn->query($updateCodigoQuery);

    // Feche a conexão
    $conexao->fecharConexao();
}