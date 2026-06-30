<?php
include("conexao.php");

$sql = "SELECT id_filme, nome_filme, foto_filme
        FROM Filmes
        WHERE status_filme = 'Em cartaz'";

$resultado = mysqli_query($con, $sql);

$sql2 = "SELECT id_filme, nome_filme, foto_filme
        FROM Filmes
        WHERE status_filme = 'Em breve'";

$resultado2 = mysqli_query($con, $sql2);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineMax - Início</title>
    <link rel="stylesheet" href="iniciocss.css">
</head>
<body>

<header>
    <div class="logo">CineMax</div>

    <div class="nav">
        <a href="adminLogin.php">Área do Administrador</a>
        <a href="pesquisa.php">Pesquisar</a>
    </div>
</header>

<section class="categoria">

    <h2>Filmes em Cartaz</h2>

    <div class="filmesGrid">

        <?php
        while($filme = mysqli_fetch_array($resultado))
        {
        ?>

        <div class="cartaz">

            <a href="filme.php?id=<?php echo $filme["id_filme"]; ?>">

                <div class="poster">
                    <img src="imagens/<?php echo $filme["foto_filme"]; ?>" alt="<?php echo $filme["nome_filme"]; ?>">
                </div>

                <h3><?php echo $filme["nome_filme"]; ?></h3>

            </a>

        </div>

        <?php
        }
        ?>

    </div>

</section>

<section class="categoria">

    <h2>Em breve</h2>

    <div class="filmesGrid">

        <?php
        while($filme = mysqli_fetch_array($resultado2))
        {
        ?>

        <div class="cartaz">

            <a href="filme.php?id=<?php echo $filme["id_filme"]; ?>">

                <div class="poster">
                    <img src="imagens/<?php echo $filme["foto_filme"]; ?>" alt="<?php echo $filme["nome_filme"]; ?>">
                </div>

                <h3><?php echo $filme["nome_filme"]; ?></h3>

            </a>

        </div>

        <?php
        }
        ?>

    </div>

</section>

</body>
</html>