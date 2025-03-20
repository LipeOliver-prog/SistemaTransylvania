<?php 

if (!empty($_GET['id'])) {
    include_once('../conexao_dtb/config.php'); // Inclui o arquivo de configuração do banco de dados

    $id = intval($_GET['id']); // Garante que o ID seja tratado como um número inteiro

    // Verificar se o cliente existe na tabela 'clientes'
    $sqlSelect = "SELECT * FROM clientes WHERE id=$id";
    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        // Excluir registros relacionados na tabela 'frigobar'
        $sqlDeleteFrigobar = "DELETE FROM frigobar WHERE id_cliente=$id";
        $conexao->query($sqlDeleteFrigobar);

        // Excluir o cliente da tabela 'clientes'
        $sqlDeleteCliente = "DELETE FROM clientes WHERE id=$id";
        $conexao->query($sqlDeleteCliente);
    }
}

// Redirecionar para a página 'clientes.php' após a exclusão
header('Location: ../clientes.php');
?>
