<?php
    include("conexao.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CineMax - Pesquisa</title>

    <link rel="stylesheet" href="iniciocss.css">

    <script src="ajax.js"></script>
    <script src="chama.js"></script>

</head>
<body>

<header>
    <div class="logo">CineMax</div>

    <div class="nav">
        <a href="inicio.php">Início</a>
    </div>
</header>

<section class="categoria">

    <br><br>

    <h2>Pesquisar Filme (Por nome ou gênero)</h2>

    <br><br>

    <input
    type="text"
    id="pesquisa"
    placeholder="Digite o nome ou gênero"
    onkeyup="pesquisar()">

</section>
<section class="categoria">

    <div class="filmesGrid" id="resultado">

    </div>

</section>

<section class="categoria">

    <h2>Maiores Bilheterias por Período</h2>

    <form action="pesquisa.php" method="POST">

        <label>Data inicial:</label>
        <input type="date" name="inicio">

        <label>Data final:</label>
        <input type="date" name="fim">

        <button type="submit" name="buscarBilheteria">Buscar</button>

    </form>

</section>

<section class="categoria">
    <div class="filmesGrid">

        <?php

        if(isset($_POST["buscarBilheteria"]))
        {
            $inicio = $_POST["inicio"];
            $fim = $_POST["fim"];

            $sql = "SELECT *
                    FROM Filmes
                    WHERE data_lancamento BETWEEN '$inicio' AND '$fim'
                    ORDER BY bilheteria DESC
                    LIMIT 2";

            $resultado = mysqli_query($con,$sql);

            while($filme = mysqli_fetch_array($resultado))
            {
        ?>

        <div class="cartaz">

            <a href="filme.php?id=<?php echo $filme["id_filme"]; ?>">

                <div class="poster">
                    <img src="imagens/<?php echo $filme["foto_filme"]; ?>">
                </div>

                <h3><?php echo $filme["nome_filme"]; ?></h3>

            </a>

        </div>

        <?php
            }
        }
        ?>

    </div>

</section>

<section class="categoria">

    <h2>Filmes Reservados</h2>

    <div class="filmesGrid">

        <?php

            if(isset($_SESSION["id_cliente"]))
            {
                $id = $_SESSION["id_cliente"];

                $sql = "SELECT DISTINCT Filmes.*
                        FROM Filmes
                        INNER JOIN Sessoes ON Filmes.id_filme = Sessoes.id_filme
                        INNER JOIN Reservas ON Reservas.id_sessao = Sessoes.id_sessao
                        WHERE Reservas.id_cliente = $id";

                $resultado = mysqli_query($con,$sql);

                while($filme = mysqli_fetch_array($resultado))
                {
        ?>

        <div class="cartaz">

            <a href="filmereservado.php?id=<?php echo $filme["id_filme"]; ?>">

                <div class="poster">
                    <img src="imagens/<?php echo $filme["foto_filme"]; ?>">
                </div>

                <h3><?php echo $filme["nome_filme"]; ?></h3>

            </a>

        </div>

        <?php
                }
            }
        ?>

    </div>
</section>

</body>
</html>