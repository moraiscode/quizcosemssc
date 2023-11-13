<?php
include_once "jogador.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = new Usuario();
    $whatsapp = $_POST['whatsappmodal'];
    $resultado = $usuario->verificarAcesso($whatsapp);

    // Enviar resposta adequada ao Ajax
    echo $resultado;
}
?>