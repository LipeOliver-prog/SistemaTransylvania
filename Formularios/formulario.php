<?php
// Verificação do envio do foormulário
if (isset($_POST['submit'])) {

    include_once('../conexao_dtb/config.php');

//Coleta dos Dados do Formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    $telefone = $_POST['telefone'];
    $sexo = $_POST['genero'];
    $data_nascimento = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $endereco = $_POST['endereco'];
    $especie = $_POST['especie'];

// Montagem e Execução da Consulta SQL
    $query = "INSERT INTO funcionarios(nome, email, senha, telefone, sexo, data_nascimento, cidade, estado, endereco,especie) 
              VALUES ('$nome', '$email', '$senha','$telefone', '$sexo', '$data_nascimento', '$cidade', '$estado', '$endereco', '$especie')";

//Execução da Consulta e Tratamento da Resposta
    if (mysqli_query($conexao, $query)) {
        header('Location: ../funcionarios.php'); // Se o arquivo estiver em um nível acima

        exit();
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário | Funcionários</title>
    <link rel="stylesheet" href="../styleCSS/FORMULARIOS.css">
</head>

<body>

    <!-- Botão de voltar -->
    <div class="buttonVoltar">
        <a href="../Funcionarios.php" class="btnVoltar">Voltar</a>
    </div>

    <div class="box">
        <form action="formulario.php" method="POST">
            <fieldset>
                <legend><b>Formulário de Funcionários</b></legend>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome Completo</label>
                </div>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelInput">E-mail</label>
                </div>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>

                <div class="inputBox">
                    <input type="text" name="especie" id="especie" class="inputUser" required>
                    <label for="especie" class="labelInput">Espécie</label>
                </div>

                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <p>Sexo:</p>
                <input type="radio" id="feminino" name="genero" value="feminino" required>
                <label for="feminino">Feminino</label>
                <input type="radio" id="masculino" name="genero" value="masculino" required>
                <label for="masculino">Masculino</label>
                <input type="radio" id="outros" name="genero" value="outros" required>
                <label for="outros">Outros</label>

                <br>

                <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                <input type="date" name="data_nascimento" id="data_nascimento" required>

                <br>

                <div class="inputBox">
                    <input type="text" name="cidade" id="cidade" class="inputUser" required>
                    <label for="cidade" class="labelInput">Cidade</label>
                </div>
                <div class="inputBox">
                    <input type="text" name="estado" id="estado" class="inputUser" required>
                    <label for="estado" class="labelInput">Estado</label>
                </div>
                <div class="inputBox">
                    <input type="text" name="endereco" id="endereco" class="inputUser" required>
                    <label for="endereco" class="labelInput">Endereço</label>
                </div>
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>
