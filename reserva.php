<?php
include("conexao.php");
session_start();

date_default_timezone_set("America/Sao_Paulo");

$idSessao = $_GET["id"];

// Busca informações da sessão
$sql = "SELECT Sessoes.*, Filmes.nome_filme, Filmes.foto_filme,
               Salas.tipo
        FROM Sessoes
        INNER JOIN Filmes ON Filmes.id_filme = Sessoes.id_filme
        INNER JOIN Salas ON Salas.id_sala = Sessoes.id_sala
        WHERE id_sessao = $idSessao";

$resultado = mysqli_query($con,$sql);

$sessao = mysqli_fetch_array($resultado);

// Descobre os preços conforme o tipo da sala
$tipoSala = $sessao["tipo"];

$sql = "SELECT * FROM Ingressos
        WHERE tipo_sala='$tipoSala'
        AND tipo_ingresso='Inteira'";

$resultado = mysqli_query($con,$sql);
$inteira = mysqli_fetch_array($resultado);

$precoInteira = $inteira["preco"];
$idInteira = $inteira["id_ingresso"];

$sql = "SELECT * FROM Ingressos
        WHERE tipo_sala='$tipoSala'
        AND tipo_ingresso='Meia'";

$resultado = mysqli_query($con,$sql);
$meia = mysqli_fetch_array($resultado);

$precoMeia = $meia["preco"];
$idMeia = $meia["id_ingresso"];

// Salvar reserva
if(isset($_POST["reservar"]))
{

    $qtdInteira = $_POST["inteira"];
    $qtdMeia = $_POST["meia"];

    $idCliente = $_SESSION["id_cliente"];

    $dataReserva = date("Y-m-d H:i:s");

    for($i=0;$i<$qtdInteira;$i++)
    {
        $sql = "INSERT INTO Reservas
        (id_cliente,id_sessao,id_ingresso,data_reserva)

        VALUES

        ('$idCliente','$idSessao','$idInteira','$dataReserva')";

        mysqli_query($con,$sql);
    }

    for($i=0;$i<$qtdMeia;$i++)
    {
        $sql = "INSERT INTO Reservas
        (id_cliente,id_sessao,id_ingresso,data_reserva)

        VALUES

        ('$idCliente','$idSessao','$idMeia','$dataReserva')";

        mysqli_query($con,$sql);
    }

    echo "<script>
            alert('Reserva realizada com sucesso!');
            window.location='pesquisa.php';
          </script>";

}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Reserva</title>

<link rel="stylesheet" href="reservacss.css">

</head>

<body>

<header>

<div class="logo">CineMax</div>

<div class="nav">
<a href="filme.php?id=<?php echo $sessao["id_filme"]; ?>">Voltar</a>
</div>

</header>

<main>

<section class="form-container">

<h2>Reservar Filme</h2>

<p><strong>Filme:</strong> <?php echo $sessao["nome_filme"]; ?></p>

<p>

<strong>Data:</strong>

<?php

$data = strtotime($sessao["data_hora"]);
echo date("d/m/Y",$data);

?>

</p>

<p>

<strong>Horário:</strong>

<?php

echo date("H:i",$data);

?>

</p>

<p>

<strong>Exibição:</strong>

<?php echo $sessao["tipo_exibicao"]; ?>

</p>

<p>

<strong>Sala:</strong>

<?php echo ucfirst($sessao["tipo"]); ?>

</p>

<br>

<form method="POST">

<div class="campo">

<h3>Quantidade de ingressos</h3>

<br>

<label>

Inteira
(R$ <?php echo number_format($precoInteira,2,",","."); ?>)

</label>

<select name="inteira" id="inteira">

<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>

</select>

<br><br>

<label>

Meia
(R$ <?php echo number_format($precoMeia,2,",","."); ?>)

</label>

<select name="meia" id="meia">

<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>

</select>

</div>

<br>

<div class="campo">

<label>Preço Total</label>

<input
type="text"
id="preco"
readonly>

</div>

<br>

<button
type="submit"
name="reservar"
class="btn-adicionar">

Salvar Reserva

</button>

</form>

</section>

</main>
<script>

const inteira = document.getElementById("inteira");
const meia = document.getElementById("meia");
const preco = document.getElementById("preco");

const valorInteira = <?php echo $precoInteira; ?>;
const valorMeia = <?php echo $precoMeia; ?>;

function calcularPreco()
{
    let qtdInteira = parseInt(inteira.value);
    let qtdMeia = parseInt(meia.value);

    let total = (qtdInteira * valorInteira) +
                (qtdMeia * valorMeia);

    preco.value = "R$ " + total.toFixed(2).replace(".", ",");
}

inteira.addEventListener("change", calcularPreco);
meia.addEventListener("change", calcularPreco);

// Calcula quando a página abre
calcularPreco();

</script>

</body>
</html>