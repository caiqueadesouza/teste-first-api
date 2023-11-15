<?php
namespace App\Core;

use Exception;
use PDO;
use PDOException;

class DB
{
    private $error;
    private $host;
    private $name;
    private $username;
    private $password;
    private $driver;
    private $pdo;

    public function __construct()
    {
        $config = $this->loadConfig();
        $this->host = $config['host'];
        $this->name = $config['name'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->driver = $config['driver'];

        $this->pdo = $this->connect();
    }

    protected function connect()
    {

        $pdoConfig = $this->driver . ":" . "host=" . $this->host . ";";
        $pdoConfig .= "dbname=" . $this->name . ";";

        try {
            return new PDO($pdoConfig, $this->username, $this->password);
        } catch (PDOException $e) {
            throw new Exception("Erro de conexão com o banco de dados", 500);
        }
    }

    public function query($sql, $data_array = null)
    {

        $query = $this->pdo->prepare($sql);
        $exec = $query->execute($data_array);

        if ($exec) {
            return $query;
        } else {
            $error = $query->errorInfo();
            $this->error = $error[2];

            throw new Exception($this->error);
        }
    }

    public function insert($table, $cols, $values)
    {

        $stmt = "INSERT INTO $table ( $cols ) VALUES ( $values ) ";

        $insert = $this->query($stmt);

        if ($insert) {

            if (
                method_exists($this->pdo, 'lastInsertId')
                && $this->pdo->lastInsertId()
            ) {
                $this->last_id = $this->pdo->lastInsertId();
            }

            return $insert;
        }

        return;
    }

    private function loadConfig()
    {
        $configFile = __DIR__ . '/../../config.json';

        if (!file_exists($configFile)) {
            throw new Exception("Arquivo de configuração não encontrado", 500);
        }

        $config = json_decode(file_get_contents($configFile), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Erro ao decodificar arquivo de configuração", 500);
        }

        if (!isset($config['db'])) {
            throw new Exception("Formato de arquivo de configuração inválido", 500);
        }

        return $config['db'];
    }


}