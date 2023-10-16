<?php
include('../db/conexao.php');

$usuario= $_POST['usuario'];
$senha= $_POST['senha'];

$sql= "SELECT * FROM Usuario WHERE usr_email = '$usuario'";
$sql_query= mysqli_query($dbConexao, $sql) or die("FALHA NA EXECUÇÃO DO CÓDIGO SQL: ".$mysqli->error);

$qtdResultado = $sql_query->num_rows;

if($qtdResultado==1){
    $login=$sql_query->fetch_assoc();

    if(password_verify($senha, $login['usr_senha'])){
        session_start();

        $_SESSION['login']=$login['usr_id'];

        if($login['usr_funcao']==2){
            header("Location: ../index.php");
        } else{
            header("Location: ../admEntrega.php");
        }
    } else{
        header("Location:../entrar.html");
    }
    
} else{
    header("Location:../entrar.html");
}
?>