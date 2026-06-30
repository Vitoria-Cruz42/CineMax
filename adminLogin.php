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

    $email_adm = $_POST["email"];
    $senha_adm = $_POST["senha"];

    $sql = "SELECT * FROM Administradores
            WHERE email_adm = '$email_adm' AND senha_adm = '$senha_adm'";

    $resultado = mysqli_query($con, $sql);

    if (mysqli_num_rows($resultado) == 1) {

        $_SESSION["usuario"] = $email_adm;

        header("Location: admin.php");
        exit();

    }else{
        $erro = "Conta ou senha inválidos!";
    } 
}
?>

<body>

    <div class="container">
        <div class="login-box">
            <h1>CineMax</h1>
            <h2>Bem-vindo de volta Administrador!</h2>

            <form action="adminLogin.php" method="POST">

                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
                </div>

                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                </div>

                <button type="submit" name="entrar">Entrar</button>

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