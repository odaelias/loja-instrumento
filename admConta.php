<?php session_start();
require_once("db/conexao.php");

if(isset($_SESSION['login'])){
    $idRestrito= $_SESSION['login'];
    $sqlRestrito="SELECT usr_funcao FROM Usuario WHERE usr_id = '$idRestrito';";
    $queryRestrito= mysqli_query($dbConexao, $sqlRestrito);
    $restrito= mysqli_fetch_array($queryRestrito);
    $usrFuncao = $restrito['usr_funcao'];
    if($usrFuncao <> 1){
        header("Location: ./index.php");
    }
} else{
    header("Location: ./index.php");
}

$id= $_SESSION['login'];
$sql="SELECT * FROM Usuario WHERE usr_id = '$id';";
$query= mysqli_query($dbConexao, $sql);
$usuario= mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/violin-svgrepo-com.svg" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <title>Gerenciar esta conta</title>
</head>
<body class="admconta">
    <header>
        <?php
            include('./admHeader.php');
        ?>
    </header>
    <main>
        <h1>Esta conta</h1>
        <hr>
        <form action="./php/edit.php" method="post">

            <input type="hidden" name="pagina" value="4">

            <input type="hidden" name="id"  value="<?=$usuario['usr_id']?>">

            <h2>Informações pessoais</h2>

            <section>
                <label for="txt-cpf">CPF</label>
                <input type="text" name="cpf" id="txt-cpf" value="<?=$usuario['usr_cpf']?>" minlength="11" maxlength="11" required>
            </section>

            <section>
                <label for="txt-nome">Nome completo</label>
                <input type="text" name="nome" id="txt-nome" value="<?=$usuario['usr_nome']?>" minlength="5" maxlength="30" required>
            </section>

            <h2>Conta</h2>

            <section>
                <label for="eml-email">E-mail</label>
                <input type="email" name="email" id="eml-email" value="<?=$usuario['usr_email']?>" required>
            </section>
            
            <section><a href="./alterarSenha.php">Alterar senha</a></section>
            
            <h2>Confirmação de identidade</h2>
            <section>
                <label for="psw-senha">Senha atual</label>
                <input type="password" name="senha" id="psw-senha" minlength="6" maxlength="20" required>

                <label for="olhoMagico" class="olhoMagico"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg></label>
                <input type="checkbox" id="olhoMagico" class="olhoMagico" style="display: none">
            </section>
            
            <section><input type="submit" value="Atualizar"></section>
            
        </form>
    </main>
    <script src="./js/script.js"></script>
</body>
</html>