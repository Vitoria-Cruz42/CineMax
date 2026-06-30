<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineMax - Cadastro</title>
    <link rel="stylesheet" href="cadastrocss.css">
</head>

<?php
    include("conexao.php");

    if (isset($_POST["nome"])) {

        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $tel = $_POST["tel"];
        $cpf = $_POST["cpf"];
        $senha = $_POST["senha"];

        if ($nome == "" || $email == "" || $tel == "" || $cpf == "" || $senha == "") {
            echo "Preencha todos os campos.";
        } else {

            $sql = "INSERT INTO Clientes(nome_cliente,email,telefone,cpf,senha)
                    VALUES('$nome','$email','$tel','$cpf','$senha')";
            if (mysqli_query($con, $sql)) {
                header("Location: inicio.php");
                exit();
            } else {
                echo "Erro: " . mysqli_error($con);
            }
        }
    }
?>
<body>

    <div class="container">
        <div class="cadastro">
            <h1>CineMax</h1>
            <h2>Crie sua conta</h2>

            <form action="cadastro.php" method="POST">
                <div class="inputGroup">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
                </div>

                <div class="inputGroup">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
                </div>

                <div class="inputGroup">
                    <label for="telefone">Telefone</label>
                    <input type="text" id="tel" name="tel" required>
                </div>

                <div class="inputGroup">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" required>
                </div>

                <div class="inputGroup">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Crie uma senha" required>
                </div>

                <button type="submit">Cadastrar</button>

                <p class="loginLink">
                    Já possui conta?
                    <a href="login.php">Entrar</a>
                </p>
            </form>
        </div>
    </div>

</body>
</html>