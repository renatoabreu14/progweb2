<?php
require_once "Livro.php";

class ItemCarrinho
{
    private $livro;
    private $quantidade;

    /**
     * ItemCarrinho constructor.
     * @param $livro
     */
    public function __construct()
    {
        $this->livro = new Livro();
    }

    /**
     * @return Livro
     */
    public function getLivro()
    {
        return $this->livro;
    }

    /**
     * @param Livro $livro
     */
    public function setLivro($livro)
    {
        $this->livro = $livro;
    }

    /**
     * @return mixed
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @param mixed $quantidade
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

}