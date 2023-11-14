<?php
include("conexao.php");

if (isset($_GET['whatsapp'])) {
    $whatsappDoJogador = $_GET['whatsapp'];
    $whatsappDoJogador = preg_replace('/[^0-9]/', '', $whatsappDoJogador);

    $conn = new mysqli("localhost", "root", "", "cosemssc2023");

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $query = "SELECT COUNT(*) as count FROM jogador WHERE whatsapp = '$whatsappDoJogador'";
    $result = $conn->query($query);

    $response = array('exists' => false);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['count'] > 0) {
            $response['exists'] = true;
        }
    }

    echo json_encode($response);

    $conn->close();
}
?>