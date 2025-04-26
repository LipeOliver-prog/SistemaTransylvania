<?php
session_start(); // Inicia a sessão para armazenar variáveis globais

include_once('conexao_dtb/config.php'); // Conexão com o banco de dados

// Verificação de login: impede acesso sem autenticação
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php'); // Redireciona para a página de login se não estiver logado
}
$logado = $_SESSION['email']; // Armazena o e-mail do usuário logado

// Pesquisa de clientes (se houver um termo de busca)
if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM clientes WHERE id LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM clientes ORDER BY id DESC";
}
$result = $conexao->query($sql); // Executa a consulta no banco

// Busca de cliente pelo ID (quando usuário insere ID manualmente)
// Busca de cliente pelo ID (quando usuário insere ID manualmente)
if (isset($_POST['buscar_cliente'])) {
    $id_busca = $_POST['id_busca'];

    // 1) busca os dados do cliente
    $query = "SELECT * FROM clientes WHERE id = '$id_busca'";
    $result = $conexao->query($query);

    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();

        // 2) busca o valor total do frigobar para esse cliente
        $sql2 = "
          SELECT 
            MAX(valor_total) AS valor_frigobar 
          FROM frigobar 
          WHERE id_cliente = '$id_busca'
        ";
        $res2 = $conexao->query($sql2); 
        if ($res2 && $res2->num_rows > 0) {
            $row2 = $res2->fetch_assoc();
            $valor_frigobar = $row2['valor_frigobar'];
        } else {
            $valor_frigobar = 0;
        }

    } else {
        $erro = "Cliente não encontrado!";
    }
}


// Geração de boletos
if (isset($_POST['gerar_boleto'])) {
    // Obtém os dados do formulário
    $nome_cliente   = $_POST['nome_cliente'];
    $cpf_cliente    = $_POST['cpf_cliente'];
    $vencimento     = $_POST['vencimento'];
    $valor_boleto   = floatval($_POST['valor']); // Converte valor para float
    $valor_frigobar = floatval($_POST['valor_frigobar']); // Converte valor para float

    // Soma dos valores do boleto + frigobar
    $valor_total = $valor_boleto + $valor_frigobar;
    $nosso_numero = $_POST['nosso_numero']; // Identificador do boleto
    $codigo_banco = $_POST['codigo_banco']; // Código do banco emissor

    // Opcional: Insere os dados do boleto na tabela 'boletos' no banco de dados
    
    $query_inserir = "INSERT INTO boletos (nome_cliente, cpf_cliente, vencimento, valor, nosso_numero, codigo_banco) 
                      VALUES ('$nome_cliente', '$cpf_cliente', '$vencimento', '$valor_total', '$nosso_numero', '$codigo_banco')";
    $conexao->query($query_inserir);
    

    // Formata o valor total para exibição no formato R$ X,XX
    $valor_formatado = "R$ " . number_format($valor_total, 2, ',', '.');

    // Armazena os dados do boleto na sessão para serem exibidos em outro arquivo.
    $_SESSION['boleto'] = [
        'nome_cliente'       => $nome_cliente,
        'cpf_cliente'        => $cpf_cliente,
        'vencimento'         => $vencimento,
        'valor_frigobar'     => $valor_frigobar,
        'valor_formatado'    => $valor_formatado,
        'nosso_numero'       => $nosso_numero,
        'codigo_banco'       => $codigo_banco
    ];

    // Redireciona para a página que exibe o boleto
    header("Location: boleto.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar Boleto</title>
    <link rel="stylesheet" href="styleCSS/PAGAMENTOS.css">
</head>
<body>
    <header class="header">
        <a href="Home.php" class="logo">
            <img src="img/brasaoHT.png" alt="logo">
        </a>
        <nav class="navbar">
            <a href="Home.php">Home</a>
            <a href="Funcionarios.php">Funcionarios</a>
            <a href="Quartos.php">Quartos</a>
            <a href="Clientes.php">Clientes</a>
            <a href="frigobar.php">Frigobar</a>
            <a href="pagamento.php" class="active">Pagamento</a>
        </nav>
        <div class="bemVindo">
            <?php
            echo "<p>Bem vindo</p> <u>$logado</u>";
            ?>
        </div>
        <div class="buttonSair">
            <a href="sair.php" class="btnSair">Sair</a>
        </div>
    </header>

    <h1>Preencha os Dados para Gerar o Boleto</h1>

    <!-- Buscar cliente -->
    <form action="" method="POST">
        <label for="id_busca">Buscar Cliente pelo ID:</label>
        <input type="text" name="id_busca" id="id_busca" required>
        <button type="submit" name="buscar_cliente">Buscar</button>
    </form>

    <?php if (isset($erro)) {
        echo "<p style='color:red;'>$erro</p>";
    } ?>
    <!-- teste commit -->

    <!-- Formulário do boleto -->
    <form action="" method="POST">
        <label for="nome_cliente">Nome do Cliente:</label>
        <input type="text" name="nome_cliente" id="nome_cliente" value="<?= $cliente['nome'] ?? '' ?>" required><br><br>

        <label for="cpf_cliente">CPF do Cliente:</label>
        <input type="text" name="cpf_cliente" id="cpf_cliente" value="<?= $cliente['cpf'] ?? '' ?>" required><br><br>

        <label for="vencimento">Data de Vencimento:</label>
        <input type="date" name="vencimento" id="vencimento" required ><br><br>

        <label for="valor">Valor do Boleto:</label>
        <input type="text" name="valor" id="valor" required autocomplete="off"><br><br>

        <label for="valor_frigobar">Valor do Frigobar:</label>

        <!-- Display formatado, somente leitura -->
        <label for="valor_frigobar_display">Valor do Frigobar:</label>
        <input 
        type="text" 
        id="valor_frigobar_display" 
        value="<?= isset($valor_frigobar) 
          ? 'R$ ' . number_format($valor_frigobar, 2, ',', '.')     : '' ?>" 
        readonly
        ><br><br>

        <!-- Campo oculto que realmente será enviado ao servidor -->
        <input 
        type="hidden" 
        name="valor_frigobar" 
        value="<?= isset($valor_frigobar) ? $valor_frigobar : 0 ?>"
        >


        <label for="nosso_numero">Nosso Número:</label>
        <input type="text" name="nosso_numero" id="nosso_numero" required autocomplete="off"><br><br>

        <label for="codigo_banco">Código do Banco:</label>
        <input type="text" name="codigo_banco" id="codigo_banco" required autocomplete="off"><br><br>

        <button type="submit" name="gerar_boleto">Gerar Boleto</button>

        <div class="button-voltar">
            <a href="Home.php" class="btn-voltar">Voltar para Início</a>
        </div>
    </form>
</body>
</html>
