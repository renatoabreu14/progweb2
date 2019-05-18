<?php
session_start();
if (isset($_SESSION['user'])){
    header("Location: sistema/views/listaLivros.php");
}else{
    header("Location: sistema/views/login.php");
}
