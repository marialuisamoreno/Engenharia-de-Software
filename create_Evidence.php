<?php 
// Conexão com o banco colocar na variável $DB_connect
require_once("databaseconnect.php");

// Get data
$login = $_GET['login'];
$titulo = $_GET['titulo'];
$descricao = $_GET['descricao'];
$status = $_GET['status'];
$projeto = $_GET['projeto'];
$tipo = $_GET['tipo'];

// Verifica se o usuário possui permissão para acesso
$access = 0;
$query_check_user = "SELECT * FROM usuarios WHERE login_usuario = '".$login."'";
$result_check_user = mysqli_query($DB_connect, $query_check_user);
$row = mysqli_fetch_assoc($result_check_user);
if ($row['perfil'] == 'admin' || $row['perfil'] == 'developer' || $row['perfil'] == 'certifier'){
    $access = 1;
}

if ($access){
    /* Verificar informações de tabelas estrangeiras */
    $query_insert_evidence = "INSERT INTO evidencias (titulo, descricao, status, projeto, tipo)
                              VALUES ('".$titulo."', '".$descricao."', '".$status."', '".$projeto."', '".$tipo."');";
    $result_insert_evidence = mysqli_query($DB_connect, $query_insert_evidence);

    // Log
    $query_log = "INSERT INTO log (login, data, projeto, evidencia, insercao, remocao)
                              VALUES ('".$login."', '".date("Y-m-d")."', '".$projeto."', '".$titulo."', 1, 0);";
    $result_log = mysqli_query($DB_connect, $query_log);
}

mysqli_close($DB_connect);
?>