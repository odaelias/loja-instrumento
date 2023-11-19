<?php session_start();
require_once("db/conexao.php");

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
    <nav>
        <a href="./admProduto.php">Voltar</a>
    </nav>
    
    <main>
        <h1>Editar produto</h1>
        <form action="./php/edit.php" method="post">
            <input type="hidden" name="pagina" value="2">
            <input type="hidden" name="id" value="<?=$id?>">
            
            <label for="txt-nome">Nome</label>
            <input type="text" name="nome" id="txt-nome" value="<?=$produto['prd_nome']?>" maxlength="30" required>

            <input type="radio" name="status" id="rd-ativo" value="1" checked>
            <label for="rd-ativo">Ativo</label>
            <input type="radio" name="status" id="rd-inativo" value="0">
            <label for="rd-inativo">Inativo</label>

            <label for="txt-imagem">URL da imagem</label>
            <input type="text" name="imagem" id="txt-imagem" value="<?=$produto['prd_imagem']?>" required>

            <img src="<?=$produto['prd_imagem']?>" alt="Imagem atual do produto">

            <label for="txt-descricao">Descrição</label>
            <textarea name="descricao" id="txt-descricao" maxlength="100"><?=$produto['prd_descricao']?></textarea>

            <label for="nmb-preco">Preço</label>
            <input type="number" name="preco" id="nmb-preco" step=".01" value="<?=$produto['prd_preco']?>" required>

            <label for="nmb-qnt">Quantidade no estoque</label>
            <input type="number" name="qnt" id="nmb-qnt" value="<?=$produto['prd_qnt']?>" required>

            <label for="slc-categoria">Categoria</label>
            <select name="categoria" id="slc-categoria">
            <option value="<?=$produto['ctg_id']?>" selected><?=$produto['ctg_nome']?></option>
            <?php foreach ($query1 as $categoria){ ?>
                <option value="<?=$categoria['ctg_id']?>"><?=$categoria['ctg_nome']?></option>
            <?php } ?>
            </select>

            <input type="submit" value="Atualizar">
        </form>
    </main>
</body>
</html>