<?php
require_once "../models/Cliente.php";
require_once "Conexao.php";

class ClienteController
{

    public static function inserir(Cliente $cliente){
        $sql = "INSERT INTO cliente (nome, cpf, endereco, email, senha, telefone) 
                VALUES (:nome, :cpf, :endereco, :email, :senha, :telefone)";

        $db = Conexao::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':nome', $cliente->getNome());
        $stmt->bindValue(':cpf', $cliente->getCpf());
        $stmt->bindValue(':endereco', $cliente->getEndereco());
        $stmt->bindValue(':email', $cliente->getEmail());
        $stmt->bindValue(':senha', $cliente->getSenha());
        $stmt->bindValue(':telefone', $cliente->getTelefone());

        $stmt->execute();

        return "OK";
    }

}