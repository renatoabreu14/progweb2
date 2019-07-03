<?php
require_once "../models/Cliente.php";
require_once "VendaController.php";
require_once "Conexao.php";

class ClienteController
{

    public static function salvar(Cliente $cliente){
        if ($cliente->getId() > 0){
            return self::alterar($cliente);
        }else{
            return self::inserir($cliente);
        }
    }

    private static function alterar(Cliente $cliente){
        $sql = "UPDATE cliente SET nome = :nome, cpf=:cpf, 
                endereco=:endereco, telefone=:telefone WHERE id=:id";

        $db = Conexao::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':nome', $cliente->getNome());
        $stmt->bindValue(':cpf', $cliente->getCpf());
        $stmt->bindValue(':endereco', $cliente->getEndereco());
        $stmt->bindValue(':telefone', $cliente->getTelefone());
        $stmt->bindValue(':id', $cliente->getId());

        $stmt->execute();

        return "OK";
    }

    private static function inserir(Cliente $cliente){
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

    public static function trazerTodos(){
        $sql = "SELECT * FROM cliente ORDER BY nome";
        $db = Conexao::getInstance();
        $stmt = $db->query($sql);
        $listagem = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $arrRetorno = array();
        foreach ($listagem as $itemLista){
            $arrRetorno[] = self::popularCliente($itemLista);
        }
        return $arrRetorno;
    }

    public static function buscarCliente($id){
        $sql = "SELECT * FROM cliente WHERE id = :id";
        $db = Conexao::getInstance();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $listagem = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($listagem) > 0){
            return self::popularCliente($listagem[0]);
        }
    }

    public static function loginshop($email, $senha){
        $sql = "SELECT * FROM cliente WHERE email = :email AND senha = :senha";
        $db = Conexao::getInstance();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();

        $listagem = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($listagem) > 0){
            $clientelogin = self::popularClienteLogin($listagem[0]);
            $_SESSION['cliente'] = serialize($clientelogin);
            return true;
        }else{
            return false;
        }
    }

    public static function login($email, $senha){
        $sql = "SELECT * FROM cliente WHERE email = :email AND senha = :senha";
        $db = Conexao::getInstance();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();

        $listagem = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($listagem) > 0){
            $clientelogin = self::popularClienteLogin($listagem[0]);
            $_SESSION['user'] = serialize($clientelogin);
            return true;
        }else{
            return false;
        }
    }

    private static function popularCliente($itemLista){
        $cliente = new Cliente();
        $cliente->setId($itemLista['id']);
        $cliente->setNome($itemLista['nome']);
        $cliente->setCpf($itemLista['cpf']);
        $cliente->setEndereco($itemLista['endereco']);
        $cliente->setTelefone($itemLista['telefone']);
        $cliente->setEmail($itemLista['email']);
        $cliente->setSenha($itemLista['senha']);
        return $cliente;
    }

    private static function popularClienteLogin($itemLista){
        $cliente = new Cliente();
        $cliente->setId($itemLista['id']);
        $cliente->setNome($itemLista['nome']);
        $cliente->setCpf($itemLista['cpf']);
        $cliente->setEndereco($itemLista['endereco']);
        $cliente->setTelefone($itemLista['telefone']);
        $cliente->setEmail($itemLista['email']);
        return $cliente;
    }

    public static function excluir($id){
        $sql = "DELETE FROM cliente WHERE id = :id";
        $db = Conexao::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public static function buscarPedidos($idcliente){
        $sql = "SELECT v.id AS idvenda, DATE_FORMAT(v.datavenda, '%d/%m/%Y') as datavenda, v.fk_idcliente, 
                    v.fk_idsituacao, c.*, s.descricao 
                    FROM venda v 
                    INNER JOIN situacao s ON v.fk_idsituacao = s.id 
                    INNER JOIN cliente c ON v.fk_idcliente = c.id 
                    WHERE fk_idcliente = :idcliente";
        $db = Conexao::getInstance();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':idcliente', $idcliente);
        $stmt->execute();
        $listagem = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $arrRetorno = array();
        foreach ($listagem as $itemLista){
            $arrRetorno[] = VendaController::popularVenda($itemLista);
        }
        return $arrRetorno;
    }

}