<?php
include("conexao.php");
session_start();

date_default_timezone_set("America/Sao_Paulo");
$idFilme = $_GET["id"];
$idCliente = $_SESSION["id_cliente"];

$sql = "SELECT Filmes.*,
               Sessoes.data_hora,
               Sessoes.tipo_audio,
               Sessoes.tipo_exibicao,
               Salas.nome_sala,
               Ingressos.tipo_ingresso,
               Ingressos.preco,
               Reservas.data_reserva

        FROM Reservas

        INNER JOIN Sessoes
        ON Reservas.id_sessao = Sessoes.id_sessao

        INNER JOIN Filmes
        ON Filmes.id_filme = Sessoes.id_filme

        INNER JOIN Salas
        ON Salas.id_sala = Sessoes.id_sala

        INNER JOIN Ingressos
        ON Ingressos.id_ingresso = Reservas.id_ingresso

        WHERE Reservas.id_cliente = $idCliente
        AND Filmes.id_filme = $idFilme";

$resultado = mysqli_query($con,$sql);

$reserva = mysqli_fetch_array($resultado);

$qtdInteira = 0;
$qtdMeia = 0;
$total = 0;

do
{
    if($reserva["tipo_ingresso"] == "Inteira")
    {
        $qtdInteira++;
    }
    else
    {
        $qtdMeia++;
    }

    $total = $total + $reserva["preco"];

}
while($reserva = mysqli_fetch_array($resultado));

// busca novamente a primeira reserva para mostrar os dados do filme

$resultado = mysqli_query($con,$sql);
$reserva = mysqli_fetch_array($resultado);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

<meta charset="UTF-8">

<title>Minha Reserva</title>

<link rel="stylesheet" href="filmecss.css">

</head>

<body>

<header>

<div class="logo">CineMax</div>

<div class="nav">
        <a href="pesquisa.php">Voltar</a>
</div>

</header>

<main>

<section class="filme-info">

<div class="poster">

<img src="imagens/<?php echo $reserva["foto_filme"]; ?>" width="250">

</div>

<div class="detalhes">

<h1><?php echo $reserva["nome_filme"]; ?></h1>

<p><?php echo $reserva["sinopse"]; ?></p>

<p><strong>Gênero:</strong> <?php echo $reserva["genero"]; ?></p>

<p><strong>Duração:</strong> <?php echo $reserva["duracao"]; ?> min</p>

<p><strong>Classificação:</strong> <?php echo $reserva["classificacao"]; ?></p>

</div>

</section>

<section class="sessoes">

<h2>Informações da Reserva</h2>

<p>

<strong>Sala:</strong>

<?php echo $reserva["nome_sala"]; ?>

</p>

<p>

<strong>Data:</strong>

<?php echo date("d/m/Y",strtotime($reserva["data_hora"])); ?>

</p>

<p>

<strong>Horário:</strong>

<?php echo date("H:i",strtotime($reserva["data_hora"])); ?>

</p>

<p>

<strong>Áudio:</strong>

<?php echo $reserva["tipo_audio"]; ?>

</p>

<p>

<strong>Exibição:</strong>

<?php echo $reserva["tipo_exibicao"]; ?>

</p>
<br>
<hr>

<p>

<strong>Ingressos Inteira:</strong>

<?php echo $qtdInteira; ?>

</p>

<p>

<strong>Ingressos Meia:</strong>

<?php echo $qtdMeia; ?>

</p>

<p>

<strong>Preço Total:</strong>

R$ <?php echo number_format($total,2,",","."); ?>

</p>

<p>

<strong>Data da Reserva:</strong>

<?php echo date("d/m/Y H:i",strtotime($reserva["data_reserva"])); ?>

</p>

</section>

</main>

</body>
</html>