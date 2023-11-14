<?php

include "jogador.php";

// Inicie ou retome a sessão
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter dados do formulário
    $nome = $_POST['nome'];
    $whatsapp = $_POST['whatsapp'];
    $email = $_POST['email'];
    $estado = $_POST['estado'];
    $profissao = $_POST['profissao'];

    // Criar instância da classe Usuario
    $usuario = new Usuario();

    $whatsapp = preg_replace('/[^0-9]/', '', $whatsapp);

    // Salve o WhatsApp na sessão
    $_SESSION['whatsapp'] = $whatsapp;

    // Chamar o método cadastrar para inserir dados no banco de dados
    $usuario->cadastrar($nome, $whatsapp, $email, $estado, $profissao);

    // Redirecione para o quiz.php após cadastrar os dados
    header("Location: ../quiz.php?whatsapp=" . urlencode($whatsapp));
    exit();
}