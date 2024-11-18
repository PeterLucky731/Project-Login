<?php

require_once '../config/banco.php';
require_once '../models/usuario.php';

// class usuarioController {
//     public function cadastrar($nome, $email, $senha, $data_nasc) {
//         $database = new Banco();
//         $bd = $database->conectar();

//         $usuario = new Usuario($bd);
//         $usuario->nome = $nome;
//         $usuario->email = $email;
//         $usuario->senha = password_hash($senha, PASSWORD_DEFAULT); // Hash da senha
//         $usuario->data_nasc = $data_nasc;

//         if ($usuario->cadastrar()) {
//             $bd->close();
//             header('Location:../pages/cadastroUsuario.php');
//             exit; 
//         } else {
//             echo "Erro ao cadastrar usuario";
//         } 
//     }
// }

class usuarioController
{
    protected $banco;
    protected $usuario;

    public function __construct()
    {
        $this->banco = new Banco();
        $this->usuario = new Usuario($this->banco->conectar());
    }

    public function cadastrar($nome, $email, $senha, $data_nasc)
    {
        $this->usuario->nome = $nome;
        $this->usuario->email = $email;
        $this->usuario->senha = $senha; // A senha será hashada na função cadastrar
        $this->usuario->data_nasc = $data_nasc;

        if ($this->usuario->cadastrar()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar.";
        }
    }

    public function login($email, $senha)
    {
        $this->usuario->email = $email;
        $this->usuario->senha = $senha; // A senha será verificada na função logar
        if ($this->usuario->logar()) {
            echo "Login bem-sucedido!";
        } else {
            echo "Email ou senha incorretos.";
        }
    }
}