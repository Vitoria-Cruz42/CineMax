<?php

include("conexao.php");

$id = $_GET["id"];

$sql = "DELETE FROM Sessoes WHERE id_sessao=$id";

if(mysqli_query($con,$sql))
{
    echo "<script>
            alert('Sessao removida com sucesso');
            window.location='admin.php';
          </script>";
}
else
{
    echo "<script>
            alert('Nao foi possivel remover a sessao');
            window.location='admin.php';
          </script>";
}

?>