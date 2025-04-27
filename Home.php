<?php
session_start();
include_once('conexao_dtb/config.php');
// print_r($_SESSION);
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
}
$logado = $_SESSION['email'];
if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM funcionarios WHERE id LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM funcionarios ORDER BY id DESC";
}
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="styleCSS/HOME.css">
   

</head>

        <!-- Logo do Site -->
        <body>
            <header class="header">
            <a href="Home.php" class="logo">
                <img src="img/brasaoHT.png" alt="logo">
            </a>

        <!-- Botões de Navegação -->
        <nav class="navbar">
            <a href="Home.php" class="active">Home</a>
            <a href="Funcionarios.php">Funcionarios</a>
            <a href="quartos.php">Quartos</a>
            <a href="Clientes.php">Clientes</a>
            <a href="frigobar.php">Frigobar</a>
            <a href="pagamento.php">Pagamento</a>
            
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

        
        <section class="home">
        
        <!-- Filtro para os quartos -->
        <div class="filter">
            <h2>Filtrar Quartos</h2>
            <div class="Type">
                <label>Tipo de Quarto:</label>
                <select id="roomType">
                    <option value="all">Todos</option>
                    <option value="luxo">Luxo</option>
                    <option value="basico">Básico</option>
                </select>
            </div>
            <div class="Type">
                <label>Camas:</label>
                <select id="beds">
                    <option value="all">Todas</option>
                    <option value="1">1 cama</option>
                    <option value="2">2 camas</option>
                    <option value="3">3 camas</option>
                </select>
            </div>
            <div class="Type">
                <label>Sacada:</label>
                <select id="balcony">
                    <option value="all">Todas</option>
                    <option value="true">Com sacada</option>
                    <option value="false">Sem sacada</option>
                </select>
            </div>

            <button class="btn3" onclick="filterRooms()">Filtrar</button>
            </div>


<<<<<<< Updated upstream
        <div class="buttonCadastro">
            <a href="formularios/formulariocliente.php" class="boxCadastro">Cadastro Cliente</a>
        </div>
        
        <?php include 'card.php'; ?>
=======
        
            <!-- Inclusão do Card -->
            <?php include 'card.php'; ?>
>>>>>>> Stashed changes



       
    </section>

</body>

</html>