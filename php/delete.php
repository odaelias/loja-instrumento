<?php session_start();
require_once("../db/conexao.php");

//5 PEDIDO (GET); 6 ADMENTREGA (GET); 4 = ELSE
if((isset($_POST['pagina']))&&(isset($_POST['nome']))&&(isset($_POST['id']))){
    $pagina= $_POST['pagina'];
    $nome= $_POST['nome'];
    $id= $_POST['id'];
} else{
    $pagina= $_GET['x'];
}

if($pagina==1){
    $sql= "DELETE FROM Categoria WHERE ctg_id = '$id'";
    $sql1= "SELECT ctg_nome FROM Categoria WHERE ctg_id = '$id'";
    $query= mysqli_query($dbConexao, $sql1);
    $categoria= mysqli_fetch_array($query);
    if($nome==$categoria['ctg_nome']){
        $delete= mysqli_query($dbConexao, $sql);
        header("Location:../admCategoria.php");
    } else{
        header("Location:../confirmarExclusao.php?x=1&&y=$id");
    }
} elseif($pagina==2){
    $sql= "DELETE FROM Produto WHERE prd_id = '$id'";
    $sql1= "SELECT prd_nome FROM Produto WHERE prd_id = '$id'";
    $query= mysqli_query($dbConexao, $sql1);
    $produto= mysqli_fetch_array($query);
    if($nome==$produto['prd_nome']){
        $delete= mysqli_query($dbConexao, $sql);
        header("Location:../admProduto.php");
    } else{
        header("Location:../confirmarExclusao.php?x=2&&y=$id");
    }
} elseif($pagina==3){
    $sql= "DELETE FROM Usuario WHERE usr_id = '$id'";
    $sql1= "SELECT usr_nome FROM Usuario WHERE usr_id = '$id'";
    $query= mysqli_query($dbConexao, $sql1);
    $usuario= mysqli_fetch_array($query);
    if($nome==$usuario['usr_nome']){
        $delete= mysqli_query($dbConexao, $sql);
        header("Location:../admUsuario.php");
    } else{
        header("Location:../confirmarExclusao.php?x=3&&y=$id");
    }
} elseif($pagina==5){
    $id= $_GET['y'];
    $produto= $_GET['z'];
    $sql= "DELETE FROM Compra WHERE cmp_id = '$id'";
    $delete= mysqli_query($dbConexao, $sql);
    
    $sql3= "SELECT prd_qnt FROM Produto WHERE prd_id = '$produto'";
    $query= mysqli_query($dbConexao, $sql3);
    $prd= mysqli_fetch_array($query);
    $newqnt= intval($prd['prd_qnt'])+1;
    $sql2= "UPDATE Produto SET prd_qnt = '$newqnt' WHERE prd_id = '$produto'";
    $soma= mysqli_query($dbConexao, $sql2);
    
    header("Location:../pedido.php");
} elseif($pagina==6){
    $id= $_GET['y'];
    $sql= "DELETE FROM Compra WHERE cmp_id = '$id'";
    $delete= mysqli_query($dbConexao, $sql);
    header("Location:../admEntrega.php");
} else{
    $id= $_SESSION['login'];
    $nome= $_POST['nome'];
    $sql= "DELETE FROM Usuario WHERE usr_id = '$id'";
    $sql2= "DELETE FROM Compra WHERE cmp_usuario = '$id'";
    $sql1= "SELECT usr_senha FROM Usuario WHERE usr_id = '$id'";
    $query= mysqli_query($dbConexao, $sql1);
    $usuario= mysqli_fetch_array($query);
    if(password_verify($nome, $usuario['usr_senha'])){
        $deleteCompra= mysqli_query($dbConexao, $sql2);
        $delete= mysqli_query($dbConexao, $sql);
        unset($_SESSION['login']);
        session_destroy();
        header("Location:../index.php");
    } else{
        header("Location:../confirmarExclusao.php?x=4");
    }
}
?>