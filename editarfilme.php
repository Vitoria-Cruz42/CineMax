<?php
    include("conexao.php");

    $id = $_GET["id"];

    $sql = "SELECT * FROM Filmes WHERE id_filme=$id";
    $resultado = mysqli_query($con,$sql);
    $filme = mysqli_fetch_array($resultado);

    if(isset($_POST["salvar"]))
    {
        $nome = $_POST["nome"];
        $classificacao = $_POST["classificacao"];
        $sinopse = $_POST["sinopse"];
        $duracao = $_POST["duracao"];
        $bilheteria = $_POST["bilheteria"];
        $data = $_POST["data"];
        $genero = $_POST["genero"];
        $diretor = $_POST["diretor"];
        $foto = $_FILES["foto"]["name"];
        $status = $_POST["status"];

        move_uploaded_file($_FILES["foto"]["tmp_name"], "imagens/" . $foto);
        $sql = "UPDATE Filmes SET

        nome_filme='$nome',
        classificacao='$classificacao',
        sinopse='$sinopse',
        duracao='$duracao',
        bilheteria='$bilheteria',
        data_lancamento='$data',
        genero='$genero',
        diretor='$diretor',
        foto_filme='$foto',
        status_filme='$status'

        WHERE id_filme=$id";

        mysqli_query($con,$sql);

        header("Location: admin.php");
    }
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Filme</title>
    <link rel="stylesheet" href="editarcss.css">

</head>

<body>

    <header>
        <div class="logo">CineMax</div>
    </header>

    <main>

        <section class="form-container">

        <h2>Editar Filme</h2>

        <form method="POST" enctype="multipart/form-data">

        <label>Nome</label>
        <input type="text" name="nome" value="<?php echo $filme["nome_filme"]; ?>">

        <br><br>

        <label>Classificação</label>
        <input type="text" name="classificacao" value="<?php echo $filme["classificacao"]; ?>">

        <br><br>

        <label>Sinopse</label>
        <textarea name="sinopse"><?php echo $filme["sinopse"]; ?></textarea>

        <br><br>

        <label>Duração</label>
        <input type="number" name="duracao" value="<?php echo $filme["duracao"]; ?>">

        <br><br>

        <label>Bilheteria</label>
        <input type="number" step="0.01" name="bilheteria" value="<?php echo $filme["bilheteria"]; ?>">

        <br><br>

        <label>Lançamento</label>
        <input type="date" name="data" value="<?php echo $filme["data_lancamento"]; ?>">

        <br><br>

        <label>Gênero</label>
        <input type="text" name="genero" value="<?php echo $filme["genero"]; ?>">

        <br><br>

        <label>Diretor</label>
        <input type="text" name="diretor" value="<?php echo $filme["diretor"]; ?>">

        <br><br>

        <label>Foto</label>
        <input type="file" name="foto" value="<?php echo $filme["foto_filme"]; ?>">

        <br><br>

        <label>Status</label>
        <select name="status">

        <option value="Em cartaz">Em cartaz</option>

        <option value="Encerrado">Encerrado</option>

        <option value="Em breve">Em breve</option>

        </select>

        <br><br>

        <button type="submit" name="salvar">

        Salvar

        </button>

        </form>

        </section>
    </main>

</body>

</html>