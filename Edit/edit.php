<?php

if (!empty($_GET['id'])) {
    include_once('../conexao_dtb/config.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM funcionarios where id=$id";

    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result)) {


            $nome = $user_data['nome'];
            $email = $user_data['email'];
            $senha = $user_data['senha'];
            $telefone = $user_data['telefone'];
            $sexo = $user_data['sexo'];
            $data_nascimento = $user_data['data_nascimento'];
            $cidade = $user_data['cidade'];
            $estado = $user_data['estado'];
            $endereco = $user_data['endereco'];
            $senha = $user_data['senha'];
        }
    } else {
        header('Location: ../funcionarios.php');
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Formulário | EDIÇÃO </title>

    <link rel="stylesheet" href="../styleCSS/FORMULARIOS.css">
</head>

<body>
    <div class="buttonVoltar">
        <a href="../Funcionarios.php" class="btnVoltar">Voltar</a>
    </div>
    <div class="box">
        <form action="../SavesEdit/saveEdit.php" method="POST">
            <fieldset>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" value="<?php echo $nome ?>" required>
                    <label for="nome" class="labelInput">Nome Completo</label>
                    <br>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" value="<?php echo $email ?>" required>
                    <label for="email" class="labelInput">E-mail</label>
                    <br>

                </div>
                <br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" value="<?php echo $senha ?>" required>
                    <label for="senha" class="labelInput">Senha</label>
                    <br>
                    <br><br>
                    <div class="inputBox">
                        <input type="tel" name="telefone" id="telefone" class="inputUser" value="<?php echo $telefone ?>" required>
                        <label for="telefone" class="labelInput">Telefone</label>

                    </div>

                    <br>
                    <p>Sexo:</p>
                    <input type="radio" id="feminino" name="sexo" value="feminino" <?php echo ($sexo == 'feminino') ? 'checked' : '' ?> required>
                    <label for="feminino">Feminino</label>
                    <br>
                    <input type="radio" id="masculino" name="sexo" value="masculino" <?php echo ($sexo == 'masculino') ? 'checked' : '' ?> required>
                    <label for="masculino">Masculino</label>
                    <br>
                    <input type="radio" id="outros" name="sexo" value="outros" <?php echo ($sexo == 'outros') ? 'checked' : '' ?> required>
                    <label for="outros">Outros</label>
                    <br><br>

                    <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                    <input type="date" name="data_nascimento" id="data_nascimento" value="<?php echo $data_nascimento ?>" required>

                    <br><br><br>

                    <div class="inputBox">
                        <input type="text" name="cidade" id="cidade" class="inputUser" value="<?php echo $cidade ?> " required>
                        <label for="cidade" class="labelInput">Cidade</label>
                    </div>
                    <br>
                    <br><br>
                    <div class="inputBox">
                        <input type="text" name="estado" id="estado" class="inputUser" value="<?php echo $estado ?>" required>
                        <label for="estado" class="labelInput">Estado</label>
                    </div>
                    <br>
                    <br><br>
                    <div class="inputBox">
                        <input type="text" name="endereco" id="endereco" class="inputUser" value="<?php echo $endereco ?>" required>
                        <label for="endereco" class="labelInput">Endereço</label>
                    </div>
                    <br>
                    <br><br>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="submit" name="update" id="update">

            </fieldset>

        </form>
    </div>
</body>

</html>