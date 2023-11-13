<?php
include_once "jogador.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = new Usuario();
    $whatsapp = $_POST['whatsappmodal'];
    $resultado = $usuario->verificarAcesso($whatsapp);

    // Construir a URL com o parâmetro
    $url = "quiz.php?whatsapp=" . urlencode($whatsapp);

    // Redirecionar para a URL
    header("Location: $url");
    exit();
}
?>