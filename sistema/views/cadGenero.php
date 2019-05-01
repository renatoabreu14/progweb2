<?php
require_once "../models/Genero.php";
require_once "../controllers/GeneroController.php";

$genero = new Genero();

if (isset($_GET['id'])){
    $genero = GeneroController::buscarGenero($_GET['id']);
}

if(isset($_POST['salvar'])){
    $genero->setId($_POST['id']);
    $genero->setNome($_POST['nome']);

    GeneroController::salvar($genero);
    header('Location:listaGeneros.php');
    //echo var_dump($cliente);
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
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Cadastro de generos</h3>
                </div>
                <div class="card-body">
                    <form action="cadGenero.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $genero->getId();?>">
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="">Nome</label>
                                <input type="text" class="form-control" placeholder="Nome" name="nome" value="<?php echo $genero->getNome();?>">
                            </div>
                            <button class="btn btn-primary" type="submit" name="salvar">Salvar</button>
                        </div><!--form-row-->
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>