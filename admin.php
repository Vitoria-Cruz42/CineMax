<?php
include("conexao.php");

// CADASTRAR FILME
if(isset($_POST["salvar_filme"])){

    $nome = $_POST["nome"];
    $classificacao = $_POST["classificacao"];
    $sinopse = $_POST["sinopse"];
    $duracao = $_POST["duracao"];
    $bilheteria = $_POST["bilheteria"];
    $lancamento = $_POST["lancamento"];
    $genero = $_POST["genero"];
    $diretor = $_POST["diretor"];
    $foto = $_FILES["foto"]["name"];
    $status = $_POST["status"];

    move_uploaded_file($_FILES["foto"]["tmp_name"], "imagens/" . $foto);
    $sql = "INSERT INTO Filmes
    (nome_filme,classificacao,sinopse,duracao,bilheteria,data_lancamento,genero,diretor,foto_filme,status_filme)

    VALUES

    ('$nome','$classificacao','$sinopse','$duracao','$bilheteria','$lancamento','$genero','$diretor','$foto','$status')";

    mysqli_query($con,$sql);

}

// CADASTRAR SESSÃO

if(isset($_POST["salvar_sessao"])){

    $filme=$_POST["filme"];
    $sala=$_POST["sala"];
    $datahora=$_POST["datahora"];
    $audio=$_POST["audio"];
    $exibicao=$_POST["exibicao"];

    $sql="INSERT INTO Sessoes
    (id_filme,id_sala,data_hora,tipo_audio,tipo_exibicao)

    VALUES

    ('$filme','$sala','$datahora','$audio','$exibicao')";

    mysqli_query($con,$sql);

}

// adicionar sala

if(isset($_POST["cadastrarSala"]))
{
    $nomeSala = $_POST["nomeSala"];
    $qntCadeiras = $_POST["qntCadeiras"];
    $tipoSala = $_POST["tipoSala"];

    if($nomeSala == "" || $qntCadeiras == "" || $tipoSala == "")
    {
        echo "Preencha todos os campos.";
    }
    else
    {
        $sql = "INSERT INTO Salas(nome_sala, qnt_cadeiras, tipo)
                VALUES('$nomeSala','$qntCadeiras','$tipoSala')";

        if(mysqli_query($con,$sql))
        {
            echo "Sala cadastrada com sucesso!";
        }
        else
        {
            echo "Erro ao cadastrar sala.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Painel Administrativo</title>

<link rel="stylesheet" href="admincss.css">

</head>

<body>

<header>

<h1>Painel Administrativo</h1>

</header>

<main>

<section class="form-container">

<h2>Adicionar Filme</h2>

<form method="POST" enctype="multipart/form-data">

<div class="campo">
<label>Nome</label>
<input type="text" name="nome">
</div>

<div class="campo">
<label>Classificação</label>
<input type="text" name="classificacao">
</div>

<div class="campo">
<label>Sinopse</label>
<textarea name="sinopse"></textarea>
</div>

<div class="campo">
<label>Duração</label>
<input type="number" name="duracao">
</div>

<div class="campo">
<label>Bilheteria</label>
<input type="number" step="0.01" name="bilheteria">
</div>

<div class="campo">
<label>Data de lançamento</label>
<input type="date" name="lancamento">
</div>

<div class="campo">
<label>Gênero</label>
<input type="text" name="genero">
</div>

<div class="campo">
<label>Diretor</label>
<input type="text" name="diretor">
</div>

<div class="campo">
<label>Foto</label>
<input type="file" name="foto" accept="image/*">
</div>

<div class="campo">

<label>Status</label>

<select name="status">

<option>Em cartaz</option>

<option>Encerrado</option>

</select>

</div>

<button class="btn-adicionar" name="salvar_filme">

Salvar Filme

</button>

</form>

</section>

<section class="form-container">

<h2>Adicionar Sessão</h2>

<form method="POST">

<div class="campo">

<label>Filme</label>

<select name="filme">

<?php

$sql="SELECT * FROM Filmes";

$resultado=mysqli_query($con,$sql);

while($filme=mysqli_fetch_array($resultado))
{

?>

<option value="<?php echo $filme["id_filme"];?>">

<?php echo $filme["nome_filme"];?>

</option>

<?php
}
?>

</select>

</div>

<div class="campo">

<label>Sala</label>

<select name="sala">

<?php

$sql="SELECT * FROM Salas";

$resultado=mysqli_query($con,$sql);

while($sala=mysqli_fetch_array($resultado))
{

?>

<option value="<?php echo $sala["id_sala"];?>">

<?php echo $sala["nome_sala"];?>

</option>

<?php
}
?>

</select>

</div>

<div class="campo">

<label>Data e Hora</label>

<input type="datetime-local" name="datahora">

</div>

<div class="campo">

<label>Tipo de Áudio</label>

<select name="audio">

<option>Dublado</option>

<option>Legendado</option>

</select>

</div>

<div class="campo">

<label>Tipo de Exibição</label>

<select name="exibicao">

<option>2D</option>

<option>3D</option>

</select>

</div>

<button class="btn-adicionar" name="salvar_sessao">

Salvar Sessão

</button>

</form>

</section>

<section class="form-container">

    <h2>Adicionar Sala</h2>

    <form action="" method="POST">

        <div class="campo">
            <label>Nome da Sala</label>
            <input type="text" name="nomeSala" placeholder="Ex: Sala 6">
        </div>

        <div class="campo">
            <label>Quantidade de Cadeiras</label>
            <input type="number" name="qntCadeiras" placeholder="150">
        </div>

        <div class="campo">
            <label>Tipo</label>

            <select name="tipoSala">

                <option value="">Selecione</option>

                <option value="comum">Comum</option>

                <option value="premium">Premium</option>

            </select>

        </div>

        <button type="submit" name="cadastrarSala" class="btn-adicionar">

            Salvar Sala

        </button>

    </form>

</section>
<section class="lista">

    <h2>Filmes Cadastrados</h2>

    <table>

        <thead>
            <tr>
                <th>Nome</th>
                <th>Gênero</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

        <?php

        $sql = "SELECT * FROM Filmes";
        $resultado = mysqli_query($con,$sql);

        while($filme = mysqli_fetch_array($resultado))
        {
        ?>

            <tr>

                <td><?php echo $filme["nome_filme"]; ?></td>

                <td><?php echo $filme["genero"]; ?></td>

                <td><?php echo $filme["status_filme"]; ?></td>

                <td>
                    <a href="editarfilme.php?id=<?php echo $filme["id_filme"]; ?>">
                        <button class="editar">Editar</button>
                    </a>

                    <a href="removerfilme.php?id=<?php echo $filme["id_filme"]; ?>">
                        <button class="remover">Remover</button>
                    </a>
                </td>

            </tr>

        <?php
        }
        ?>

        </tbody>

    </table>

</section>
<section class="lista">

    <h2>Sessões Cadastradas</h2>

    <table>

        <thead>
            <tr>
                <th>Filme</th>
                <th>Sala</th>
                <th>Horário</th>
                <th>Áudio</th>
                <th>Exibição</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

        <?php

        $sql2 = "SELECT Sessoes.*, Filmes.nome_filme, Salas.nome_sala
                 FROM Sessoes
                 INNER JOIN Filmes ON Filmes.id_filme = Sessoes.id_filme
                 INNER JOIN Salas ON Salas.id_sala = Sessoes.id_sala";

        $resultado2 = mysqli_query($con,$sql2);

        while($sessao = mysqli_fetch_array($resultado2))
        {
        ?>

            <tr>

                <td><?php echo $sessao["nome_filme"]; ?></td>

                <td><?php echo $sessao["nome_sala"]; ?></td>

                <td><?php echo $sessao["data_hora"]; ?></td>

                <td><?php echo $sessao["tipo_audio"]; ?></td>

                <td><?php echo $sessao["tipo_exibicao"]; ?></td>

                <td>
                    <a href="editarsessao.php?id=<?php echo $sessao["id_sessao"]; ?>">
                        <button class="editar">Editar</button>
                    </a>

                    <a href="removersessao.php?id=<?php echo $sessao["id_sessao"]; ?>">
                        <button class="remover">Remover</button>
                    </a>
                </td>

            </tr>

        <?php
        }
        ?>

        </tbody>

    </table>

</section>
<section class="lista">

    <h2>Salas Cadastradas</h2>

    <table>

        <thead>
            <tr>
                <th>Nome</th>
                <th>Cadeiras</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

        <?php

        $sql3 = "SELECT * FROM Salas";
        $resultado3 = mysqli_query($con,$sql3);

        while($sala = mysqli_fetch_array($resultado3))
        {
        ?>

            <tr>

                <td><?php echo $sala["nome_sala"]; ?></td>

                <td><?php echo $sala["qnt_cadeiras"]; ?></td>

                <td><?php echo $sala["tipo"]; ?></td>

                <td>
                    <a href="editarsala.php?id=<?php echo $sala["id_sala"]; ?>">
                        <button class="editar">Editar</button>
                    </a>

                    <a href="removersala.php?id=<?php echo $sala["id_sala"]; ?>">
                        <button class="remover">Remover</button>
                    </a>
                </td>

            </tr>

        <?php
        }
        ?>

        </tbody>

    </table>

</section>