<?php

namespace App\Models;

use App\Core\DB;
use Exception;

class UserModel
{
    public static function listar()
    {
        try {
            $db = new DB();
            $query = $db->query(
                'SELECT * FROM usuarios ORDER BY nome'
            );

            return $query->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function save($data)
    {
        try {
            $db = new DB();

            $currentDateTime = date('Y-m-d H:i:s');

            $db->insert(
                'usuarios',
                'nome,email,senha,created_at',
                "'" . $data['nome'] . "','" . $data['email'] . "','" . $data['senha'] . "','" . $currentDateTime . "'"
            );
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
