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
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
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

    <!-- Aba de Navegação do explorer -->
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

        <!-- Formulário -->
        <div class="box">
            <form action="formulario.php" method="POST">
                <fieldset>
                    <!-- Tiutulo do Formulário -->
                    <legend><b>Formulário de Funcionários</b></legend>

                    <!-- Box de Nome -->
                    <div class="inputBox">
                        <input type="text" name="nome" id="nome" placeholder="Digite Seu Nome Completo" required>
                        <br>
                    </div>

                    <!-- Box de Email -->
                    <div class="inputBox">
                        <input type="text" name="email" id="email" placeholder="Digite Seu E-Mail" required>
                        <br>
                    </div>

                    <!-- Box de Senha -->
                    <div class="inputBox">
                        <input type="password" name="senha" id="senha" placeholder="Digite Sua Senha" required>
                        <br>
                    </div>

                    <!-- Box de Espécie-->
                    <div class="inputBox">
                        <input type="text" name="especie" id="especie" placeholder="Digite Sua Espécie" required>
                        <br>
                    </div>

                    <!-- Box de Telefone -->
                    <div class="inputBox">
                        <input type="tel" name="telefone" id="telefone" class="inputUser" placeholder="Digite Seu Telefone" required>
                        <br>
                    </div>

                    <!-- Box de Genero -->
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

                    <br>

                    <!-- Box de Data de Nascimento -->
                    <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                    <input type="date" name="date_nascimento" id="data_nascimento" placeholder="Digite Seu Telefone" required>
                    
                    <br>
                    <br><br>
                    <br>

                    <!-- Box de estado -->
                    <div class="inputBox">
                        <input type="text" name="estado" id="estado" class="inputUser" placeholder="Digite Seu Estado" required>
                        <br>
                    </div>

                    <!-- Box de cidade -->
                    <div class="inputBox">
                        <input type="text" name="cidade" id="cidade" class="inputUser" placeholder="Digite Sua Cidade" required>
                        <br>
                    </div>

                    <!-- Box de Endereço -->
                    <div class="inputBox">
                        <input type="text" name="endereco" id="endereco" class="inputUser" placeholder="Digite Seu Endereço" required>
                        <br>
                    </div>

                    <!-- Botão de Envio -->
                    <input type="submit" name="submit" id="submit">
                </fieldset>
            </form>
        </div>
    </body>
    </html>
