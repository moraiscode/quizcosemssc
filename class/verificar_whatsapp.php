<?php
include("conexao.php");

// Verifique se o número de WhatsApp foi enviado via POST
if (isset($_POST['whatsapp'])) {
    $whatsappDoJogador = $_POST['whatsapp'];
    $whatsappDoJogador = preg_replace('/[^0-9]/', '', $whatsappDoJogador);

    // Use a instância da classe Conexao para obter a conexão com o banco de dados
    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    $query = "SELECT COUNT(*) as count FROM jogador WHERE whatsapp = '$whatsappDoJogador'";
    $result = $conn->query($query);

    $response = array('exists' => false);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['count'] > 0) {
            $response['exists'] = true;
        }
    }

    // Retorne a resposta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);

    // Feche a conexão com o banco de dados
    $conexao->fecharConexao();
} else {
    // Se o número de WhatsApp não foi enviado, retorne um erro
    http_response_code(400);
    echo json_encode(array('error' => 'Número de WhatsApp não fornecido.'));
}
?>