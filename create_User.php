<?php 
// Conexão com o banco colocar na variável $DB_connect
require_once("databaseconnect.php");

// Get data
$login = $_GET['login'];
$login_criado = $_GET['login_criado'];
$senha = md5($_GET['senha']);
$perfil = $_GET['perfil'];

// Verifica se o usuário possui permissão para acesso
$access = 0;
$query_check_user = "SELECT * FROM usuarios WHERE login_usuario = '".$login."'";
$result_check_user = mysqli_query($DB_connect, $query_check_user);
$row = mysqli_fetch_assoc($result_check_user);
if ($row['perfil'] == 'admin' || $row['perfil'] == 'developer'){
    $access = 1;
}

if ($access){
    /* Verificar informações de tabelas estrangeiras */
    $query_insert_evidence = "INSERT INTO usuarios (login_usuario, senha, perfil)
                              VALUES ('".$login_criado."', '".$senha."', '".$perfil."');";
    $result_insert_evidence = mysqli_query($DB_connect, $query_insert_evidence);
}

mysqli_close($DB_connect);
?>