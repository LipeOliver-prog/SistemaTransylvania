<?php
session_start();

// Verifica se os dados do boleto foram enviados via sessão
if (!isset($_SESSION['boleto'])) {
    header("Location: pagamento.php");
    exit;
}

$boleto = $_SESSION['boleto'];
// Opcional: Limpa os dados da sessão para evitar reexibição indesejada
unset($_SESSION['boleto']);

// Atribui as variáveis para facilitar
$nome_cliente    = $boleto['nome_cliente'];
$cpf_cliente     = $boleto['cpf_cliente'];
$vencimento      = $boleto['vencimento'];
$valor_frigobar  = $boleto['valor_frigobar'];
$valor_formatado = $boleto['valor_formatado'];
$nosso_numero    = $boleto['nosso_numero'];
$codigo_banco    = $boleto['codigo_banco'];

// Código de barras simulado
$codigo_barras_fake = "| || ||| ||||| |||| | || ||| | || |||| |||";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visualização do Boleto</title>
    <link rel="stylesheet" href="styleCSS/boleto.css">
</head>
<body>
    <header class="header">
        <a href="Home.php" class="logo">
            <img src="img/brasaoHT.png" alt="logo">
        </a>
       
    </header>

    <h3>Visualização do Boleto</h3>
    <div style="border: 1px solid #000; padding: 20px; width: 600px; margin-top: 20px;" id="bole">
        <h4>Banco: <?php echo $codigo_banco; ?></h4>
        <p><strong>Nosso Número: </strong><?php echo $nosso_numero; ?></p>
        <p><strong>Cliente: </strong><?php echo $nome_cliente; ?></p>
        <p><strong>CPF: </strong><?php echo $cpf_cliente; ?></p>
        <p><strong>Vencimento: </strong><?php echo $vencimento; ?></p>
        <p><strong>Valor Frigobar: </strong><?php echo $valor_frigobar; ?></p>
        <p><strong>Valor Total: </strong><?php echo $valor_formatado; ?></p>
        <p><strong>Código de barras: </strong><span style="font-family: monospace;"><?php echo $codigo_barras_fake; ?></span></p>
    </div>

    
</body>
</html>
