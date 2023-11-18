<?php

// Inicie ou retome a sessão
//session_start();

class Conexao
{
    private $servername = "localhost";
    private $username = "u407903065_cfncosemssc";
    private $password = "ruqraQ-necxub-zifny5";
    private $dbname = "u407903065_cfncosemssc";
    protected $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            $this->mostrarErroConexao($this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    private function mostrarErroConexao($erro)
    {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro na Conexão',
                    text: '$erro',
                });
              </script>";
        die("Falha na conexão com o banco de dados: $erro");
    }

    public function fecharConexao()
    {
        $this->conn->close();
    }
}
?>