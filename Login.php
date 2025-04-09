<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>

    <link rel="stylesheet" href="styleCSS/FORMULARIOS.css">

</head>

<body>
    <div class="tela-login">
        <!-- <img class="logoLogin" src="img/logoSite.png" alt="logo"> -->
        <img class="logoLogin" src="img/brasaoHT.png" alt="logo">

        <h1> Login</h1>
        <form action="testlogin.php" method="POST">
            <input type="text" name="email" placeholder="Email">
            <br><br>
            <input type="password" name="senha" placeholder="Senha">
            <br><br>
            <input class="inputSubmit" type="submit" name="submit" value="Enviar">
    </div>
    
</body>

</html>