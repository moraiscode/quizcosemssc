<?php

//include "conexao.php";

// Inicie ou retome a sessão
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //include_once "jogador.php"; // Substitua "Usuario.php" pelo nome real do seu arquivo

    // Obter dados do formulário
    $nome = $_POST['nome'];
    $whatsapp = $_POST['whatsapp'];
    $email = $_POST['email'];
    $estado = $_POST['estado'];
    $profissao = $_POST['profissao'];

    // Criar instância da classe Usuario
    $usuario = new Usuario();

    // Salve o WhatsApp na sessão
    $_SESSION['whatsapp'] = $whatsapp;

    // Chamar o método cadastrar para inserir dados no banco de dados
    $usuario->cadastrar($nome, $whatsapp, $email, $estado, $profissao);
}
?>