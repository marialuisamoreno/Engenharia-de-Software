<?php
// Conexão com o banco
require_once("databaseconnect.php");

// GET information
$id = $_GET['id'];
$login = $_GET['login'];

// Tratamento de dados
$id_array = explode("-", $id);
foreach($id_array as $i){
    if($i != ''){
        // Pegar informações para o log
        $query_select = "SELECT * FROM projetos WHERE id = '".$i."'";
        $result_select = mysqli_query($DB_connect, $query_select);
        $row = mysqli_fetch_assoc($result_select);
        $projeto = $row['titulo'];

        // Log
        $query_log = "INSERT INTO log (login, data, projeto, evidencia, insercao, remocao)
        VALUES ('".$login."', '".date("Y-m-d")."', '".$projeto."', '', 0, 1);";
        $result_log = mysqli_query($DB_connect, $query_log);

        // Remove information
        $query_delete = "DELETE FROM projetos WHERE id = '".$i."'";
        $rs_delete = mysqli_query($DB_connect, $query_delete);

        // Remover evidencias do projeto
        $query_evidencias = "SELECT * FROM evidencias WHERE projeto = '".$projeto."'";
        $rs_evidencias = mysqli_query($DB_connect, $query_evidencias);
        while($row = mysqli_fetch_assoc($rs_evidencias)){
            $query_delete = "DELETE FROM evidencias WHERE id = '".$row['id']."'";
            $rs_delete = mysqli_query($DB_connect, $query_delete);

            // Log
            $query_log = "INSERT INTO log (login, data, projeto, evidencia, insercao, remocao)
            VALUES ('".$login."', '".date("Y-m-d")."', '".$projeto."', '".$row['titulo']."', 0, 1);";
            $result_log = mysqli_query($DB_connect, $query_log);
        }
    }
}

mysqli_close($DB_connect);
?>