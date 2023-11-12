<?php
class Conexao
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "cosemssc2023";
    protected $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            $this->mostrarErroConexao($this->conn->connect_error);
        }
    }

    private function mostrarErroConexao($erro) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro na Conexão',
                    text: '$erro',
                });
              </script>";
        die("Falha na conexão com o banco de dados: $erro");
    }

    public function fecharConexao() {
        $this->conn->close();
    }
}
