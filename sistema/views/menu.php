<?php
require_once "../models/Cliente.php";
session_start();
if (isset($_SESSION['user'])){
    $cliente = new Cliente();
    $cliente = unserialize($_SESSION['user']);
    echo "Bem vindo ".$cliente->getNome()."<br>";
    echo "<a class='btn btn-primary' href='login.php?logout=true'>Sair</a>";
}else{
    header("Location: login.php");
}
?>
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link active" href="listaClientes.php">Gerenciar clientes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="listaEditoras.php">Gerenciar editoras</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="listaGeneros.php">Gerenciar generos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="listaLivros.php">Gerenciar livros</a>
    </li>
</ul>


<!--
Model Livro
id
titulo
descricao
autor
genero
editora
valor
ano
-->