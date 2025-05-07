<?php 
session_start();
include_once('../conexao_dtb/config.php');

if (empty($_GET['id'])) {
    header('Location: ../quartos.php');
    exit();
}

$id = intval($_GET['id']);
$sqlSelect = "SELECT * FROM quartos WHERE idquartos = {$id}";
$result    = $conexao->query($sqlSelect);

if ($result->num_rows === 0) {
    header('Location: ../quartos.php');
    exit();
}

$quarto_data      = $result->fetch_assoc();
$nome             = $quarto_data['nome'];
$cpf              = $quarto_data['cpf'];
$quarto           = $quarto_data['quarto'];
$data_entrada     = $quarto_data['data_entrada'];
$data_saida       = $quarto_data['data_saida'];
$total_preco      = $quarto_data['total_preco'];
$especie          = $quarto_data['especie'];

// Decodifica JSON de personalizações
$personalizacoes = json_decode($quarto_data['personalizacoes'], true);
if (!is_array($personalizacoes)) {
    $personalizacoes = [];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
          <input type="text" name="nome" id="nome" class="inputUser" 
                 value="<?= htmlspecialchars($nome) ?>" required>
          <label for="nome" class="labelInput">Digite Seu Nome Completo</label>
        </div>

        <div class="inputBox">
          <input type="text" name="cpf" id="cpf" class="inputUser" 
                 value="<?= htmlspecialchars($cpf) ?>" required>
          <label for="cpf" class="labelInput">CPF</label>
        </div>

        <div class="inputBox">
          <input type="text" name="especie" id="especie" class="inputUser" 
                 value="<?= htmlspecialchars($especie) ?>" required>
          <label for="especie" class="labelInput">Qual Sua Espécie?</label>
        </div>

        <!-- Personalizações -->
        <br>
        <label><b>Personalizações (opcional):</b></label>
        <div id="custom-container">
          <?php if (empty($personalizacoes)): ?>
            <div class="custom-input">
              <input type="text" name="personalizacoes[]" placeholder="Digite aqui...">
            </div>
          <?php else: ?>
            <?php foreach ($personalizacoes as $item): ?>
              <div class="custom-input">
                <input type="text" name="personalizacoes[]" 
                       value="<?= htmlspecialchars($item) ?>">
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
        <button type="button" id="add-custom">➕ Adicionar mais</button>

        <br><br>
        <label for="quarto"><b>Selecione o Quarto:</b></label>
        <select name="quarto" id="quarto" required>
          <option value="luxo_2_camas"  <?= $quarto==='luxo_2_camas'  ? 'selected':'' ?>>Quarto de Luxo - 2 Camas</option>
          <option value="basico_1_cama" <?= $quarto==='basico_1_cama' ? 'selected':'' ?>>Quarto Básico - 1 Cama</option>
          <option value="luxo_3_camas"  <?= $quarto==='luxo_3_camas'  ? 'selected':'' ?>>Quarto de Luxo - 3 Camas</option>
          <option value="basico_2_camas"<?= $quarto==='basico_2_camas'? 'selected':'' ?>>Quarto Básico - 2 Camas</option>
          <option value="luxo_1_cama"   <?= $quarto==='luxo_1_cama'   ? 'selected':'' ?>>Quarto de Luxo - 1 Cama</option>
        </select>

        <br><br>
        <div class="inputBox">
          <input type="date" name="data_entrada" id="data_entrada" class="inputUser" 
                 value="<?= $data_entrada ?>" required>
          <label for="data_entrada" class="labelInput">Data de Entrada</label>
        </div>

        <div class="inputBox">
          <input type="date" name="data_saida" id="data_saida" class="inputUser" 
                 value="<?= $data_saida ?>" required>
          <label for="data_saida" class="labelInput">Data de Saída</label>
        </div>

        <br>
        <div class="inputBox">
          <label for="preco">Preço Total: R$</label>
          <input type="text" name="preco" id="preco" class="inputUser" readonly 
                 value="<?= number_format($total_preco,2,',','.') ?>" />
        </div>

        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="submit" name="update" id="update" value="Salvar">
      </fieldset>
    </form>
  </div>

  <script>
    document.getElementById('add-custom').addEventListener('click', function() {
      const container = document.getElementById('custom-container');
      const novo = container.querySelector('.custom-input').cloneNode(true);
      novo.querySelector('input').value = '';
      container.appendChild(novo);
    });
  </script>
</body>
</html>
