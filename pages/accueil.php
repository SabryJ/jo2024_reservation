<?php include('../includes/header.php'); ?>

<!--  Debut Carousel -->

<div class="container my-4">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner text-white">
          <div class="carousel-item active" data-bs-interval="10000">
            <img src="../assets/images/toureiffel1.jpg" class="d-block w-100" alt="Image 1">
            <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
              <h1 class="display-6 fw-bold">🏅 Aux Jeux Olympiques</h1>
              <div id="countdown1" class="fs-5"></div>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="10000">
            <img src="../assets/images/toureiffel2.jpg" class="d-block w-100" alt="Image 2">
            <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
              <h1 class="display-6 fw-bold">🏅 Aux Jeux Olympiques</h1>
              <div id="countdown2" class="fs-5"></div>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="10000">
            <img src="../assets/images/toureiffel3.jpg" class="d-block w-100" alt="Image 3">
            <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
              <h1 class="display-6 fw-bold">🏅 Aux Jeux Olympiques</h1>
              <div id="countdown3" class="fs-5"></div>
            </div>
          </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Suivant</span>
        </button>
      </div>
    </div>
  </div>
</div>


<!-- Fin Carousel --> 

<!-- Debut cardes actualités -->
<section class="container my-5">
  <h2 class="text-center mb-4">Actualités des Jeux Olympiques</h2>
  <div class="row g-4">

    <!-- Carte 1 -->
    <div class="col-12 col-sm-6 col-lg-4">
      <div class="card h-100 shadow-sm">
        <img src="../assets/images/actus1.jpg" class="card-img-top" alt="Stade JO">
        <div class="card-body">
          <h5 class="card-title">Le Stade Olympique Prêt</h5>
          <p class="card-text">Après des mois de travaux, le stade principal des JO 2024 a été inauguré ce lundi avec une cérémonie symbolique.</p>
          <a href="#" class="btn btn-primary">Lire plus</a>
        </div>
      </div>
    </div>

    <!-- Carte 2 -->
    <div class="col-12 col-sm-6 col-lg-4">
      <div class="card h-100 shadow-sm">
        <img src="../assets/images/actus2.jpg" class="card-img-top" alt="Athlètes en entraînement">
        <div class="card-body">
          <h5 class="card-title">Les Athlètes en Pleine Préparation</h5>
          <p class="card-text">Les délégations du monde entier arrivent à Paris. Les entraînements intensifs battent leur plein.</p>
          <a href="#" class="btn btn-primary">Lire plus</a>
        </div>
      </div>
    </div>

    <!-- Carte 3 -->
    <div class="col-12 col-sm-6 col-lg-4">
      <div class="card h-100 shadow-sm">
        <img src="../assets/images/actus3.jpeg" class="card-img-top" alt="Sécurité renforcée">
        <div class="card-body">
          <h5 class="card-title">Dispositif de Sécurité Renforcé</h5>
          <p class="card-text">Un plan de sécurité exceptionnel a été annoncé pour assurer la protection des spectateurs et participants.</p>
          <a href="#" class="btn btn-primary">Lire plus</a>
        </div>
      </div>
    </div>

    <!-- Carte 4 -->
    <div class="col-12 col-sm-6 col-lg-4">
      <div class="card h-100 shadow-sm">
        <img src="../assets/images/actus4.jpg" class="card-img-top" alt="Billets">
        <div class="card-body">
          <h5 class="card-title">Les Billets Partent Vite !</h5>
          <p class="card-text">Plus de 3 millions de billets déjà vendus ! Réservez vite votre place pour ne rien manquer.</p>
          <a href="#" class="btn btn-primary">Lire plus</a>
        </div>
      </div>
    </div>

    <!-- Carte 5 -->
    <div class="col-12 col-sm-6 col-lg-4">
      <div class="card h-100 shadow-sm">
        <img src="../assets/images/actus5.jpg" class="card-img-top" alt="Événements">
        <div class="card-body">
          <h5 class="card-title">Programme des Événements</h5>
          <p class="card-text">Le calendrier complet est désormais en ligne. 32 sports, des centaines d’épreuves, du 26 juillet au 11 août !</p>
          <a href="#" class="btn btn-primary">Lire plus</a>
        </div>
      </div>
    </div>

    <!-- Carte 6 -->
    <div class="col-12 col-sm-6 col-lg-4">
      <div class="card h-100 shadow-sm">
        <img src="../assets/images/actus6.jpg" class="card-img-top" alt="Torch olympique">
        <div class="card-body">
          <h5 class="card-title">La Flamme Olympique en Route</h5>
          <p class="card-text">Partie de Grèce, la flamme fait son chemin à travers la France avant d'arriver à Paris pour la cérémonie d'ouverture.</p>
          <a href="#" class="btn btn-primary">Lire plus</a>
        </div>
      </div>
    </div>

  </div>
</section>
<!-- Fin cardes actualités -->

<?php include('../includes/footer.php'); ?>
