
<?php 
ob_start();
include_once('../conexao_dtb/config.php');

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Verificar se o ID existe no banco antes de deletar
    $sqlSelect = "SELECT * FROM funcionarios WHERE id = ?";
    $stmt = $conexao->prepare($sqlSelect);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // ID encontrado, pode deletar
        $sqlDelete = "DELETE FROM funcionarios WHERE id = ?";
        $stmtDelete = $conexao->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $id);
        $stmtDelete->execute();

        if ($stmtDelete->affected_rows > 0) {
            header("Location: ../Funcionarios.php");
            exit();
        } else {
            echo "Erro ao excluir o funcionário.";
        }
    } else {
        echo "Funcionário não encontrado.";
    }
} else {
    echo "ID não especificado.";
}
?>