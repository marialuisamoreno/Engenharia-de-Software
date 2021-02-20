<?php
// Conexão com o banco
require_once("databaseconnect.php");

// GET informações do usuario
$user = $_GET['username'];
$senha = md5($_GET['password']);

// Search information
$query_search = "SELECT * FROM usuarios WHERE login_usuario = '".$user."' AND senha = '".$senha."'";
$rs_search = mysqli_query($DB_connect, $query_search);
$num_rows = mysqli_num_rows($rs_search);

if ($num_rows){
    echo "OK";
}

mysqli_close($DB_connect);
?>