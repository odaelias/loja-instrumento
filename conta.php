<?php session_start();
require_once("db/conexao.php");

if(!isset($_SESSION['login'])){
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
    <link rel="shortcut icon" href="./img/music-svgrepo-com.svg" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <title>Minha conta</title>
</head>
<body class="conta">
    <header>
        <?php
            include('./headerUsuario.php');
        ?>
    </header>
    <main>
        <h1>Minha conta</h1>
        <hr>
        <form action="./php/edit.php" method="post">
            <input type="hidden" name="pagina" value="5">
            
            <h4>Informações pessoais</h4>
            <div>                
                <div><label for="txt-cpf">CPF</label></div>
                <div><label for="txt-nome">Nome completo</label></div>
                <div><input type="text" name="cpf" id="txt-cpf" value="<?=$usuario['usr_cpf']?>" minlength="11" maxlength="11" required></div>
                <div><input type="text" name="nome" id="txt-nome" value="<?=$usuario['usr_nome']?>" minlength="5" maxlength="50" required></div>                
            </div>
                
            <h4>Endereço para entrega</h4>

            <div>                
                <div><label for="txt-cep">CEP</label></div>
                <div><label for="txt-uf">UF</label></div>
                <div><label for="txt-cidade">Cidade</label></div>
                <div><input type="text" name="cep" id="txt-cep" value="<?=$usuario['usr_cep']?>" minlength="8" maxlength="8"></div>
                <div><input type="text" name="uf" id="txt-uf" value="<?=$usuario['usr_uf']?>" minlength="2" maxlength="2"></div>
                <div><input type="text" name="cidade" id="txt-cidade" value="<?=$usuario['usr_cidade']?>" minlength="2" maxlength="50"></div>                
            </div>
            <div>                
                <div><label for="txt-bairro">Bairro</label></div>
                <div><label for="txt-endereco">Endereço</label></div>
                <div><label for="nmb-numero">Número</label></div>
                <div><label for="txt-complemento">Complemento</label></div>
                <div><input type="text" name="bairro" id="txt-bairro" value="<?=$usuario['usr_bairro']?>" minlength="2" maxlength="50"></div>
                <div><input type="text" name="endereco" id="txt-endereco" value="<?=$usuario['usr_endereco']?>" minlength="2" maxlength="50"></div>
                <div><input type="number" name="numero" id="nmb-numero" value="<?=$usuario['usr_numero']?>" min="1" max="9999"></div>
                <div><input type="text" name="complemento" id="txt-complemento" value="<?=$usuario['usr_complemento']?>" minlength="2" maxlength="50"></div>                
            </div>
            
            <h4>Conta</h4>

            <div>                
                <div><label for="eml-email">E-mail</label></div>
                <div><label for="psw-senha">Senha</label></div>
                <div><input type="email" name="email" id="eml-email" value="<?=$usuario['usr_email']?>" required></div>
                <div>
                    <input type="password" name="senha" id="psw-senha" minlength="6" maxlength="20" required>

                    <label for="olhoMagico" class="olhoMagico"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg></label>
                    <input type="checkbox" id="olhoMagico" class="olhoMagico" style="display: none">
                </div>
                <div><a href="./alterarSenha.php">Alterar senha</a></div>
            </div>           
                            
            <input type="submit" value="Atualizar">
        </form>
        <a href="./confirmarExclusao.php?x=4">Excluir esta conta</a>
    </main>
    <script src="./js/script.js"></script>
</body>
</html>