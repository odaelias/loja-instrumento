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

$id= $_GET['id'];

$sql="SELECT *, Categoria.ctg_nome FROM Produto INNER JOIN Categoria ON Produto.prd_categoria = Categoria.ctg_id WHERE Produto.prd_id=$id ORDER BY Categoria.ctg_nome, Produto.prd_nome";
$query= mysqli_query($dbConexao, $sql);

$sql1="SELECT * FROM Categoria WHERE ctg_status=1 ORDER BY ctg_nome";
$query1= mysqli_query($dbConexao, $sql1);

$produto= mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/music-svgrepo-com.svg" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <title>Editar produto</title>
</head>
<body class="admProdutoEdit">    
    <main>
        <h2>Editar produto</h2>
        <hr>
        <form action="./php/edit.php" method="post">
            <input type="hidden" name="pagina" value="2">
            <input type="hidden" name="id" value="<?=$id?>">
            
            <section>
                <section><label for="txt-nome">Nome</label></section>
                <section><input type="text" name="nome" id="txt-nome" value="<?=$produto['prd_nome']?>" maxlength="30" required></section>
            </section>
            <section>
                <section>
                    <input type="radio" name="status" id="rd-ativo" value="1" checked>
                    <label for="rd-ativo">Ativo</label>
                    <input type="radio" name="status" id="rd-inativo" value="0">
                    <label for="rd-inativo">Inativo</label>
                </section>
            </section>
            <section>
                <section><label for="txt-imagem">URL da imagem</label></section>
                <section><input type="text" name="imagem" id="txt-imagem" value="<?=$produto['prd_imagem']?>" required></section>
                <section><img src="<?=$produto['prd_imagem']?>" alt="Imagem atual do produto"></section>
            </section>
            <section>
                <section><label for="txt-descricao">Descrição</label></section>
                <section><textarea name="descricao" id="txt-descricao" maxlength="100"><?=$produto['prd_descricao']?></textarea></section>
            </section>
            <section>
                <section><label for="nmb-preco">Preço</label></section>
                <section><input type="number" name="preco" id="nmb-preco" step=".01" value="<?=$produto['prd_preco']?>" required></section>
            </section>
            <section>
                <section><label for="nmb-qnt">Quantidade no estoque</label></section>
                <section><input type="number" name="qnt" id="nmb-qnt" value="<?=$produto['prd_qnt']?>" required></section>
            </section>
            <section>
                <section>
                    <label for="slc-categoria">Categoria</label>
                    <select name="categoria" id="slc-categoria">
                    <option value="<?=$produto['ctg_id']?>" selected><?=$produto['ctg_nome']?></option>
                    <?php foreach ($query1 as $categoria){ ?>
                        <option value="<?=$categoria['ctg_id']?>"><?=$categoria['ctg_nome']?></option>
                    <?php } ?>
                    </select>
                </section>
            </section>
            <section>
                <section><input type="submit" value="Atualizar"></section>
            </section>
        </form>
        <section>
            <section><a href="./admProduto.php">Voltar</a></section>
        </section>
    </main>
</body>
</html>