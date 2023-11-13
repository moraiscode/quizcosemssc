<?php

session_start();

// Verificar se o usuário não está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: acessar.php");
    exit();
}