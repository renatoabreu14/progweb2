<?php
require_once "../models/Venda.php";
require_once "Conexao.php";

class VendaController
{
    public static function inserir(Venda $venda){
        $sql = "INSERT INTO venda (fk_idcliente, datavenda, fk_idsituacao) 
                VALUES (:idcliente, :datavenda, :idsituacao)";

        $db = Conexao::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':idcliente', $venda->getCliente()->getId());
        $stmt->bindValue(':datavenda', $venda->getDataVenda());
        $stmt->bindValue(':idsituacao', 1);

        $stmt->execute();

        return "OK";
    }

    public static function buscarVenda(Venda $venda){
        $sql = "SELECT v.id AS idvenda, v.datavenda, v.fk_idcliente, v.fk_idsituacao, c.*, s.descricao FROM venda v INNER JOIN situacao s ON v.fk_idsituacao = s.id INNER JOIN cliente c ON v.fk_idcliente = c.id WHERE fk_idcliente = :idcliente AND datavenda = :datavenda ORDER BY idvenda DESC LIMIT 1";
        $db = Conexao::getInstance();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':idcliente', $venda->getCliente()->getId());
        $stmt->bindValue(':datavenda', $venda->getDataVenda());
        $stmt->execute();

        $listagem = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($listagem) > 0){
            return self::popularVenda($listagem[0]);
        }
    }

    public static function popularVenda($itemLista){
        $venda = new Venda();
        $venda->setId($itemLista['idvenda']);
        $venda->setDataVenda($itemLista['datavenda']);

        $venda->getCliente()->setId($itemLista['fk_idcliente']);
        $venda->getCliente()->setNome($itemLista['nome']);
        $venda->getCliente()->setCpf($itemLista['cpf']);
        $venda->getCliente()->setEndereco($itemLista['endereco']);
        $venda->getCliente()->setTelefone($itemLista['telefone']);
        $venda->getCliente()->setEmail($itemLista['email']);


        $venda->getSituacao()->setId($itemLista['fk_idsituacao']);
        $venda->getSituacao()->setDescricao($itemLista['descricao']);

        return $venda;
    }
}