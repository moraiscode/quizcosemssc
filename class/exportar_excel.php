<?php
// Arquivo exportar_excel.php

include "conexao.php";
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function formatarWhatsapp($whatsapp)
{
    // Adapte a lógica conforme necessário para o formato desejado
    return sprintf('(%s) %s-%s', substr($whatsapp, 0, 2), substr($whatsapp, 2, 5), substr($whatsapp, 7));
}

try {
    // Cria uma instância da classe Conexao
    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    // Consulta para obter os dados da tabela
    $query = "SELECT nome, whatsapp, email, estado, profissao, vitorioso FROM jogador";
    $result = $conn->query($query);

    // Cria uma instância da classe Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Define os cabeçalhos
    $sheet->setCellValue('A1', 'Nome');
    $sheet->setCellValue('B1', 'Whatsapp');
    $sheet->setCellValue('C1', 'E-mail');
    $sheet->setCellValue('D1', 'Estado');
    $sheet->setCellValue('E1', 'Profissão');
    $sheet->setCellValue('F1', 'Vitorioso');

    // Preenche os dados
    $row = 2;
    while ($rowDados = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $rowDados['nome']);
        $sheet->setCellValue('B' . $row, formatarWhatsapp($rowDados['whatsapp']));
        $sheet->setCellValue('C' . $row, $rowDados['email']);
        $sheet->setCellValue('D' . $row, $rowDados['estado']);
        $sheet->setCellValue('E' . $row, $rowDados['profissao']);
        $sheet->setCellValue('F' . $row, $rowDados['vitorioso']);

        $row++;
    }

    // Define o cabeçalho do tipo de conteúdo e o nome do arquivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="dados_jogadores.xlsx"');
    header('Cache-Control: max-age=0');

    // Cria um Writer para Excel e o envia para o navegador
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

    // Fecha a conexão
    $result->free();
    $conexao->fecharConexao();
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>
