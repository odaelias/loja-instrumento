<?php
//CONEXÃO COM BANCO DE DADOS

$dbServer= "127.0.0.1";
$dbBanco= "grandissimo";
$dbUser= "root";
$dbPassword= "";

$dbConexao= mysqli_connect($dbServer, $dbUser, $dbPassword, $dbBanco);

//CHECAGEM DE CONEXÃO
if(mysqli_connect_errno()){
    echo "FALHA AO CONECTAR COM MYSQL: " . mysqli_connect_error();
}

mysqli_select_db($dbConexao, $dbBanco);
?>