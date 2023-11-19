<?php session_start();
require_once("db/conexao.php");

//TODOS PRODUTOS ATIVOS
$sql="SELECT *, Categoria.ctg_nome FROM Produto INNER JOIN Categoria ON Produto.prd_categoria = Categoria.ctg_id WHERE Produto.prd_status=1 AND Produto.prd_qnt<>0 ORDER BY Produto.prd_qnt, Produto.prd_nome";
$query= mysqli_query($dbConexao, $sql);

//CATEGORIAS
$sql1="SELECT * FROM Categoria WHERE ctg_status=1 ORDER BY ctg_nome";
$query1= mysqli_query($dbConexao, $sql1);

//PRODUTOS FILTRADOS POR CATEGORIA
if(isset($_GET['categoria']) AND $_GET['categoria']!=0){
    $selectCategoria= $_GET['categoria'];
    $sql="SELECT *, Categoria.ctg_nome FROM Produto INNER JOIN Categoria ON Produto.prd_categoria = Categoria.ctg_id WHERE Produto.prd_status=1 AND Produto.prd_qnt<>0 AND Produto.prd_categoria = '$selectCategoria' ORDER BY Produto.prd_qnt, Produto.prd_nome";
    $query= mysqli_query($dbConexao, $sql);

    $sql2="SELECT * FROM Categoria WHERE ctg_id = '$selectCategoria'";
    $query2= mysqli_query($dbConexao, $sql2);
    $fetchCategoria= mysqli_fetch_array($query2);
}

//PRODUTOS FILTRADOS POR NOME
if(isset($_GET['produto'])){
    $selectProduto= $_GET['produto'];
    $sql="SELECT *, Categoria.ctg_nome FROM Produto INNER JOIN Categoria ON Produto.prd_categoria = Categoria.ctg_id WHERE Produto.prd_status=1 AND Produto.prd_qnt<>0 AND Produto.prd_nome LIKE '%$selectProduto%' ORDER BY Produto.prd_qnt, Produto.prd_nome";
    $query= mysqli_query($dbConexao, $sql);
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <section>
        <a href="./index.php">
            <img src="./img/music-svgrepo-com.svg" alt="Ícone Grandíssimo">
        </a>
    </section>

    <!--FILTRAR CATEGORIAS-->
    <section>
        <form action="#" method="get">
            <label for="slc-categoria">Categoria</label>
            <select name="categoria" id="slc-categoria" onchange="this.form.submit()">
                <?php if(isset($_GET['categoria']) AND $_GET['categoria']!=0){ ?>
                <option value="<?=$fetchCategoria['ctg_id']?>"><?=$fetchCategoria['ctg_nome']?></option>
                <?php } ?>
                <option value="0">Tudo</option>
                <?php foreach ($query1 as $categoria){ ?>
                <option value="<?=$categoria['ctg_id']?>"><?=$categoria['ctg_nome']?></option>
                <?php } ?>
            </select>
        </form>
    </section>

    <!--FILTRAR NOME DE PRODUTOS-->
    <section>
        <form action="#" method="get">
            <input type="text" name="produto" placeholder="Buscar produto">
            <label for="sbm-produto"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></label>
            <input type="submit" id="sbm-produto" style="display: none;">
        </form>
    </section>

    <!--LOGIN OU USUÁRIO-->
    <section>
        <?php
            //USUÁRIO DESLOGADO
            if(!isset($_SESSION['login'])){
        ?>
        <a href="./entrar.html">Login</a>
        <?php
            //USUÁRIO LOGADO
            } else{
                $idHeader= $_SESSION['login'];
                $sqlHeader="SELECT * FROM Usuario WHERE usr_id = '$idHeader';";
                $queryHeader= mysqli_query($dbConexao, $sqlHeader);
                $usuarioHeader= mysqli_fetch_array($queryHeader);

                $nomeHeader= $usuarioHeader['usr_nome'];
                $arrayNome= (explode(" ",$nomeHeader));

                //ADMINISTRADOR
                if($usuarioHeader['usr_funcao']==1){
        ?>
        <a href="./admEntrega.php"><?=$arrayNome[0]?></a>
        <a href="./php/logout.php"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/></svg></a>
        <?php
            }
            //CLIENTE
            else{
        ?>
        <a href="./pedido.php"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg></a>
        <a href="./conta.php"><?=$arrayNome[0]?></a>
        <a href="./php/logout.php"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/></svg></a>
        <?php }} ?>
    </section>
</body>
</html>