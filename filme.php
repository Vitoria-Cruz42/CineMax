<?php
    date_default_timezone_set("America/Sao_Paulo");
    
    include("conexao.php");

    $id = $_GET["id"];

    // Filme
    $sql = "SELECT * FROM Filmes WHERE id_filme = $id";
    $resultado = mysqli_query($con, $sql);
    $filme = mysqli_fetch_array($resultado);

    // Sessões
    $sql2 = "SELECT Sessoes.*, Salas.nome_sala
            FROM Sessoes
            INNER JOIN Salas
            ON Sessoes.id_sala = Salas.id_sala
            WHERE id_filme = $id";

    $resultado2 = mysqli_query($con, $sql2);
    ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $filme["nome_filme"]; ?> - CineMax</title>
    <link rel="stylesheet" href="filmecss.css">
</head>
<body>

<header>

    <div class="logo">CineMax</div>
    <div class="nav">
        <a href="inicio.php">Voltar</a>
    </div>

</header>

<main>

    <section class="filme-info">

        <div class="poster">
            <img src="imagens/<?php echo $filme["foto_filme"]; ?>" width="250">
        </div>

        <div class="detalhes">

            <h1><?php echo $filme["nome_filme"]; ?></h1>

            <p class="sinopse">
                <?php echo $filme["sinopse"]; ?>
            </p>

            <div class="dados">

                <p><strong>Gênero:</strong> <?php echo $filme["genero"]; ?></p>

                <p><strong>Duração:</strong> <?php echo $filme["duracao"]; ?> minutos</p>

                <p><strong>Classificação:</strong> <?php echo $filme["classificacao"]; ?></p>

                <p><strong>Diretor:</strong> <?php echo $filme["diretor"]; ?></p>

                <p><strong>Lançamento:</strong> <?php echo $filme["data_lancamento"]; ?></p>

            </div>

        </div>

    </section>

    <section class="sessoes">

        <h2>Sessões Disponíveis</h2>

        <?php
        while($sessao = mysqli_fetch_array($resultado2))
        {
        ?>

        <div class="sala">

            <h3>
                <?php echo $sessao["nome_sala"]; ?>
                - <?php echo $sessao["tipo_exibicao"]; ?>
                <br> <br>
                <?php echo date("d/m/y", strtotime($sessao["data_hora"]));?>
            </h3>

            <div class="horarios">

                <a href="reserva.php?id=<?php echo $sessao["id_sessao"]; ?>" class="botao">
                    <?php
                    echo date("H:i", strtotime($sessao["data_hora"]));
                    ?>
                </a>

            </div>

            <p class="preco">

                Áudio:
                <span><?php echo $sessao["tipo_audio"]; ?></span>

            </p>

        </div>

        <?php
        }
        ?>

    </section>

</main>

</body>
</html>