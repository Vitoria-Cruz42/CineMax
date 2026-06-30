<?php
include("conexao.php");

$id = $_GET["id"];

$sql = "SELECT * FROM Sessoes WHERE id_sessao=$id";
$resultado = mysqli_query($con,$sql);
$sessao = mysqli_fetch_array($resultado);

if(isset($_POST["salvar"]))
{
    $filme = $_POST["filme"];
    $sala = $_POST["sala"];
    $data = $_POST["data"];
    $audio = $_POST["audio"];
    $exibicao = $_POST["exibicao"];

    $sql = "UPDATE Sessoes SET

    id_filme='$filme',
    id_sala='$sala',
    data_hora='$data',
    tipo_audio='$audio',
    tipo_exibicao='$exibicao'

    WHERE id_sessao=$id";

    mysqli_query($con,$sql);

    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Sessão</title>
    <link rel="stylesheet" href="editarcss.css">
</head>
<body>

    <header>
        <div class="logo">CineMax</div>
        </div>
    </header>

    <main>

        <section class="form-container">

            <h2>Editar Sessão</h2>

            <form method="POST">

            <label>Filme</label>

            <select name="filme">

            <?php

            $sqlFilmes = "SELECT * FROM Filmes";
            $resultadoFilmes = mysqli_query($con, $sqlFilmes);

            while($filme = mysqli_fetch_array($resultadoFilmes))
            {
            ?>

            <option
            value="<?php echo $filme["id_filme"]; ?>"

            <?php
            if($filme["id_filme"] == $sessao["id_filme"])
            {
                echo "selected";
            }
            ?>

            >

            <?php echo $filme["nome_filme"]; ?>

            </option>

            <?php
            }
            ?>

            </select>

            <br><br>

            <label>Sala</label>

            <select name="sala">

            <?php

            $sqlSalas = "SELECT * FROM Salas";
            $resultadoSalas = mysqli_query($con, $sqlSalas);

            while($sala = mysqli_fetch_array($resultadoSalas))
            {
            ?>

            <option
            value="<?php echo $sala["id_sala"]; ?>"

            <?php
            if($sala["id_sala"] == $sessao["id_sala"])
            {
                echo "selected";
            }
            ?>

            >

            <?php echo $sala["nome_sala"]; ?>

            </option>

            <?php
            }
            ?>

            </select>
            <br><br>

            <label>Data e Hora</label>
            <input type="datetime-local" name="data" value="<?php echo date("Y-m-d\TH:i",strtotime($sessao["data_hora"])); ?>">

            <br><br>

            <label>Áudio</label>
            <input type="text" name="audio" value="<?php echo $sessao["tipo_audio"]; ?>">

            <br><br>

            <label>Exibição</label>
            <input type="text" name="exibicao" value="<?php echo $sessao["tipo_exibicao"]; ?>">

            <br><br>

            <button type="submit" name="salvar">
            Salvar
            </button>

            </form>

        </section>

    </main>

</body>
</html>