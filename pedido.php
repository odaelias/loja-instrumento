<?php session_start();
require_once("db/conexao.php");

$id= $_SESSION['login'];

$hoje= date('Y-m-d');

$sql= "SELECT Compra.*, Produto.prd_nome, Produto.prd_id FROM Compra INNER JOIN Produto ON Compra.cmp_produto = Produto.prd_id WHERE Compra.cmp_dataentrega >= '$hoje' ORDER BY Compra.cmp_dataentrega";
$query= mysqli_query($dbConexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <title>Meus pedidos</title>
</head>
<body>
    <header>
        <?php
            include('./headerUsuario.php');
        ?>
    </header>
    <main>
        <h1>Meus pedidos</h1>
        <?php
            $qtdQuery = $query->num_rows;
            if($qtdQuery>0){
                echo "<table><tr><th>Código</th><th>Entrega</th><th>Produto</th><th></th></tr>";
                foreach ($query as $compra){
                    $dataentrega = $compra['cmp_dataentrega'];
                    $dataentrega = date('d/m', strtotime($dataentrega));
        ?>
        <tr>
            <td><?=$compra['cmp_id']?></td>
            <td><?=$dataentrega?></td>
            <td><?=$compra['prd_nome']?></td>
            <td><a href="./php/delete.php?x=5&&y=<?=$compra['cmp_id']?>&&z=<?=$compra['prd_id']?>">Cancelar pedido</a></td>
        </tr>
        <?php
            }
            echo "</table>";
            } else{ 
        ?>
            <span>Sem pedidos</span>
        <?php } ?>
    </main>
</body>
</html>