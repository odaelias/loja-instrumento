<?php session_start();
require_once("db/conexao.php");

$id= $_GET['id'];

$sql= "SELECT * FROM Categoria WHERE ctg_id = $id";
$query= mysqli_query($dbConexao, $sql);

$categoria= mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <title>Editar categoria</title>
</head>
<body>
    <nav>
        <a href="./admCategoria.php">Voltar</a>
    </nav>

    <main>
        <h1>Editar Categoria</h1>
        <form action="./php/edit.php" method="post">
            <input type="hidden" name="pagina" value="1">
            <input type="hidden" name="id" value="<?=$id?>">

            <label for="txt-nome">Nome</label>
            <input type="text" name="nome" id="txt-nome" value="<?=$categoria['ctg_nome']?>" minlength="1" maxlength="20" required>

            <input type="radio" name="status" id="rd-ativa" value="1" checked>
            <label for="rd-ativa">Ativa</label>
            <input type="radio" name="status" id="rd-inativa" value="0">
            <label for="rd-inativa">Inativa</label>

            <input type="submit" value="Atualizar">
        </form>
    </main>
</body>
</html>