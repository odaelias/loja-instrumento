<?php session_start();
require_once("db/conexao.php");

$hoje= date('Y-m-d');

$sql= "SELECT Usuario.usr_email, Compra.*, Produto.prd_nome FROM Usuario INNER JOIN Compra ON Usuario.usr_id = Compra.cmp_usuario INNER JOIN Produto ON Compra.cmp_produto = Produto.prd_id WHERE Compra.cmp_dataentrega >= '$hoje' ORDER BY Compra.cmp_dataentrega";
$query= mysqli_query($dbConexao, $sql);

$sql1= "SELECT Usuario.usr_email, Compra.*, Produto.prd_nome FROM Usuario INNER JOIN Compra ON Usuario.usr_id = Compra.cmp_usuario INNER JOIN Produto ON Compra.cmp_produto = Produto.prd_id WHERE Compra.cmp_dataentrega < '$hoje' ORDER BY Compra.cmp_dataentrega DESC";
$query1= mysqli_query($dbConexao, $sql1);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/music-svgrepo-com.svg" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <title>Gerenciar entregas</title>
</head>
<body>
    <header>
        <?php
            include('./admHeader.php');
        ?>
    </header>
    <main>
        <h1>Gerenciar entregas</h1>
        <?php
            $qtdQuery = $query->num_rows;
            if($qtdQuery>0){
                echo "<h2>Para entrega</h2><table><tr><th>Código</th><th>Entrega</th><th>Produto</th><th>Comprador</th><th></th></tr>";
                foreach ($query as $entregar){
                    $dataentrega = $entregar['cmp_dataentrega'];
                    $dataentrega = date('d/m', strtotime($dataentrega));
        ?>
        <tr>
            <td><?=$entregar['cmp_id']?></td>
            <td><?=$dataentrega?></td>
            <td><?=$entregar['prd_nome']?></td>
            <td><?=$entregar['usr_email']?></td>
            <td><button>Gerar etiqueta</button></td>
        </tr>
        <?php
            } echo "</table>"; } else{
        ?>
        <span>Sem entregas pendentes</span>
        <?php
            }
            $qtdQuery1 = $query1->num_rows;
            if($qtdQuery1>0){
                echo "<h2>Entregues</h2><table><tr><th>Código</th><th>Entregue</th><th>Produto</th><th>Comprador</th><th></th></tr>";
                foreach ($query1 as $entregue){
                    $dataentrega = $entregue['cmp_dataentrega'];
                    $dataentrega = date('d/m', strtotime($dataentrega));
        ?>
        <tr>
            <td><?=$entregue['cmp_id']?></td>
            <td><?=$dataentrega?></td>
            <td><?=$entregue['prd_nome']?></td>
            <td><?=$entregue['usr_email']?></td>
            <td><a href="./php/delete.php?x=6&&y=<?=$entregue['cmp_id']?>"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg></a></td>
        </tr>
        <?php } echo "</table>"; }?>
    </main>
</body>
</html>