<?php
require_once('conexao.php');

class Login extends Conexao
{
    public function autenticar($usuario, $senha)
    {
        //$senha = md5($senha); // Use hash para maior segurança (não esqueça de saltar a senha)

        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->registrarLog($row['id']);

            return true;
        } else {
            return false;
        }
    }

    private function registrarLog($usuario_id)
    {
        $data_login = date("Y-m-d H:i:s");
        $ip = $_SERVER['REMOTE_ADDR'];
        $dispositivo = $_SERVER['HTTP_USER_AGENT'];

        $log_sql = "INSERT INTO log_acesso (usuario_id, data_login, ip, dispositivo) VALUES ('$usuario_id', '$data_login', '$ip', '$dispositivo')";
        $this->conn->query($log_sql);
    }
}