<?php

require_once "../controllers/LivroController.php";

$livro = new Livro();

if (isset($_GET['id'])){
    $livro = LivroController::buscarLivro($_GET['id']);
}

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <!--Menu-->
            <?php
            include_once "menu.php";
            ?>
        </div>

        <div class="col-md-10">
            <!--Conteúdo-->
            <h2>Dados do Livro</h2>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-1"><b>Título:</b></div>
                    <div class="col-md-7"><?php echo $livro->getTitulo();?></div>
                    <div class="col-md-1"><b>Ano:</b></div>
                    <div class="col-md-3"><?php echo $livro->getAno();?></div>
                </div>
                <div class="row">
                    <div class="col-md-1"><b>Autor:</b></div>
                    <div class="col-md-7"><?php echo $livro->getAutor();?></div>
                    <div class="col-md-1"><b>Valor:</b></div>
                    <div class="col-md-3"><?php echo $livro->getValor();?></div>
                </div>
                <div class="row">
                    <div class="col-md-1"><b>Descrição:</b></div>
                    <div class="col-md-11"><?php echo $livro->getDescricao();?></div>
                </div>
                <div class="row">
                    <div class="col-md-1"><b>Genero:</b></div>
                    <div class="col-md-5"><?php echo $livro->getGenero()->getNome();?></div>
                    <div class="col-md-1"><b>Editora:</b></div>
                    <div class="col-md-5"><?php echo $livro->getEditora()->getNome();?></div>
                </div>
            </div>
            <a href="listaLivros.php" class="btn btn-primary">Voltar</a>
        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>