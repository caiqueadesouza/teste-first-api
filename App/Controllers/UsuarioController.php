<?php

namespace App\Controllers;

use App\Models\UserModel;

class UsuarioController
{
    public function index()
    {
        $usuarios = UserModel::listar();
        $this->sendJsonResponse($usuarios, 201);
    }

    public function salvar($request)
    {
        $errors = $this->validateFormFields($request);

        if (empty($errors)) {
            $nome = $request['nome'] ?? '';
            $email = $request['email'] ?? '';
            $senha = password_hash($request['senha'] ?? '', PASSWORD_BCRYPT);

            $usuarioModel = new UserModel();
            $response = $usuarioModel->save([
                'nome' => $nome,
                'email' => $email,
                'senha' => $senha
            ]);

            $this->sendJsonResponse(['message' => 'Usuário Criado com Sucesso!'], 201);
        } else {
            $this->sendJsonResponse(['errors' => $errors], 400);
        }
    }

    private function sendJsonResponse($data, $statusCode)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
    }

    private function validateFormFields($data)
    {
        $errors = [];

        if (empty($data['nome']) || strlen($data['nome']) < 3 || strlen($data['nome']) > 50) {
            $errors['nome'] = 'O nome deve ter entre 3 e 50 caracteres.';
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'O e-mail fornecido é inválido.';
        }

        if (empty($data['senha']) || strlen($data['senha']) < 6 || strlen($data['senha']) > 20) {
            $errors['senha'] = 'A senha deve ter entre 6 e 20 caracteres.';
        }

        if ($data['senha'] !== $data['confirmSenha']) {
            $errors['confirmSenha'] = 'A confirmação de senha não coincide com a senha.';
        }

        return $errors;
    }
}
