# TESTE FIRST

*Autor: Caíque Rodrigues*

*Para Utilização do Projeto*
- Rodar comando "composer dump-autoload" (teste-first-api)
- Rodar script sql que se encontra neste arquivo para criação do banco de dados
- As credenciais do banco de dados estão no arquivo (config.json). Caso seja necessario mudar, mude diratemente no arquivo.


#### Projeto estruturado em duas partes de forma separada (Back e Front) 
#### Utilizado estrutura MVC
#### Progamação Orientada a Objeto (POO)


### Neste projeto foi utilizado
 
 --- BACK END ---
 * PHP 8^
 * Banco de Dados Mysql
 * Composer para autoload
 * PHPUnit


 --- FRONT END ---
 * HTML5
 * CSS3
 * JavaScript
 * Biblioteca CSS Bootstrap
 * Biblioteca JavaScript Jquery
 * Ajax
 

--- BANCO DE DADOS ---

CREATE DATABASE IF NOT EXISTS `teste_first`;
USE `teste_first`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;