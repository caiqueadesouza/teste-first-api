<?php

require_once("bootstrap.php");

use App\Controllers\UsuarioController;

try {
    $metodo = $_SERVER['REQUEST_METHOD'];

    switch ($metodo) {
        case 'GET':
            $userController = new UsuarioController;
            $userController->index();
            break;

        case 'POST':
            $userController = new UsuarioController;
            $userController->salvar($_POST);
            break;

        default:
            throw new Exception("404 Not Found", 404);
            break;
    }
} catch (Exception $e) {
    http_response_code($e->getCode());
    echo $e->getMessage();
}
