<?php
namespace App\Database;

use PDO;
use PDOException;

class Conexao {
    private static $instance = null;

    private function __construct(){}

    public static function getConexao(){
        
        if(self::$instance === null){
            try {
                $host = $_ENV['DB_HOST'];
                $dbname = $_ENV['DB_NAME'];
                $user = $_ENV['DB_USER'];
                $password = $_ENV['DB_PASS'];

                self::$instance = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);

                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            }catch (PDOException $e) {
                http_response_code(500);
                die(json_encode(["erro" => "Erro ao conectar ao banco de dados: " . $e->getMessage()]));
            }
        }

        return self::$instance; // Retorna a instância da conexão PDO
    }
}