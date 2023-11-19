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
    <link rel="shortcut icon" href="./img/music-svgrepo-com.svg" type="image/x-icon">
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
            <h2>Confirmar dados para compra</h2>
            <hr>
            <form action="./php/add.php" method="post">
                <input type="hidden" name="pagina" value="4">
                
                <h4>Informações pessoais</h4>

                <div>
                    <div>
                        <label for="txt-cpf">CPF</label>
                    </div>
                    <div>
                        <label for="txt-nome">Nome completo</label>
                    </div>
                    <div>
                        <input type="text" name="cpf" id="txt-cpf" value="<?=$usuario['usr_cpf']?>" minlength="11" maxlength="11" required>
                    </div>
                    <div>
                        <input type="text" name="nome" id="txt-nome" value="<?=$usuario['usr_nome']?>" minlength="5" maxlength="50" required>
                    </div>
                </div>

                <div>
                    <div>
                        <label for="txt-cep">CEP</label>
                    </div>
                    <div>
                        <label for="txt-uf">UF</label>
                    </div>
                    <div>
                        <label for="txt-cidade">Cidade</label>
                    </div>
                    <div>
                        <input type="text" name="cep" id="txt-cep" value="<?=$usuario['usr_cep']?>" minlength="8" maxlength="8">
                    </div>
                    <div>
                        <input type="text" name="uf" id="txt-uf" value="<?=$usuario['usr_uf']?>" minlength="2" maxlength="2" required>
                    </div>
                    <div>
                        <input type="text" name="cidade" id="txt-cidade" value="<?=$usuario['usr_cidade']?>" minlength="2" maxlength="50" required>
                    </div>
                </div>
                
                <div>
                    <div>
                        <label for="txt-bairro">Bairro</label>
                    </div>
                    <div>
                        <label for="txt-endereco">Endereço</label>
                    </div>
                    <div>
                        <label for="nmb-numero">Número</label>
                    </div>
                    <div>
                        <input type="text" name="bairro" id="txt-bairro" value="<?=$usuario['usr_bairro']?>" minlength="2" maxlength="50" required>
                    </div>
                    <div>
                        <input type="text" name="endereco" id="txt-endereco" value="<?=$usuario['usr_endereco']?>" minlength="2" maxlength="50" required>
                    </div>
                    <div>
                        <input type="number" name="numero" id="nmb-numero" value="<?=$usuario['usr_numero']?>" min="1" max="9999" required>
                    </div>
                </div>

                <div>
                    <div>
                        <label for="txt-complemento">Complemento</label>
                    </div>
                    <div>
                        <label for="txt-vizinho">Endereço do vizinho</label>                        
                    </div>
                    <div>
                        <input type="text" name="complemento" id="txt-complemento" value="<?=$usuario['usr_complemento']?>" minlength="2" maxlength="50">
                    </div>
                    <div>
                        <input type="text" name="vizinho" id="txt-vizinho" minlength="2" maxlength="50">                        
                    </div>
                    <div>
                        <input type="checkbox" name="vizinhocheck" id="chc-vizinho">                       
                        <label for="chc-vizinho">Entregar no vizinho em caso de ausência</label>
                    </div>
                </div>

                <h4>Cartão de crédito</h4>

                <div>
                    <div>
                        <label for="txt-titular">Nome do titular</label>
                    </div>
                    <div>
                        <label for="nmb-cartao">Número do cartão</label>                        
                    </div>
                    <div>
                        <label for="dt-validade">Data de validade</label>
                    </div>
                    <div>
                        <label for="nmb-cvv">CVV</label>
                    </div>
                    <div>
                        <input type="text" id="txt-titular" value="<?=$usuarioHeader['usr_nome']?>" minlength="2" maxlength="50" required>
                    </div>
                    <div>
                        <input type="text" id="nmb-cartao" inputmode="numeric" minlength="13" maxlength="16" required>
                    </div>
                    <div>
                        <input type="date" id="dt-validade" required>
                    </div>
                    <div>
                        <input type="text" id="nmb-cvv" inputmode="numeric" minlength="3" maxlength="3" required>
                    </div>
                </div>

                <input type="hidden" name="produto" value="<?=$produto['prd_id']?>">

                <div>
                    <div>
                        <button onclick="history.go(-1)">Cancelar</button>
                    </div>
                    <div>
                        <input type="submit" value="Finalizar compra">
                    </div>
                </div>
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
    <script src="./js/script.js"></script>
</body>
</html>