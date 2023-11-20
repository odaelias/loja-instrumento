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

$sql= "SELECT * FROM Categoria WHERE ctg_id = $id";
$query= mysqli_query($dbConexao, $sql);

$categoria= mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/music-svgrepo-com.svg" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <title>Editar categoria</title>
</head>
<body class="admCategoriaEdit">
    <main>
        <h2>Editar Categoria</h2>
        <form action="./php/edit.php" method="post">
            <input type="hidden" name="pagina" value="1">
            <input type="hidden" name="id" value="<?=$id?>">
            <label for="txt-nome">Nome</label>
            <section>
            <input type="text" name="nome" id="txt-nome" value="<?=$categoria['ctg_nome']?>" minlength="1" maxlength="20" required>
            </section>
            <section>
                <input type="radio" name="status" id="rd-ativa" value="1" checked>
                <label for="rd-ativa">Ativa</label>
                <input type="radio" name="status" id="rd-inativa" value="0">
                <label for="rd-inativa">Inativa</label>
            </section>
            <section>
                <input type="submit" value="Atualizar">
            </section>
        </form>
        <section>
            <a href="./admCategoria.php">Voltar</a>
        </section>
    </main>
</body>
</html>