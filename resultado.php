<?php

include("conexao.php");

if(isset($_GET["filtro"]))
{

    $filtro = $_GET["filtro"];

    $sql = "SELECT *
            FROM Filmes
            WHERE nome_filme LIKE '$filtro%'
            OR genero LIKE '$filtro%'";

    $resultado = mysqli_query($con,$sql);

    while($filme = mysqli_fetch_array($resultado))
    {
?>

<div class="cartaz">

<a href="filme.php?id=<?php echo $filme["id_filme"]; ?>">

<div class="poster">

<img src="imagens/<?php echo $filme["foto_filme"]; ?>">

</div>

<h3>

<?php echo $filme["nome_filme"]; ?>

</h3>

</a>

</div>

<?php

    }

}

?>