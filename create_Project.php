<?php 
// Conexão com o banco colocar na variável $DB_connect
require_once("databaseconnect.php");

// Get data
$login = $_GET['login'];
$titulo = $_GET['titulo'];
$descricao = $_GET['descricao'];
$status = $_GET['status'];

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
    $query_insert_project = "INSERT INTO projetos (titulo, descricao, status)
                              VALUES ('".$titulo."', '".$descricao."', '".$status."');";
    $result_insert_project = mysqli_query($DB_connect, $query_insert_project);

    // Log
    $query_log = "INSERT INTO log (login, data, projeto, evidencia, insercao, remocao)
                              VALUES ('".$login."', '".date("Y-m-d")."', '".$titulo."', '', 1, 0);";
    $result_log = mysqli_query($DB_connect, $query_log);
}

mysqli_close($DB_connect);
?>