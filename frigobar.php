<?php
// Inicia a sessão para gerenciar dados do usuário
session_start();

// Inclui o arquivo de conexão com o banco de dados
include_once('conexao_dtb/config.php');

// Verifica se o usuário está logado. Se não estiver, redireciona para a página de login
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);  // Remove os dados de sessão
    unset($_SESSION['senha']);  // Remove os dados de sessão
    header('Location: login.php');  // Redireciona para a página de login
    exit();  // Encerra o script
}

// A variável $logado recebe o e-mail do usuário logado
$logado = $_SESSION['email'];

// Verifica se há uma busca pelo cliente
if (!empty($_GET['search'])) {
    $data = $_GET['search'];  // Recebe o valor de busca
    // Monta a consulta para buscar clientes por id, nome ou email
    $sql = "SELECT * FROM clientes WHERE id LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' ORDER BY id DESC";
} else {
    // Caso não haja busca, seleciona todos os clientes ordenados por id
    $sql = "SELECT * FROM clientes ORDER BY id DESC";
}

// Executa a consulta no banco de dados
$result = $conexao->query($sql);

// Processamento da busca de cliente pelo ID
if (isset($_POST['buscar_cliente'])) {
    $id_busca = $_POST['id_busca'];  // Recebe o ID enviado pelo formulário de busca
    $query = "SELECT * FROM clientes WHERE id = '$id_busca'";  // Consulta para buscar o cliente pelo ID
    $result = $conexao->query($query);  // Executa a consulta

    // Verifica se o cliente foi encontrado
    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();  // Recupera os dados do cliente
    } else {
        $erro = "Cliente não encontrado!";  // Mensagem de erro caso o cliente não seja encontrado
    }
}

// Processamento do cadastro de itens no frigobar
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['salvar_frigobar'])) {
    // Recebe os dados do cliente e dos itens do frigobar
    $id_cliente = $_POST['id_cliente'];
    $nome_cliente = $_POST['nome_cliente'];
    $cpf_cliente = $_POST['cpf_cliente'];
    
    // Quantidades dos itens recebidos no formulário
    $quantidades = [
        'agua' => $_POST['agua'] ?? 0,
        'cerveja' => $_POST['cerveja'] ?? 0,
        'refrigerante' => $_POST['refrigerante'] ?? 0,
        'suco' => $_POST['suco'] ?? 0,
        'sangue' => $_POST['sangue'] ?? 0,
        'hamburger' => $_POST['hamburger'] ?? 0,
        'chocolate' => $_POST['chocolate'] ?? 0,
        'cachorro_quente' => $_POST['cachorro_quente'] ?? 0,
        'bala_fini' => $_POST['bala_fini'] ?? 0,
        'gelatina' => $_POST['gelatina'] ?? 0,
        'manteiga' => $_POST['manteiga'] ?? 0,
        'carne_vermelha' => $_POST['carne_vermelha'] ?? 0,
        'carne_branca' => $_POST['carne_branca'] ?? 0

    ];

    // Preços dos itens do frigobar
    $prices = [
        'agua' => 2.50,
        'cerveja' => 5.00,
        'refrigerante' => 3.00,
        'suco' => 4.00,
        'sangue' => 3.50,
        'hamburger' => 25.00,
        'chocolate' => 10.00,
        'cachorro_quente' => 12.00,
        'bala_fini' => 5.00,
        'gelatina' => 7.00,
        'manteiga' => 9.00,
        'carne_vermelha' => 18.00,
        'carne_branca' => 16.00
    ];

    $valor_total = 0;  // Inicializa o valor total
    $resumo = "";  // Inicializa o resumo dos itens

    // Loop para calcular o valor total e montar o resumo dos itens
    foreach ($quantidades as $item => $quantity) {
        if ($quantity > 0) {  // Se a quantidade for maior que zero
            // Calcula o valor do item
            $valor = $quantity * $prices[$item];
            $valor_total += $valor;  // Soma o valor do item ao total
            $resumo .= "$item: $quantity unidades (R$ " . number_format($valor, 2, ',', '.') . ")<br>";  // Adiciona o resumo do item

            // Insere os dados dos itens no banco de dados
            $query_inserir = "INSERT INTO frigobar (id_cliente, nome_cliente, cpf_cliente, item, quantidade, valor,valor_total)
                              VALUES ('$id_cliente', '$nome_cliente', '$cpf_cliente', '$item', '$quantity', '$valor', '$valor_total')";
            $conexao->query($query_inserir);  // Executa a inserção no banco
        }
    }

    // Verifica se houve itens adicionados ao frigobar
    if ($resumo) {
        // Exibe o resumo e o valor total
        $resumo .= "<strong>Valor Total: R$ " . number_format($valor_total, 2, ',', '.') . "</strong>";
        $mensagem = "Itens do frigobar adicionados com sucesso!<br>$resumo";
    } else {
        // Caso nenhum item tenha sido selecionado
        $mensagem = "Nenhum item foi selecionado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frigobar</title>
    <link rel="stylesheet" href="styleCSS/FRIGOBAR.css">
</head>

<body>

    <header class="header">
        <!-- Logo do site com link para a página inicial -->
        <a href="Home.php" class="logo">
            <img src="img/brasaoHT.png" alt="logo">
        </a>

        <!-- Barra de navegação -->
        <nav class="navbar">
            <a href="Home.php">Home</a>
            <a href="Funcionarios.php">Funcionarios</a>
            <a href="Quartos.php">Quartos</a>
            <a href="Clientes.php">Clientes</a>
            <a href="frigobar.php" class="active">Frigobar</a>
            <a href="pagamento.php">Pagamento</a>
        </nav>

        <!-- Exibe o e-mail do usuário logado -->
        <div class="bemVindo">
            <?php
            echo "<p>Bem Vindo</p> <u>$logado</u>";
            ?>
        </div>

        <!-- Botão de logout -->
        <div class="buttonSair">
            <a href="sair.php" class="btnSair">Sair</a>
        </div>
    </header>

    <section class="form">
        <h1>Cadastro de Itens do Frigobar</h1>
        <!-- Formulário de busca de cliente pelo ID -->
        <form method="POST">
            <label for="id_busca" class="buscas">Buscar Cliente pelo ID:</label>
            <input type="text" id="id_busca" name="id_busca" required>
            <button type="submit" name="buscar_cliente" class="btn-buscar">Buscar</button>
        </form>

        <!-- Exibe mensagens de erro ou sucesso -->
        <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
        <?php if (isset($mensagem)) echo "<p style='color:green;'>$mensagem</p>"; ?>

        <!-- Exibe o formulário de cadastro de itens do frigobar, caso o cliente tenha sido encontrado -->
        <?php if (isset($cliente)): ?>
            <form method="POST" class="form-itens">
                <div class="infos">
                    <input type="hidden" name="id_cliente" value="<?= $cliente['id'] ?>">
                    <label for="nome_cliente">Nome:</label>
                    <input type="text" name="nome_cliente" value="<?= $cliente['nome'] ?>" readonly>
                    <label for="cpf_cliente">CPF:</label>
                    <input type="text" name="cpf_cliente" value="<?= $cliente['cpf'] ?>" readonly><br><br>

                    <!-- Campos para selecionar as quantidades dos itens -->
                    <label for="agua">Água (R$ 2,50 cada):</label>
                    <input type="number" id="agua" name="agua" min="0" value="0">
                    <label for="cerveja">Cerveja (R$ 5,00 cada):</label>
                    <input type="number" id="cerveja" name="cerveja" min="0" value="0">
                    <label for="refrigerante">Refrigerante (R$ 3,00 cada):</label>
                    <input type="number" id="refrigerante" name="refrigerante" min="0" value="0">
                    <label for="suco">Suco (R$ 4,00 cada):</label>
                    <input type="number" id="suco" name="suco" min="0" value="0"><br><br>
                    <label for="sangue">Sangue (R$ 3,50 cada):</label>
                    <input type="number" id="suco" name="suco" min="0" value="0"><br><br>
                    <label for="hamburger">Hamburger (R$ 25,00 cada):</label>
                    <input type="number" id="suco" name="suco" min="0" value="0"><br><br>
                    <label for="chocolate">Chocolate (R$ 10,00 cada):</label>
                    <input type="number" id="suco" name="suco" min="0" value="0"><br><br>
                    <label for="cachorro_quente">Cachorro Quente (R$ 12,00 cada):</label>
                    <input type="number" id="suco" name="suco" min="0" value="0"><br><br>
                    <label for="bala_fini">Bala Fini(R$ 5,00 cada):</label>
                    <input type="number" id="suco" name="suco" min="0" value="0"><br><br>
                    <label for="gelatina">Gelatina (R$ 7,00 cada):</label>
                    <input type="number" id="suco" name="suco" min="0" value="0"><br><br>
                    <label for="manteiga">Manteiga (R$ 9,00 cada):</label>
                    <input type="number" id="suco" name="suco" min="0" value="0"><br><br>
                    <label for="carne_vermelha">Carne Vermelha (R$ 18,00 cada):</label>
                    <input type="number" id="suco" name="suco" min="0" value="0"><br><br>
                    <label for="carne_branca">Carne Branca (R$ 16,00 cada):</label>
                    <input type="number" id="suco" name="suco" min="0" value="0"><br><br>

                    <!-- Botão para salvar os itens -->
                    <button type="submit" name="salvar_frigobar" class="btn-salvar">Salvar Itens</button>
                </div>
            </form>
        <?php endif; ?>

        <!-- Botão de voltar para a página inicial -->
        <div class="button-voltar">
            <a href="Home.php" class="btn-voltar">Voltar para Início</a>
        </div>
    </section>

</body>

</html>
