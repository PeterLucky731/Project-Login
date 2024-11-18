<?php

require_once '../controllers/cadastroController.php';

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

switch($acao)
{
    case 'cadastrar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarioController = new usuarioController();
            $usuarioController->cadastrar($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['data_nasc']);
        } else {
            echo "Método de requisição inválido.";
        }
        break;
    
    default:
        include '../views/formCadastro.php';
}