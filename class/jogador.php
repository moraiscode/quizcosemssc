<?php

include "conexao.php";

class Usuario
{
    public function cadastrar($nome, $whatsapp, $email, $estado, $profissao)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        // Adiciona máscara do WhatsApp
        $whatsapp = preg_replace('/[^0-9]/', '', $whatsapp);

        $sql = "INSERT INTO jogador (nome, whatsapp, email, estado, profissao) 
                VALUES ('$nome', '$whatsapp', '$email', '$estado', '$profissao')";

        if ($conn->query($sql)) {
            header("Location: ../quiz.php");
            exit();
        } else {
            echo "Erro ao cadastrar usuário: " . $conn->error;
        }

        $conexao->fecharConexao();
    }

    public function verificarAcesso($whatsapp)
    {
        include_once "conexao.php";
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $whatsapp = preg_replace('/[^0-9]/', '', $whatsapp);

        $sql = "SELECT * FROM jogador WHERE whatsapp = '$whatsapp'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['vitorioso'] || !empty($row['codigoretirada'])) {
                // Se já venceu o quiz ou possui código de retirada
                $conexao->fecharConexao();
                echo 'venceu_quiz';
                exit();
            } else {
                // Se existir e não venceu o quiz
                $conexao->fecharConexao();
                // echo 'quiz.php';

                // Salve o WhatsApp na sessão
                $_SESSION['whatsapp'] = $whatsapp;

                header("Location: ../quiz.php?whatsapp=" . urlencode($whatsapp));

                exit();
            }
        } else {
            // Se não existe
            $conexao->fecharConexao();
            echo 'nao_cadastrado';
            exit();
        }
    }
}