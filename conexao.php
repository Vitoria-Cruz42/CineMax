<?php

$servidor = "localhost";
$usuario = "root";
$senha = "usbw";
$banco = "cinema";

$con = mysqli_connect($servidor, $usuario, $senha, $banco);
mysqli_set_charset($con, "utf8");

if (!$con){
    die("Erro na conexão");
    }

?>