<?php

require_once '../controllers/loginController.php';

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

switch($acao)
{
    case 'login':
        $loginController = new loginController();
        $loginController->login($_POST['email'], $_POST['senha']);
        break;
    
    default:
        include '../views/formLogin.php';
}