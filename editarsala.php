<?php
include("conexao.php");

$id = $_GET["id"];

$sql = "SELECT * FROM Salas WHERE id_sala=$id";
$resultado = mysqli_query($con,$sql);
$sala = mysqli_fetch_array($resultado);

if(isset($_POST["salvar"]))
{
    $nome = $_POST["nome"];
    $cadeiras = $_POST["cadeiras"];
    $tipo = $_POST["tipo"];

    $sql = "UPDATE Salas SET

    nome_sala='$nome',
    qnt_cadeiras='$cadeiras',
    tipo='$tipo'

    WHERE id_sala=$id";

    mysqli_query($con,$sql);

    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="editarcss.css">

</head>

<body>

    <header>
        <div class="logo">CineMax</div>
    </header>

    <main>
        <section class="form-container">
            <h2>Editar Sala</h2>

            <form method="POST">

            <label>Nome</label>
            <input type="text" name="nome" value="<?php echo $sala["nome_sala"]; ?>">

            <br><br>

            <label>Quantidade de Cadeiras</label>
            <input type="number" name="cadeiras" value="<?php echo $sala["qnt_cadeiras"]; ?>">

            <br><br>

            <label>Tipo</label>
            <input type="text" name="tipo" value="<?php echo $sala["tipo"]; ?>">

            <br><br>

            <button type="submit" name="salvar">

            Salvar

            </button>

            </form>
        </section>
    </main>

</body>
</html>