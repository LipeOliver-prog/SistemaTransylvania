<?php

if (!empty($_GET['id'])) {
    include_once('../conexao_dtb/config.php');

    $id = $_GET['id'];

    // Use o nome correto da coluna (idquartos)
    $sqlSelect = "SELECT * FROM quartos WHERE idquartos=$id";

    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        $sqlDelete = "DELETE FROM quartos WHERE idquartos=$id";
        $resultDelete = $conexao->query($sqlDelete);
    }
}
header('Location: ../quartos.php');
?>
