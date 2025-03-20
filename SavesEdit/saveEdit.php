<?php

include_once('../conexao_dtb/config.php');

//Obtenha os dados do formulário
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $sexo = $_POST['sexo'];
    $data_nascimento = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $endereco = $_POST['endereco'];

//Atualiza banco de dados
    $sqlupdate = "UPDATE funcionarios SET nome='$nome',senha='$senha',email='$email',telefone='$telefone',sexo='$sexo',data_nascimento='$data_nascimento',cidade='$cidade',estado='$estado',endereco='$endereco'
        WHERE   id='$id'";

    $result = $conexao->query($sqlupdate);
}
header('Location: ../funcionarios.php');
?>
