<?php

if (isset($_POST['submit'])) {

    
   
    include_once('../conexao_dtb/config.php');

    //Coleta dos Dados do Formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $sexo = $_POST['genero'];
    $data_nascimento = $_POST['data_nascimento'];
    $endereco = $_POST['endereco'];


    // Montagem e Execução da Consulta SQL
    $result = mysqli_query($conexao, "INSERT INTO clientes(nome, email, cpf,telefone, sexo, data_nascimento, endereco) values('$nome', '$email', '$cpf','$telefone', '$sexo', '$data_nascimento', '$endereco')");

    header('Location: ../clientes.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Formulário | Clientes </title>

    <link rel="stylesheet" href="../styleCSS/FORMULARIOS.css">
</head>

<body>
    <div class="buttonVoltar">
        <a href="Clientes.php" class="btnVoltar">Voltar</a>
    </div>
    <div class="box">
        <form action="formulariocliente.php" method="POST">
            <fieldset>
                <legend><b>Formulário de Clientes</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required autocomplete="off">
                    <label for="nome" class="labelInput">Nome Completo</label>
                    <br>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required autocomplete="off">
                    <label for="email" class="labelInput">E-mail</label>
                    <br>

                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" class="inputUser" required autocomplete="off">
                    <label for="cpf" class="labelInput">CPF</label>
                    <br>
                    <br><br>
                    <div class="inputBox">
                        <input type="tel" name="telefone" id="telefone" class="inputUser" required autocomplete="off">
                        <label for="telefone" class="labelInput">Telefone</label>

                    </div>

                    <br>
                    <p>Sexo:</p>
                    <input type="radio" id="feminino" name="genero" value="feminino" required>
                    <label for="feminino">Feminino</label>
                    <br>
                    <input type="radio" id="masculino" name="genero" value="masculino" required>
                    <label for="masculino">Masculino</label>
                    <br>
                    <input type="radio" id="outros" name="genero" value="outros" required>
                    <label for="outros">Outros</label>
                    <br><br>

                    <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                    <input type="date" name="data_nascimento" id="data_nascimento" required>

                    <br><br><br>

                    <br>
                    <br><br>
                    <div class="inputBox">
                        <input type="text" name="endereco" id="endereco" class="inputUser" required autocomplete="off">
                        <label for="endereco" class="labelInput">Endereço</label>
                    </div>
                    <br>
                    <br><br>
                    <input type="submit" name="submit" id="submit">

            </fieldset>

        </form>
    </div>
</body>

</html>