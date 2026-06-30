<?php

    include("conexao.php");

    $id = $_GET["id"];

    $sql = "DELETE FROM Filmes WHERE id_filme=$id";

    if(mysqli_query($con,$sql))
    {
        echo "<script>
                alert('Filme removida com sucesso');
                window.location='admin.php';
            </script>";
    }
    else
    {
        echo "<script>
                alert('Nao foi possivel remover o filme');
                window.location='admin.php';
            </script>";
    }

    header("Location: admin.php");

?>