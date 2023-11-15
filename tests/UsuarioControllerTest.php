<?php

namespace App\tests;

use PHPUnit\Framework\TestCase;
use App\Controllers\UsuarioController;

class UsuarioControllerTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testSalvar()
    {
        $userController = new UsuarioController;
        $dados = [
            'nome' => 'Caíque Rodrigues',
            'email' => 'caique@gmail.com',
            'senha' => '123456',
            'confirmSenha' => '123456'
        ];
        
        ob_start();
        $userController->salvar($dados);
        $result = ob_get_clean();

        $decodedResult = json_decode($result, true);

        $this->assertEquals(['message' => 'Usuário Criado com Sucesso!'], $decodedResult);
    }
}
