<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>model card</title>
  <link rel="stylesheet" href="styleCSS/style.css">
</head>
<body>
  
<!-- Filtro (se houver) pode ficar aqui em cima -->

<!-- Começo do container dos cards -->
<div class="card-container">

  <div class="wrapper"> 
    <figure class="card">
      <img src="./img/house.jpg" alt="card image" />

      <figcaption class="card__cap">
        <h2>Casa de praia</h2>
        <div class="card__desc">
          <p>5 quartos</p>
          <p>3 suites</p>
          <p>1 piscina</p>
          <p>2 suites</p>
        </div>
      </figcaption>
      <button class="det__btn">Detalhes</button>
    </figure>

    <div class="card__details">
      <p class="card__type">Básico</p>
      <h6 class="card__price"><sup>Mzn</sup>599 <sub>/dia</sub></h6>
      <div class="card__feactures">
        <div class="feacture">Sala de jogos</div>
        <div class="feacture">Suites com hidromassagem</div>
        <div class="feacture">Wifi 24h</div>
        <div class="feacture">Camêras de segurança</div>
      </div>
      <button class="buy__btn">Reservar agora</button>
    </div>
  </div>

  <!-- Aqui você pode colocar outros cards -->
  <!--
  <div class="wrapper">
    ...outro card aqui...
  </div>
  -->

</div> <!-- Fim do .card-container -->

    


    <script>

     
      document.querySelectorAll('button').forEach((btn) => {
        btn.addEventListener('click', () => {
          if (btn.className === 'det__btn') {
            document.querySelector('.card__details').classList.add('open');
          }

          if (btn.className === 'buy__btn') {
            document.querySelector('.card__details').classList.remove('open');
          }
        });
      });
    </script>
  
</body>
</html>


