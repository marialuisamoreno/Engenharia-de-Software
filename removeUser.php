<?php
// Conexão com o banco
require_once("databaseconnect.php");

// GET information
$id = $_GET['id'];

// Tratamento de dados
$id_array = explode("-", $id);
foreach($id_array as $i){
    // Remove information
    $query_delete = "DELETE FROM usuarios WHERE id = '".$i."'";
    $rs_delete = mysqli_query($DB_connect, $query_delete);
}

mysqli_close($DB_connect);
?>