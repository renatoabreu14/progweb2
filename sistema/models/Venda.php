<?php
require_once "Cliente.php";

class Venda
{
    private $id;
    private $cliente;
    private $dataVenda;

    /**
     * Venda constructor.
     * @param $cliente
     */
    public function __construct()
    {
        $this->cliente = new Cliente();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * @return mixed
     */
    public function getDataVenda()
    {
        return $this->dataVenda;
    }

    /**
     * @param mixed $dataVenda
     */
    public function setDataVenda($dataVenda)
    {
        $this->dataVenda = $dataVenda;
    }


}