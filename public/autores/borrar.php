<?php


if(!isset($_POST['id'])){
    header("Location:index.php");
    die();
}

require dirname(__DIR__)."/../vendor/autoload.php";
session_start();
use Src\Autores;

(new Autores)->delete($_POST['id']);
$_SESSION['mensaje']="Autor borrado con exito!!";
header("Location:index.php");
