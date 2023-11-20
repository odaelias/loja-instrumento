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

//TODOS ADMINISTRADORES
$sql="SELECT * FROM Usuario WHERE usr_funcao=1 AND usr_id <> 1 ORDER BY usr_nome";
$query= mysqli_query($dbConexao, $sql);

$sql1="SELECT usr_email, usr_id FROM Usuario WHERE usr_funcao=2 ORDER BY usr_email";
$query1= mysqli_query($dbConexao, $sql1);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/music-svgrepo-com.svg" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <title>Gerenciar usuários</title>
</head>
<body class="admusuario">
    <header>
        <?php
            include('./admHeader.php');
        ?>
    </header>
    <main>
        <h1>Gerenciar usuários</h1>
        <hr>
        <details>
            <summary>+ Novo administrador</summary>
            <form action="./php/add.php" method="post">
                <input type="hidden" name="pagina" value="3">

                <h2>Informações pessoais</h2>

                <label for="txt-cpf">CPF</label>
                <input type="text" name="cpf" id="txt-cpf" minlength="11" maxlength="11" required>

                <label for="txt-nome">Nome completo</label>
                <input type="text" name="nome" id="txt-nome" minlength="5" maxlength="30" required>

                <h2>Conta</h2>
                <label for="eml-email">E-mail</label>
                <input type="email" name="email" id="eml-email" required>

                <label for="psw-senha">Senha</label>
                <input type="password" name="senha" id="psw-senha" minlength="6" maxlength="20" required>
                
                <label for="olhoMagico" class="olhoMagico"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg></label>
                <input type="checkbox" id="olhoMagico" class="olhoMagico" style="display: none">
                
                <section><input type="submit" value="Cadastrar"></section>
                
            </form>
        </details>

        <?php
            //ADMINISTRADORES
            $qtdQuery = $query->num_rows;
            if($qtdQuery>0){
                echo "<h2>Administradores</h2><table><tr><th>CPF</th><th>Nome</th><th>E-mail</th><th></th></tr>";
                foreach ($query as $adm){
        ?>
        <tr>
            <td><span>*******</span><?=substr($adm['usr_cpf'],-4)?></td>
            <td><?=$adm['usr_nome']?></td>
            <td><?=$adm['usr_email']?></td>
            <td><a href="./confirmarExclusao.php?x=3&&y=<?=$adm['usr_id']?>"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg></a></td>
        </tr>
        <?php }}
            echo "</table>";
            //CLIENTES
            $qtdQuery1 = $query1->num_rows;
            if($qtdQuery1>0){
                echo "<h2>Clientes</h2><ol>";
                foreach ($query1 as $cliente){
        ?>
        <li><?=$cliente['usr_email']?></li>
        <?php }} echo "</ol>"; ?>
    </main>
    <script src="./js/script.js"></script>
</body>
</html>