<?php

require_once 'Crud.php';

class Usuario
{
    private $conexao;
    private $table = "usuario";

    public $id;
    public $nome;
    public $email;
    public $senha;
    public $data_nasc;

    public function __construct($bd)
    {
        $this->conexao = $bd;
    }

    public function getIdUsuario($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = {$this->$id}";
        $resultado = $this->conexao->query($query);
        return $resultado->fetch_all(MSQLI_ASSOC);
    }

    // public function cadastrar()
    // {
    //     $query = "INSERT INTO {$this->table} (nome, email, senha, data_nasc) values ('{$this->nome}','{$this->email}','{$this->senha}','{$this->data_nasc}');";
    //     return $this->conexao->query($query);
    // }

    public function cadastrar()
    {
        $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);
        
        $query = "INSERT INTO {$this->table} (nome, email, senha, data_nasc) values ('{$this->nome}','{$this->email}','{$this->senha}','{$this->data_nasc}');";
        return $this->conexao->query($query);
    }

    public function logar()
    {
        $query = "SELECT * FROM {$this->table} WHERE email = ? LIMIT 1";
        $stmt = $this->conexao->prepare($query);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0)
        {
            $usuario = $resultado->fetch_assoc();
            if (password_verify($this->senha, $usuario['senha'])) {
                return true;
            }
        }
        return false;
    }

    public function __destruct() {
        if ($this->conexao) {
            $this->conexao->close();
        }
    }

    public function ler()
    {
        $query = "SELECT * FROM {$this->table}";
        return $this->conexao->query($query);
    }

    public function atualizar()
    {
        $query = "UPDATE {$this->table} SET nome = {$this->nome}, email = {$this->email}, senha = {$this->senha}, data_nasc = {$this->data_nasc} WHERE id = {$this->id}";
    }

    public function deletar()
    {
        $query = "DELETE FROM {$this->table} WHERE id = {$this->id}";
        return $this->conexao->prepare($query);
    }
}