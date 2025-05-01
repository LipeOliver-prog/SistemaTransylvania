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
        $especie = $_POST['especie'];


        // Montagem e Execução da Consulta SQL
        $result = mysqli_query($conexao, "INSERT INTO clientes(nome, email, cpf,telefone, sexo, data_nascimento, endereco, especie) values('$nome', '$email', '$cpf','$telefone', '$sexo', '$data_nascimento', '$endereco', '$especie')");

        header('Location: ../clientes.php');
    }
    ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <!-- Aba de Navegação do explorer -->
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Formulário | Clientes </title>

        <link rel="stylesheet" href="../styleCSS/FORMULARIOS.css">
    </head>

    <body>

        <!-- Boão de Volar -->
        <div class="buttonVoltar">
            <a href="../Clientes.php" class="btnVoltar">Voltar</a>
        </div>

        <!-- Formulário -->
        <div class="box">
            <form action="formulariocliente.php" method="POST">
                <fieldset>
                    <!-- Tiutulo do Formulário -->
                    <legend><b>Formulário de Clientes</b></legend>
                    <br>

                    <!-- Box de Nome  -->
                    <div class="inputBox">
                        <input type="text" name="nome" id="nome" placeholder="Digite Seu Nome Completo" required autocomplete="off">
                        <br>
                    </div>


                    <!-- Box de Email  -->
                    <div class="inputBox">
                        <input type="text" name="email" id="email" placeholder="Digite Seu E-Mail" required autocomplete="off">
                        <br>
                    </div>
                    

                    <!-- Box de CPF  -->
                    <div class="inputBox">
                        <input type="text" name="cpf" id="cpf" placeholder="Digite Seu CPF" required autocomplete="off">
                        <br>
                    </div>


                    <!-- Box de Endereço  -->
                    <div class="inputBox">
                        <input type="text" name="especie" id="especie" placeholder="Digite Sua Espécie" required autocomplete="off">
                        <br>
                    </div>

                        
                    <!-- Box de Telefone  -->
                    <div class="inputBox">
                        <input type="tel" name="telefone" id="telefone" class="inputUser" placeholder="Digite Seu Telefone" required autocomplete="off">
                        <br>
                    </div>
                    

                    <!-- Box de Genero  -->
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

                    <!-- Box de Data de Nascimento  -->
                        <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                        <input type="date" name="data_nascimento" id="data_nascimento" required>

                    <br>
                    <br><br>
                    <br>

                    <!-- Box de Endreço  -->
                    <div class="inputBox">
                        <input type="text" name="endereco" id="endereco" class="inputUser" placeholder="Digite Seu Endereço" required autocomplete="off">
                        <br>
                    </div>



                    <!-- Botçao de Enviar  -->
                        <input type="submit" name="submit" id="submit">

                </fieldset>

            </form>
        </div>
    </body>

    </html>