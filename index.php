<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/music-svgrepo-com.svg" type="image/x-icon">
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
            foreach ($query as $produto){
        ?>
        <section>
            <a href="./produto.php?itm=<?=$produto['prd_id']?>">
                <img src="<?=$produto['prd_imagem']?>" alt="<?=$produto['prd_nome']?>">
                <?=$produto['prd_nome']?>
                <br>
                <span>R$</span>
                <?=$produto['prd_preco']?>
            </a>
        </section>
        <?php }} else{ ?>
        <span>Nenhum produto encontrado</span>
        <?php } ?>
    </main>
</body>
</html>