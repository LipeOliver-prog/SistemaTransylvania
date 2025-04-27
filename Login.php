
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tela de Login</title>

  <link rel="stylesheet" href="styleCSS/login.css"/>
</head>

<body>
  <div class="main-login">
    <div class="left-login">
      <h1>Faça o Login <br> E entre para o nosso time</h1>
      <img class="left-login-image" src="img/login.png" alt="logologin" />
    </div>

    <div class="right-login">
      <div class="card-login">
        <h1>LOGIN</h1>
        <form action="testlogin.php" method="POST">

          <div class="textfield">
          
            <input type="text" name="email" placeholder="Digite Seu Email">
          </div>

          <div class="textfield">
          
          <input type="password" name="senha" placeholder="Digite Sua Senha">

          </div>
          <input class="inputSubmit" type="submit" name="submit" value="Login">
        </form>
      </div>
    </div>
  </div>
</body>
</html>
