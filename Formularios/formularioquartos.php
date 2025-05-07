<?php
session_start();
include_once('../conexao_dtb/config.php');

// === BUSCA DE CLIENTE POR ID ===
if (isset($_POST['buscar_cliente'])) {
    $id_busca = mysqli_real_escape_string($conexao, $_POST['id_busca']);
    $sql_busca = "
        SELECT nome, cpf
        FROM clientes
        WHERE id = '{$id_busca}'
        LIMIT 1
    ";
    $res_busca = $conexao->query($sql_busca);

    if ($res_busca && $res_busca->num_rows > 0) {
        $cliente = $res_busca->fetch_assoc();
    } else {
        $erro = "Cliente com ID {$id_busca} não encontrado!";
    }
}

// === PROCESSA O CADASTRO E CÁLCULO DO PREÇO ===
if (isset($_POST['submit'])) {
    // Captura e sanitiza dados básicos
    $nome          = mysqli_real_escape_string($conexao, $_POST['nome_cliente']);
    $cpf           = mysqli_real_escape_string($conexao, $_POST['cpf_cliente']);
    $especie       = mysqli_real_escape_string($conexao, $_POST['especie']);
    $quarto        = mysqli_real_escape_string($conexao, $_POST['quarto']);
    $data_entrada  = $_POST['data_entrada'];
    $data_saida    = $_POST['data_saida'];

    // Captura personalizações opcionais e converte pra JSON
    $personalizacoes_raw = $_POST['personalizacoes'] ?? [];
    $lista_trimmed = array_filter(array_map('trim', $personalizacoes_raw), function($v){ return $v !== ''; });
    $json_personalizacoes = mysqli_real_escape_string(
        $conexao,
        json_encode(array_values($lista_trimmed), JSON_UNESCAPED_UNICODE)
    );

    // Preço por noite
    switch ($quarto) {
        case 'luxo_2_camas':   $preco_por_noite = 200; break;
        case 'basico_1_cama':  $preco_por_noite = 100; break;
        case 'luxo_3_camas':   $preco_por_noite = 250; break;
        case 'basico_2_camas': $preco_por_noite = 150; break;
        case 'luxo_1_cama':    $preco_por_noite = 180; break;
        default:               $preco_por_noite = 0;
    }

    // Cálculo de dias
    $dias = (strtotime($data_saida) - strtotime($data_entrada)) / 86400;
    if ($dias <= 0) {
        die("Erro: data de saída deve ser posterior à de entrada.");
    }
    $total_preco = $preco_por_noite * $dias;

    // Insere no banco com JSON de personalizações
    $ins = "
      INSERT INTO quartos
        (nome, cpf, especie, quarto, data_entrada, data_saida, total_preco, personalizacoes)
      VALUES
        ('{$nome}','{$cpf}','{$especie}','{$quarto}','{$data_entrada}','{$data_saida}','{$total_preco}','{$json_personalizacoes}')
    ";

    if ($conexao->query($ins)) {
        header('Location: ../quartos.php');
        exit;
    } else {
        echo "Erro ao cadastrar: " . $conexao->error;
    }
}
?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Formulário de Quartos</title>
  <link rel="stylesheet" href="../styleCSS/FORMULARIOS.css">
</head>
<body>
  <div class="buttonVoltar">
    <a href="../quartos.php" class="btnVoltar">Voltar</a>
  </div>

  <div class="box">
    <!-- FORM DE BUSCA -->
    <legend><b>Formulário de Quartos</b></legend>
    <br>
    <form action="formularioquartos.php" method="POST" class="buscaCliente">
      <label for="id_busca">Buscar Cliente pelo ID:</label>
      <input type="text" name="id_busca" id="id_busca" required>
      <button type="submit" name="buscar_cliente" class="btnBuscar">Buscar</button>
      <?php if (isset($erro)): ?>
        <p class="erroBusca"><?= $erro ?></p>
      <?php endif; ?>
    </form>

<!-- FORM DE CADASTRO -->
<form action="formularioquartos.php" method="POST">
  <fieldset>

    <label for="nome_cliente">Nome do Cliente:</label>
    <input
      type="text" name="nome_cliente" id="nome_cliente"
      value="<?= htmlspecialchars($cliente['nome'] ?? '') ?>"
      required
    ><br><br>

    <label for="cpf_cliente">CPF do Cliente:</label>
    <input
      type="text" name="cpf_cliente" id="cpf_cliente"
      value="<?= htmlspecialchars($cliente['cpf'] ?? '') ?>"
      required
    ><br><br>

    <div class="inputBox">
      <input type="text" name="especie" id="especie" class="inputUser" required>
      <label for="especie" class="labelInput">Qual Sua Espécie?</label>
    </div>

    <!-- Campos de personalização dinâmica -->
    <br>
    <label><b>Personalizações (opcional):</b></label>
    <div id="custom-container">
      <div class="custom-input">
        <input type="text" name="personalizacoes[]" placeholder="Digite aqui...">
      </div>
    </div>
    <button type="button" id="add-custom">➕ Adicionar mais</button>

    <br><br>
    <label for="quarto"><b>Selecione o Quarto:</b></label>
    <select name="quarto" id="quarto" required>
      <option value="" disabled selected>Escolha uma opção</option>
      <option value="luxo_2_camas">Luxo – 2 Camas</option>
      <option value="basico_1_cama">Básico – 1 Cama</option>
      <option value="luxo_3_camas">Luxo – 3 Camas</option>
      <option value="basico_2_camas">Básico – 2 Camas</option>
      <option value="luxo_1_cama">Luxo – 1 Cama</option>
    </select>

    <br><br>
    <div class="inputBox">
      <input type="date" name="data_entrada" id="data_entrada" class="inputUser" required>
      <label for="data_entrada" class="labelInput">Data de Entrada</label>
    </div>

    <div class="inputBox">
      <input type="date" name="data_saida" id="data_saida" class="inputUser" required>
      <label for="data_saida" class="labelInput">Data de Saída</label>
    </div>

    <br>
    <div class="inputBox">
      <label for="preco">Preço Total: R$</label>
      <input
        type="text" name="preco" id="preco" class="inputUser" readonly
        value="<?= isset($total_preco) ? number_format($total_preco,2,',','.') : '' ?>"
      />
    </div>

    <input type="submit" name="submit" id="submit" value="Cadastrar">
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