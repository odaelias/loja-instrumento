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
<body>
    <nav>
        <a href="./entrar.html">Voltar</a>
    </nav>
    <main>
        <h1>Recuperação de senha</h1>
        <span>Enviaremos uma nova senha ao e-mail indicado abaixo</span>
        <form action="" method="post">
            <label for="eml-email">E-mail</label>
            <input type="email" name="email" id="eml-email" required>
            <input type="submit" value="Enviar nova senha">
        </form>
        <?php
            if(isset($_POST['email'])){
                if($qtdEmail["cntEmail"]>=1){
                    echo "Sua nova senha é: ".$random;
                } else{
                    echo "E-mail não cadastrado";
                }  
            }
        ?>
    </main>
</body>
</html>