<?php session_start();
require_once("../db/conexao.php");

//1 ADMCATEGORIA; 2 ADMPRODUTO; 3 ADMUSUARIO; 4 PRODUTO; 5 CADASTRO
$pagina= $_POST['pagina'];

if($pagina==1){
    $nome= $_POST['nome'];
    $sql= "INSERT INTO Categoria(ctg_id, ctg_nome, ctg_status) VALUES(null, '$nome', 1);";
    $cadastrar= mysqli_query($dbConexao, $sql);
    header("Location:../admCategoria.php");

} elseif($pagina==2){
    $nome= $_POST['nome'];
    $imagem= $_POST['imagem'];
    $preco= $_POST['preco'];
    $qnt= $_POST['qnt'];
    $categoria= $_POST['categoria'];
    $descricao= $_POST['descricao'];
    $sql= "INSERT INTO Produto(prd_id, prd_nome, prd_imagem, prd_preco, prd_qnt, prd_status, prd_categoria, prd_descricao) VALUES(null, '$nome', '$imagem', '$preco', '$qnt', 1, '$categoria', '$descricao');";
    $cadastrar= mysqli_query($dbConexao, $sql);
    header("Location:../admProduto.php");

} elseif($pagina==3){
    //CADASTRO DE ADMINISTRADORES
    $cpf= $_POST['cpf'];
    $nome= $_POST['nome'];
    $email= $_POST['email'];
    $senha= $_POST['senha'];
    $senhaC= password_hash($senha, PASSWORD_DEFAULT);
    
    $sql= "INSERT INTO Usuario(usr_id, usr_cpf, usr_email, usr_senha, usr_nome, usr_funcao) VALUES (null, '$cpf', '$email', '$senhaC', '$nome', 1)";
    
    $selectEmail= "SELECT COUNT(usr_email) AS cntEmail FROM Usuario WHERE usr_email = '$email'";
    $queryEmail= mysqli_query($dbConexao, $selectEmail);
    $qtdEmail= mysqli_fetch_assoc($queryEmail);
    
    //ERRO: E-MAIL JÁ CADASTRADO
    if($qtdEmail["cntEmail"]>=1){
        header("Location:../admUsuario.php");
    }
    
    else{
        $cadastrar= mysqli_query($dbConexao, $sql);
        header("Location:../admUsuario.php");
    }

} elseif($pagina==4){
    $id= $_SESSION['login'];
    //INFORMAÇÕES PESSOAIS
    $cpf= $_POST['cpf'];
    $nome= $_POST['nome'];
    //ENTREGA
    $cep= $_POST['cep'];
    $uf= $_POST['uf'];
    $cidade= $_POST['cidade'];
    $bairro= $_POST['bairro'];
    $endereco= $_POST['endereco'];
    $numero= $_POST['numero'];
    $complemento= $_POST['complemento'];
    $vizinhocheck= $_POST['vizinhocheck'];
    $vizinho= $_POST['vizinho'];
    //COMPRA
    $produto= $_POST['produto'];
    $datapedido= date('Y-m-d');
    $random= rand(3, 24);
    $dataentrega= date('Y-m-d', strtotime($Date. ' + '.$random.' days'));

    $sql= "UPDATE Usuario SET usr_nome = '$nome', usr_cpf = '$cpf',
    usr_cep = '$cep', usr_uf = '$uf', usr_cidade = '$cidade', usr_bairro = '$bairro', usr_endereco = '$endereco', usr_numero = '$numero', usr_complemento = '$complemento' 
    WHERE usr_id = '$id'";

    $update= mysqli_query($dbConexao, $sql);

    if($vizinhocheck==false){
        $sql1= "INSERT INTO Compra(cmp_id, cmp_datapedido, cmp_dataentrega, cmp_vizinho, cmp_produto, cmp_usuario) 
        VALUES(null, '$datapedido', '$dataentrega', null, '$produto', '$id')"; 
    } else{
        $sql1= "INSERT INTO Compra(cmp_id, cmp_datapedido, cmp_dataentrega, cmp_vizinho, cmp_produto, cmp_usuario) 
        VALUES(null, '$datapedido', '$dataentrega', '$vizinho', '$produto', '$id')";
    }
    $insert= mysqli_query($dbConexao, $sql1);


    $sql3= "SELECT prd_qnt FROM Produto WHERE prd_id = '$produto'";
    $query= mysqli_query($dbConexao, $sql3);
    $prd= mysqli_fetch_array($query);
    $newqnt= intval($prd['prd_qnt'])-1;
    $sql2= "UPDATE Produto SET prd_qnt = '$newqnt' WHERE prd_id = '$produto'";
    $subtrair= mysqli_query($dbConexao, $sql2);

    header("Location:../pedido.php");

} else{
    //PÁGINA 5
    $cpf= $_POST['cpf'];
    $nome= $_POST['nome'];
    $cep= $_POST['cep'];
    $cidade= $_POST['cidade'];
    $uf= $_POST['uf'];
    $bairro= $_POST['bairro'];
    $endereco= $_POST['endereco'];
    $numero= $_POST['numero'];
    $complemento= $_POST['complemento'];
    $email= $_POST['email'];
    $senha= $_POST['senha'];
    $senhaC= password_hash($senha, PASSWORD_DEFAULT);

    $sql= "INSERT INTO Usuario(usr_id, usr_cpf, usr_email, usr_senha, usr_nome, usr_cep, usr_cidade, usr_uf, usr_bairro, usr_endereco, usr_numero, usr_complemento, usr_funcao) VALUES (null, '$cpf', '$email', '$senhaC', '$nome', '$cep', '$cidade', '$uf', '$bairro', '$endereco', '$numero', '$complemento', 2)";

    $selectEmail= "SELECT COUNT(usr_email) AS cntEmail FROM Usuario WHERE usr_email = '$email'";
    $queryEmail= mysqli_query($dbConexao, $selectEmail);
    $qtdEmail= mysqli_fetch_assoc($queryEmail);

    //ERRO: E-MAIL JÁ CADASTRADO
    if($qtdEmail["cntEmail"]>=1){
        header("Location:../cadastro.html");
    }

    else{
        $cadastrar= mysqli_query($dbConexao, $sql);
        $sqlLogin= "SELECT * FROM Usuario WHERE usr_email = '$email'";
        $sql_query= mysqli_query($dbConexao, $sqlLogin) or die("FALHA NA EXECUÇÃO DO CÓDIGO SQL: ".$mysqli->error);
        $login=$sql_query->fetch_assoc();
        session_start();
        $_SESSION['login']=$login['usr_id'];
        header("Location:../index.php");
    }

}
?>