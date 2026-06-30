<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineMax - Login</title>
    <link rel="stylesheet" href="logincss.css">
</head>
<?php
include("conexao.php");

session_start();

$erro = "";

if (isset($_POST["email"]) && isset($_POST["senha"])) {

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM Clientes
            WHERE email = '$email' AND senha = '$senha'";

    $resultado = mysqli_query($con, $sql);

    if (mysqli_num_rows($resultado) == 1) {

        $cliente = mysqli_fetch_array($resultado);

        $_SESSION["usuario"] = $email;
        $_SESSION["id_cliente"] = $cliente["id_cliente"];

        header("Location: inicio.php");
        exit();

    } else {

        $erro = "Conta ou senha inválidos!";

    }
}
?>

<body>

    <div class="container">
        <div class="login-box">
            <h1>CineMax</h1>
            <h2>Bem-vindo de volta</h2>

            <form action="login.php" method="POST">

                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
                </div>

                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                </div>

                <button type="submit" name="entrar">Entrar</button>

                <p class="cadastro-link">
                    Não possui conta?
                    <a href="cadastro.php">Cadastre-se</a>
                </p>

            </form>
            <?php
                if($erro != "")
                {
                    echo "<p style='color:white; text-align:center; margin-top:15px;'>$erro</p>";
                }
            ?>
        </div>
    </div>
</body>
</html>