<?php

include("conexao.php");

$id = $_GET["id"];

$sql = "DELETE FROM Salas WHERE id_sala=$id";

if(mysqli_query($con,$sql))
{
    echo "<script>
            alert('Sala removida com sucesso');
            window.location='admin.php';
          </script>";
}
else
{
    echo "<script>
            alert('Nao foi possivel remover a sala');
            window.location='admin.php';
          </script>";
}


?>