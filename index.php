<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <title>Grandíssimo: instrumentos musicais</title>
</head>
<body class="index">
    <header>
        <?php
            include('./header.php');
        ?>
    </header>

    <main>
    <?php
        $qtdQuery = $query->num_rows;
        if($qtdQuery>0){
            echo "<h2>Produtos</h2>";
            foreach ($query as $produto){
        ?>
        <a href="./produto.php?itm=<?=$produto['prd_id']?>">
            <section>
                <img src="<?=$produto['prd_imagem']?>" alt="<?=$produto['prd_nome']?>">
            </section>
            <section>
                <?=$produto['prd_nome']?>
                <span>R$</span>
                <?=$produto['prd_preco']?>
            </section>
        </a>
        <?php }} else{ ?>
        <span>Nenhum produto encontrado</span>
        <?php } ?>
    </main>
</body>
</html>