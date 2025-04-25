<?php

include_once('../conexao_dtb/config.php');

//Obtenha os dados do formulário
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $sexo = $_POST['sexo'];
    $data_nascimento = $_POST['data_nascimento'];
    $endereco = $_POST['endereco'];
    $especie = $_POST['especie'];

    //Atualiza banco de dados
    $sqlupdate = "UPDATE clientes SET nome='$nome',cpf='$cpf',email='$email',telefone='$telefone',sexo='$sexo',data_nascimento='$data_nascimento', endereco='$endereco', especie='$especie'
        WHERE   id='$id'";

    $result = $conexao->query($sqlupdate);
}
header('Location: ../clientes.php');
?>