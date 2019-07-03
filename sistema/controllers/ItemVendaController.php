<?php
require_once "../models/ItemVenda.php";
require_once "Conexao.php";

class ItemVendaController
{

    public static function inserir(ItemVenda $itemVenda){
        $sql = "INSERT INTO itemvenda (fk_idvenda, fk_idlivro, quantidade, valorlivro) 
                VALUES (:idvenda, :idlivro, :quantidade, :valorlivro)";

        $db = Conexao::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':idvenda', $itemVenda->getVenda()->getId());
        $stmt->bindValue(':idlivro', $itemVenda->getLivro()->getId());
        $stmt->bindValue(':quantidade', $itemVenda->getQuantidade());
        $stmt->bindValue(':valorlivro', $itemVenda->getValorProduto());

        $stmt->execute();

        return "OK";
    }
}