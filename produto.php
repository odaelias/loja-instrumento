<?php
require_once("db/conexao.php");

$idProduto= $_GET['itm'];
$sqlProduto="SELECT *, Categoria.ctg_nome FROM Produto INNER JOIN Categoria ON Produto.prd_categoria = Categoria.ctg_id WHERE Produto.prd_id = '$idProduto'";
$queryProduto= mysqli_query($dbConexao, $sqlProduto);
$produto= mysqli_fetch_array($queryProduto);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="./img/" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <title><?=$produto['prd_nome']?> | Grandíssimo</title>
</head>
<body class="produto">
    <header>
        <?php
            include('./header.php');
            if(isset($_SESSION['login'])){
                $id= $_SESSION['login'];
                $sql= "SELECT usr_funcao FROM Usuario WHERE usr_id = '$id'";
                $query= mysqli_query($dbConexao, $sql);
                $adm= mysqli_fetch_array($query);
            }
        ?>
    </header>
    <main>
        <section>
            <h1><?=$produto['prd_nome']?></h1>
            <span>R$</span> <?=$produto['prd_preco']?>
        </section>
        <section>
            <img src="<?=$produto['prd_imagem']?>" alt="<?=$produto['prd_nome']?>">
        </section>
        <section>
            <?php
                if(isset($_POST['comprar']) && isset($_SESSION['login']) && ($adm['usr_funcao']==2)){
                    $id= $_SESSION['login'];
                    $sql="SELECT * FROM Usuario WHERE usr_id = '$id';";
                    $query= mysqli_query($dbConexao, $sql);
                    $usuario= mysqli_fetch_array($query);
            ?>
            <h2>Compra</h2>
            <form action="./php/add.php" method="post">
                <input type="hidden" name="pagina" value="4">
                
                <h3>Confirmar dados</h3>
                <h4>Informações pessoais</h4>

                <label for="txt-cpf">CPF</label>
                <input type="text" name="cpf" id="txt-cpf" value="<?=$usuario['usr_cpf']?>" minlength="11" maxlength="11" required>

                <label for="txt-nome">Nome completo</label>
                <input type="text" name="nome" id="txt-nome" value="<?=$usuario['usr_nome']?>" minlength="5" maxlength="50" required>

                <input type="checkbox" name="nome2check" id="chc-nome2">
                <label for="chc-nome2">Uso nome social e também quero inserir o nome civil na minha encomenda</label>
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg>
                <span>Recomendado para pessoas transgênero que não têm nenhum documento oficial com nome social</span>
                <label for="txt-nome2">Nome civil completo</label>
                <input type="text" name="nome2" id="txt-nome2" value="<?=$usuario['usr_nome2']?>" minlength="5" maxlength="50">

                <label for="txt-telefone">Telefone</label>
                <input type="tel" name="telefone" id="txt-telefone" value="<?=$usuario['usr_telefone']?>" minlength="11" maxlength="11">

                <input type="checkbox" name="notificacao" id="chc-notificacao">
                <label for="chc-notificacao">Quero receber notificações pelo celular</label>

                <h4>Entrega</h4>

                <label for="txt-cep">CEP</label>
                <input type="text" name="cep" id="txt-cep" value="<?=$usuario['usr_cep']?>" minlength="8" maxlength="8">

                <label for="txt-uf">UF</label>
                <input type="text" name="uf" id="txt-uf" value="<?=$usuario['usr_uf']?>" minlength="2" maxlength="2" required>

                <label for="txt-cidade">Cidade</label>
                <input type="text" name="cidade" id="txt-cidade" value="<?=$usuario['usr_cidade']?>" minlength="2" maxlength="50" required>

                <label for="txt-bairro">Bairro</label>
                <input type="text" name="bairro" id="txt-bairro" value="<?=$usuario['usr_bairro']?>" minlength="2" maxlength="50" required>

                <label for="txt-endereco">Endereço</label>
                <input type="text" name="endereco" id="txt-endereco" value="<?=$usuario['usr_endereco']?>" minlength="2" maxlength="50" required>

                <label for="nmb-numero">Número</label>
                <input type="number" name="numero" id="nmb-numero" value="<?=$usuario['usr_numero']?>" min="1" max="9999" required>

                <label for="txt-complemento">Complemento</label>
                <input type="text" name="complemento" id="txt-complemento" value="<?=$usuario['usr_complemento']?>" minlength="2" maxlength="50">

                <input type="checkbox" name="vizinhocheck" id="chc-vizinho">
                <label for="chc-vizinho">Entregar no vizinho em caso de ausência</label>

                <label for="txt-vizinho">Endereço do vizinho</label>
                <input type="text" name="vizinho" id="txt-vizinho" minlength="2" maxlength="50">

                <h3>Cartão de crédito</h3>
                <label for="txt-titular">Nome do titular</label>
                <input type="text" id="txt-titular" value="<?=$usuarioHeader['usr_nome']?>" minlength="2" maxlength="50" required>

                <label for="nmb-cartao">Número do cartão</label>
                <input type="text" id="nmb-cartao" inputmode="numeric" minlength="13" maxlength="16" required>

                <label for="dt-validade">Data de validade</label>
                <input type="date" id="dt-validade" required>

                <label for="nmb-cvv">CVV</label>
                <input type="text" id="nmb-cvv" inputmode="numeric" minlength="3" maxlength="3" required>

                <input type="hidden" name="produto" value="<?=$produto['prd_id']?>">

                <button onclick="history.go(-1)">Cancelar</button>
                <input type="submit" value="Finalizar compra">
            </form>
            <?php 
                } elseif(isset($_POST['comprar']) AND !isset($_SESSION['login'])){
                    header('Location: ./entrar.html');
                } else{
            ?>
            <?=$produto['prd_descricao']?>
            <form action="" method="post">
                <input type="hidden" name="comprar" value="1">
                <input type="submit" value="Comprar">
            <?php } ?>
            </form>
        </section>
    </main>
</body>
</html>