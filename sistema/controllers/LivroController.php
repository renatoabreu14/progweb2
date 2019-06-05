<?php

require_once 'Conexao.php';
require_once '../models/Livro.php';


class LivroController{

    public static function salvar(Livro $livro){
        if ($livro->getId() > 0){
            return self::alterar($livro);
        }else{
            return self::inserir($livro);
        }
    }

    private static function inserir(Livro $livro){
        $sql = "INSERT INTO livro (titulo, descricao, autor, idgenero, ideditora, valor, ano, capa) VALUES (:titulo, :descricao, :autor, :idgenero, :ideditora, :valor, :ano, :capa)";

        $db = Conexao::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':titulo', $livro->getTitulo());
        $stmt->bindValue(':descricao', $livro->getDescricao());
        $stmt->bindValue(':autor', $livro->getAutor());
        $stmt->bindValue(':idgenero', $livro->getGenero()->getId());
        $stmt->bindValue(':ideditora', $livro->getEditora()->getId());
        $stmt->bindValue(':valor', $livro->getValor());
        $stmt->bindValue(':ano', $livro->getAno());
        $stmt->bindValue(':capa', $livro->getCapaImagem());

        $stmt->execute();

        return "OK";
    }

    private static function alterar(Livro $livro){
        $sql = "UPDATE livro SET titulo=:titulo, descricao=:descricao, 
    autor=:autor, idgenero=:idgenero, ideditora=:ideditora, 
    valor=:valor, ano=:ano, capa=:capa WHERE id=:id";

        $db = Conexao::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':titulo', $livro->getTitulo());
        $stmt->bindValue(':descricao', $livro->getDescricao());
        $stmt->bindValue(':autor', $livro->getAutor());
        $stmt->bindValue(':idgenero', $livro->getGenero()->getId());
        $stmt->bindValue(':ideditora', $livro->getEditora()->getId());
        $stmt->bindValue(':valor', $livro->getValor());
        $stmt->bindValue(':ano', $livro->getAno());
        $stmt->bindValue(':capa', $livro->getCapaImagem());
        $stmt->bindValue(':id', $livro->getId());

        $stmt->execute();

        return "OK";
    }

    public static function excluir($id){
        $sql = "DELETE FROM livro WHERE id = :id";
        $db = Conexao::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public static function trazerTodos(){
        $sql = "SELECT l.*, g.nome AS genero, e.nome AS editora FROM livro l INNER JOIN genero g ON g.id = l.idgenero INNER JOIN editora e ON e.id = l.ideditora";
        $db = Conexao::getInstance();
        $stmt = $db->query($sql);
        $listagem = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $arrRetorno = array();
        foreach ($listagem as $itemLista){
            $arrRetorno[] = self::popularLivro($itemLista);
        }
        return $arrRetorno;
    }

    public static function trazerTodosPorGenero($genero){
        $sql = "SELECT l.*, g.nome AS genero, e.nome AS editora FROM livro l INNER JOIN genero g ON g.id = l.idgenero INNER JOIN editora e ON e.id = l.ideditora WHERE l.idgenero = :genero";
        $db = Conexao::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':genero', $genero);
        $stmt->execute();
        $listagem = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $arrRetorno = array();
        foreach ($listagem as $itemLista){
            $arrRetorno[] = self::popularLivro($itemLista);
        }
        return $arrRetorno;
    }

    private static function popularLivro($itemLista){
        $livro = new Livro();
        $livro->setId($itemLista['id']);
        $livro->setTitulo($itemLista['titulo']);
        $livro->setDescricao($itemLista['descricao']);
        $livro->setAutor($itemLista['autor']);
        $livro->setValor($itemLista['valor']);
        $livro->setAno($itemLista['ano']);
        $livro->getGenero()->setId($itemLista['idgenero']);
        $livro->getGenero()->setNome($itemLista['genero']);
        $livro->getEditora()->setId($itemLista['ideditora']);
        $livro->getEditora()->setNome($itemLista['editora']);
        $livro->setCapaImagem($itemLista['capa']);

        return $livro;
    }

    public static function buscarLivro($id){
        $sql = "SELECT l.*, g.nome AS genero, e.nome AS editora FROM livro l INNER JOIN genero g ON g.id = l.idgenero INNER JOIN editora e ON e.id = l.ideditora WHERE l.id = :id";
        $db = Conexao::getInstance();

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $listagem = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($listagem) > 0){
            return self::popularLivro($listagem[0]);
        }
    }

}