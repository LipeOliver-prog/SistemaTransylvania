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
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Transilvânia - Reservas</title>
  <link rel="stylesheet" href="styleCSS/HOME.css">
  <link rel="stylesheet" href="styleCSS/style.css">

</head>

<body>

  <header class="header">

    <a href="Home.php" class="logo">

      <img src="img/brasaoHT.png" alt="logo">

    </a>

    <nav class="navbar">

      <a href="Home.php" class="active">Home</a>

      <a href="Funcionarios.php">Funcionarios</a>

      <a href="quartos.php">Quartos</a>

      <a href="Clientes.php">Clientes</a>

      <a href="frigobar.php">Frigobar</a>

      <a href="pagamento.php">Pagamento</a>

    </nav>

    <div class="bemVindo">
      <?php echo "<p>Bem vindo</p> <u>$logado</u>";   ?>
    </div>

    <div class="buttonSair">

      <a href="sair.php" class="btnSair">Sair</a>

    </div>

  </header>

  <div class="home-container"></div>

  <!-- Filtro de Quartos -->

  <section class="home">

    <h1>Filtro Quartos</h1>

    <div class="filter">

      <div class="filter-group">

        <label for="monsterType">Tipo de Monstro:</label>

        <select id="monsterType">

          <option value="all">Todos</option>

          <option value="vampiro">Vampiro</option>

          <option value="lobisomem">Lobisomem</option>

          <option value="mumia">Múmia</option>

          <option value="zumbi">Zumbi</option>

        </select>

      </div>

      <div class="filter-group">

        <label for="roomType">Tipo de Quarto:</label>

        <select id="roomType">

          <option value="all">Todos</option>

          <option value="basico">Básico</option>

          <option value="luxo">Luxo</option>

          <option value="suite">Suíte</option>

        </select>

      </div>

      <div class="filter-group">

        <label for="beds">Camas:</label>

        <select id="beds">

          <option value="all">Todas</option>

          <option value="1">1 cama</option>

          <option value="2">2 camas</option>

          <option value="3">3 camas</option>

        </select>

      </div>

      <div class="filter-group">

        <label for="balcony">Sacada:</label>

        <select id="balcony">

          <option value="all">Todas</option>

          <option value="true">Com sacada</option>

          <option value="false">Sem sacada</option>

        </select>

      </div>

      <div class="filter-group">

        <label for="breakfast">Café da Manhã:</label>

        <select id="breakfast">

          <option value="all">Todos</option>

          <option value="true">Incluso</option>

          <option value="false">Não incluso</option>

        </select>

      </div>

      <button class="btn3" onclick="filterRooms()">Filtrar</button>

    </div>


    <!-- Container Dinâmico de Cards -->
    <div class="card-container" id="roomsContainer"></div>

    <script>
      // Dados de exemplo com campo `image`
      const rooms = [{
          id: 1,
          monster: 'vampiro',
          image: 'QuartoVamp.png', // usará essa imagem
          type: 'luxo',
          beds: 2,
          balcony: true,
          breakfast: true,
          price: 350,
          features: ['Vista Lago', 'Frigobar']
        },
        {
          id: 2,
          monster: 'lobisomem',
          image: 'QuartoLobi.png', // usará house.jpg
          type: 'basico',
          beds: 1,
          balcony: false,
          breakfast: false,
          price: 200,
          features: ['Wifi 240h']
        },
        {
          id: 3,
          monster: 'mumia',
          image: 'QuartoMumia.jpg', // usará QuartoMumia.png
          type: 'suite',
          beds: 3,
          balcony: true,
          breakfast: true,
          price: 500,
          features: ['Piscina Privativa', 'Hidromassagem']
        },
        {
          id: 4,
          monster: 'zumbi',
          image: 'QuartoZumbi.png',
          type: 'basico',
          beds: 2,
          balcony: false,
          breakfast: true,
          price: 220,
          features: ["Sala de Jogos", "chocolate quente"]
        }
      ];

      function filterRooms() {
        const monster = document.getElementById('monsterType').value;
        const roomType = document.getElementById('roomType').value;
        const beds = document.getElementById('beds').value;
        const balcony = document.getElementById('balcony').value;
        const breakfast = document.getElementById('breakfast').value;

        const filtered = rooms.filter(room => (
          (monster === 'all' || room.monster === monster) &&
          (roomType === 'all' || room.type === roomType) &&
          (beds === 'all' || room.beds === parseInt(beds)) &&
          (balcony === 'all' || room.balcony === (balcony === 'true')) &&
          (breakfast === 'all' || room.breakfast === (breakfast === 'true'))
        ));

        renderRooms(filtered);
      }

      function renderRooms(list) {
        const container = document.getElementById('roomsContainer');
        container.innerHTML = '';

        if (list.length === 0) {
          container.innerHTML = '<p>Nenhum quarto encontrado.</p>';
          return;
        }

        list.forEach(room => {
          const wrap = document.createElement('div');
          wrap.className = 'wrapper';

          // Card principal
          const card = document.createElement('figure');
          card.className = 'card';
          card.innerHTML = `
          <img src="./img/${room.image}" alt="Quarto ${room.type}" />
          <figcaption class="card__cap">
            <h2>Quarto ${room.id} – ${room.monster.charAt(0).toUpperCase() + room.monster.slice(1)}</h2>
            <div class="card__desc">
              <p>Tipo: ${room.type}</p>
              <p>Camas: ${room.beds}</p>
              <p>Sacada: ${room.balcony ? 'Sim' : 'Não'}</p>
              <p>Café: ${room.breakfast ? 'Incluso' : 'Não incluso'}</p>
            </div>
          </figcaption>
          <button class="det__btn">Detalhes</button>
        `;


          const details = document.createElement('div');
          details.className = 'card__details';
          details.innerHTML = `
    <p class="card__type" style="font-size: 35px;">${room.type.charAt(0).toUpperCase() + room.type.slice(1)}</p>
    <h6 class="card__price" style="font-size: 35px;">
        <sup style="font-size: 15px;">R$</sup>${room.price}<sub style="font-size: 15px;">/dia</sub>
    </h6>
    <div class="card__features" style="font-size: 20px;">
        ${room.features.map(f => `<div class="feature" style="font-size: 16px;">${f}</div>`).join('')}
    </div>
    <button class="buy__btn" style="font-size: 14px;">Reservar agora</button>
    `;


          wrap.appendChild(card);
          wrap.appendChild(details);
          container.appendChild(wrap);

          // Eventos "Detalhes" e "Reservar agora"
          card.querySelector('.det__btn').addEventListener('click', () => {
            details.classList.add('open');
          });
          details.querySelector('.buy__btn').addEventListener('click', () => {
            details.classList.remove('open');
          });
        });
      }

      // Renderiza tudo na inicial
      renderRooms(rooms);
    </script>
  </section>

</body>

</html>