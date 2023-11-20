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

//TODOS PRODUTOS ATIVOS
$sql="SELECT *, Categoria.ctg_nome FROM Produto INNER JOIN Categoria ON Produto.prd_categoria = Categoria.ctg_id WHERE Produto.prd_status=1 ORDER BY Categoria.ctg_nome, Produto.prd_nome";
$query= mysqli_query($dbConexao, $sql);

//PRODUTOS INATIVOS
$sql1="SELECT *, Categoria.ctg_nome FROM Produto INNER JOIN Categoria ON Produto.prd_categoria = Categoria.ctg_id WHERE Produto.prd_status=0 ORDER BY Categoria.ctg_nome, Produto.prd_nome";
$query1= mysqli_query($dbConexao, $sql1);

//CATEGORIAS
$sql2="SELECT * FROM Categoria WHERE ctg_status=1 ORDER BY ctg_nome";
$query2= mysqli_query($dbConexao, $sql2);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/music-svgrepo-com.svg" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <title>Gerenciar produtos</title>
</head>
<body class="admproduto">
    <header>
        <?php
            include('./admHeader.php');
        ?>
    </header>
    <main>
        <h1>Gerenciar produtos</h1>
        <hr>
        <details>
            <summary>Novo produto</summary>
            <form action="./php/add.php" method="post">
                <input type="hidden" name="pagina" value="2">

                <section>
                    <section><label for="txt-nome">Nome</label></section>
                    <section><input type="text" name="nome" id="txt-nome" maxlength="30" required></section>                    
                </section>
                
                <section>
                    <section><label for="txt-imagem">URL da imagem</label></section>
                    <section><input type="text" name="imagem" id="txt-imagem" required></section>
                </section>
                
                <section>
                    <section>
                        <label for="txt-descricao">Descrição</label>
                    </section>
                    <section>
                        <textarea name="descricao" id="txt-descricao" maxlength="100"></textarea>
                    </section>
                </section>

                <section>
                    <section><label for="nmb-preco">Preço</label></section>
                    <section><input type="number" name="preco" id="nmb-preco" step=".01" required></section>
                </section>
                
                <section>
                    <section><label for="nmb-qnt">Quantidade no estoque</label></section>
                    <section><input type="number" name="qnt" id="nmb-qnt" required></section>                    
                </section>
                
                <section>
                    <label for="slc-categoria">Categoria</label>
                    <select name="categoria" id="slc-categoria">
                        <?php foreach ($query2 as $categoria){ ?>
                        <option value="<?=$categoria['ctg_id']?>"><?=$categoria['ctg_nome']?></option>
                        <?php } ?>
                    </select>
                </section>
                
                <input type="submit" value="Adicionar">
            </form>
        </details>

        <?php
        $qtdQuery = $query->num_rows;
        if($qtdQuery>0){
            echo "<table><tr><th>Nome</th><th>Categoria</th><th>Preço</th><th>Qtd</th><th></th></tr>";
            foreach ($query as $produto){
        ?>
        <tr>
            <td><?=$produto['prd_nome']?></td>
            <td><?=$produto['ctg_nome']?></td>
            <td><span>R$</span><?=$produto['prd_preco']?></td>
            <td><?=$produto['prd_qnt']?></td>
            <td><a href="admProdutoEdit.php?id=<?=$produto['prd_id']?>"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg></a></td>
        </tr>
        <?php
            }
            echo "</table>";
        }
        //PRODUTOS INATIVOS
        $qtdQuery1 = $query1->num_rows;
        if($qtdQuery1>0){
                echo"<details>
                <summary>Inativos</summary><table><tr><th>Nome</th><th>Categoria</th><th></th><th></th></tr>";
                foreach ($query1 as $produto1){
        ?>
        <tr>
            <td><?=$produto1['prd_nome']?></td>
            <td><?=$produto1['ctg_nome']?></td>
            <td><a href="admProdutoEdit.php?id=<?=$produto1['prd_id']?>"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg></a></td>
            <td><a href="confirmarExclusao.php?x=2&&y=<?=$produto1['prd_id']?>"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg></a></td>
        </tr>
        <?php
        }
        echo "<table></details>";
        }
        ?>
    </main>
</body>
</html>