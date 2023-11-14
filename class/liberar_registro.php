<?php

include "conexao.php";

// Obtenha o ID do registro a ser liberado
$id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($id > 0) {
    // Crie uma instância da classe Conexao
    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    // Atualize a coluna "entregue" para 1
    $updateQuery = "UPDATE jogador SET entregue = 1 WHERE id = $id";
    $conn->query($updateQuery);

    // Feche a conexão
    $conexao->fecharConexao();
}