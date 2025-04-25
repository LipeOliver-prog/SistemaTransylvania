<?php
if (!empty($_GET['id'])) {
    include_once('../conexao_dtb/config.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM quartos WHERE idquartos=$id";


    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        while ($quarto_data = mysqli_fetch_assoc($result)) {
            $nome = $quarto_data['nome'];
            $email = $quarto_data['email'];
            $quarto = $quarto_data['quarto'];
            $data_entrada = $quarto_data['data_entrada'];
            $data_saida = $quarto_data['data_saida'];
            $total_preco = $quarto_data['total_preco'];
            $especie = $quarto_data['especie'];
        }
    } else {
        header('Location: ../quartos.php');
        exit();
    }
} else {
    header('Location: ../quartos.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Quarto</title>
    <link rel="stylesheet" href="../styleCSS/FORMULARIOS.css">
</head>
<body>
    <div class="buttonVoltar">
        <a href="../quartos.php" class="btnVoltar">Voltar</a>
    </div>
    <div class="box">
        <form action="../SavesEdit/saveEditQuartos.php" method="POST">
            <fieldset>
                <legend><b>Editar Quarto</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" value="<?php echo $nome; ?>" required>
                    <label for="nome" class="labelInput">Digite Seu Nome Completo</label>
                </div>

                <div class="inputBox">
                    <input type="email" name="email" id="email" class="inputUser" value="<?php echo $email; ?>" required>
                    <label for="email" class="labelInput">Qual Seu E-mail</label>
                </div>

                <div class="inputBox">
                    <input type="text" name="especie" id="especie" class="inputUser" value="<?php echo $especie; ?>" required>
                    <label for="especie" class="labelInput">Qual Sua Espécie?</label>
                </div>

                <br>
                <label for="quarto"><b>Selecione o Quarto:</b></label>
                <select name="quarto" id="quarto" required>
                    <option value="luxo_2_camas" <?php echo ($quarto == 'luxo_2_camas') ? 'selected' : ''; ?>>Quarto de Luxo - 2 Camas - Com Sacada</option>
                    <option value="basico_1_cama" <?php echo ($quarto == 'basico_1_cama') ? 'selected' : ''; ?>>Quarto Básico - 1 Cama - Sem Sacada</option>
                    <option value="luxo_3_camas" <?php echo ($quarto == 'luxo_3_camas') ? 'selected' : ''; ?>>Quarto de Luxo - 3 Camas - Com Sacada</option>
                    <option value="basico_2_camas" <?php echo ($quarto == 'basico_2_camas') ? 'selected' : ''; ?>>Quarto Básico - 2 Camas - Sem Sacada</option>
                    <option value="luxo_1_cama" <?php echo ($quarto == 'luxo_1_cama') ? 'selected' : ''; ?>>Quarto de Luxo - 1 Cama - Sem Sacada</option>
                </select>

                <br><br>
                <div class="inputBox">
                    <input type="date" name="data_entrada" id="data_entrada" class="inputUser" value="<?php echo $data_entrada; ?>" required>
                    <label for="data_entrada" class="labelInput">Data de Entrada</label>
                </div>

                <div class="inputBox">
                    <input type="date" name="data_saida" id="data_saida" class="inputUser" value="<?php echo $data_saida; ?>" required>
                    <label for="data_saida" class="labelInput">Data de Saída</label>
                </div>

                <br>
                <div class="inputBox">
                    <label for="preco">Preço Total: R$</label>
                    <input type="text" name="preco" id="preco" class="inputUser" readonly value="<?php echo $total_preco; ?>" />
                </div>

                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="update" id="update" value="Salvar">
            </fieldset>
        </form>
    </div>
</body>
</html>
