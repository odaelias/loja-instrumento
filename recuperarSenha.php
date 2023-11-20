<?php
require_once("db/conexao.php");

if(isset($_POST['email'])){
$random= bin2hex(random_bytes(3));
$email= $_POST['email'];
$nova= password_hash($random, PASSWORD_DEFAULT);
$sql= "UPDATE Usuario SET usr_senha='$nova' WHERE usr_email='$email'";
$query= mysqli_query($dbConexao, $sql);

$selectEmail= "SELECT COUNT(usr_email) AS cntEmail FROM Usuario WHERE usr_email = '$email'";
$queryEmail= mysqli_query($dbConexao, $selectEmail);
$qtdEmail= mysqli_fetch_assoc($queryEmail);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/music-svgrepo-com.svg" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <title>Recuperação de senha | Grandíssimo</title>
</head>
<body class="recuperarsenha">
    <main>
        <h2>Recuperação de senha</h2>
        <span>Enviaremos uma nova senha ao e-mail indicado abaixo</span>
        <form action="" method="post">
            <section>
                <label for="eml-email">E-mail</label>
                <input type="email" name="email" id="eml-email" required>
            </section>
            <section>
                <input type="submit" value="Enviar nova senha">
            </section>
        </form>
        <section>
            <?php
                if(isset($_POST['email'])){
                    if($qtdEmail["cntEmail"]>=1){
                        echo "Sua nova senha é: ".$random;
                    } else{
                        echo "E-mail não cadastrado!";
                    }  
                }
            ?>
        </section>
        <section>
            <a href="./entrar.html">Voltar</a>
        </section>
    </main>
</body>
</html>