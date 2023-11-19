<?php session_start();
require_once("../db/conexao.php");

//1 ADMCATEGORIA; 2 ADMPRODUTO; 3 SENHA; 4 ADMCONTA; 5 CONTA
$pagina= $_POST['pagina'];

if($pagina==1){
    $nome= $_POST['nome'];
    $id= $_POST['id'];
    $status= $_POST['status'];
    $sql= "UPDATE Categoria SET ctg_nome='$nome', ctg_status='$status' WHERE ctg_id='$id';";
    $update= mysqli_query($dbConexao, $sql);
    header("Location:../admCategoria.php");

} elseif($pagina==2){
    $id= $_POST['id'];
    $nome= $_POST['nome'];
    $imagem= $_POST['imagem'];
    $preco= $_POST['preco'];
    $qnt= $_POST['qnt'];
    $status= $_POST['status'];
    $categoria= $_POST['categoria'];
    $descricao= $_POST['descricao'];
    $sql= "UPDATE Produto SET prd_nome = '$nome', prd_imagem = '$imagem', prd_preco = '$preco', prd_qnt = '$qnt', prd_status = '$status', prd_categoria = '$categoria', prd_descricao = '$descricao' WHERE prd_id = '$id';";
    $atualizar= mysqli_query($dbConexao, $sql);
    header("Location:../admProduto.php");

} elseif($pagina==3){
    $newsenha= $_POST['newsenha'];
    $senha= $_POST['senha'];
    
    $id= $_SESSION['login'];
    $sql="SELECT usr_senha, usr_funcao FROM Usuario WHERE usr_id = '$id';";
    $query= mysqli_query($dbConexao, $sql);
    $usuario= mysqli_fetch_array($query);
    $senhaAtual=$usuario['usr_senha'];
    
    if(password_verify($senha, $senhaAtual)){
        $senhaC= password_hash($newsenha, PASSWORD_DEFAULT);
        $sql1= "UPDATE Usuario SET usr_senha = '$senhaC' WHERE usr_id='$id';";
        $update= mysqli_query($dbConexao, $sql1);
        $funcao=$usuario['usr_funcao'];
        if($funcao==1){
            header('Location:../admConta.php');
        } else{
            header('Location:../conta.php');
        }
    } else{
        header('Location:../alterarSenha.php');
    }

} elseif($pagina==4){
    $id= $_POST['id'];
    $cpf= $_POST['cpf'];
    $nome= $_POST['nome'];
    $email= $_POST['email'];
    $senha= $_POST['senha'];

    $sql="SELECT usr_senha FROM Usuario WHERE usr_id = '$id';";
    $query= mysqli_query($dbConexao, $sql);
    $senhaAtual= $query->fetch_assoc();

    $sql1= "UPDATE Usuario SET usr_nome = '$nome', usr_cpf = '$cpf', usr_email = '$email' WHERE usr_id = '$id'";

    if(password_verify($senha, $senhaAtual['usr_senha'])){
        $update= mysqli_query($dbConexao, $sql1);
        header("Location:../admConta.php");
    } else{
        header("Location:../admConta.php");
    }
    
} else{
    $id= $_SESSION['login'];
    $cpf= $_POST['cpf'];
    $nome= $_POST['nome'];
    $cep= $_POST['cep'];
    $uf= $_POST['uf'];
    $cidade= $_POST['cidade'];
    $bairro= $_POST['bairro'];
    $endereco= $_POST['endereco'];
    $numero= $_POST['numero'];
    $complemento= $_POST['complemento'];
    $senha= $_POST['senha'];
    
    $sql1="SELECT usr_senha FROM Usuario WHERE usr_id = '$id';";
    $query= mysqli_query($dbConexao, $sql1);
    $senhaAtual= $query->fetch_assoc();
    
    if(password_verify($senha, $senhaAtual['usr_senha'])){
        
        $sql= "UPDATE Usuario SET usr_nome = '$nome', usr_cpf = '$cpf',
        usr_cep = '$cep', usr_uf = '$uf', usr_cidade = '$cidade', usr_bairro = '$bairro', usr_endereco = '$endereco', usr_numero = '$numero', usr_complemento = '$complemento' 
        WHERE usr_id = '$id'";
        
        $update= mysqli_query($dbConexao, $sql);
        header("Location:../conta.php");
    } else{
        header("Location:../conta.php");
    }
}
?>