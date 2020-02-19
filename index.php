<?php
include 'header.php';
?>
<!-- Titre du site-->
<h1 class="text-center">Bienvenue sur le site du Central Hospital</h1>
<!--Caroussel pour présenter briévement les actualités -->
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-interval="4000">
    <div class="carousel-inner text-center">
        <div class="carousel-item active">
            <img src="assets/img/imgcaroussel1.jpg" alt="garden" /> 
            <div class="carousel-caption d-none d-md-block">
                <h3>Nos jardins extérieurs</h3>
                <h5>Venez profiter d'une ballade détente et vous retrouver dans nos jardins extérieurs.</h5>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/img/imgcaroussel2.jpg" alt="bedroom" />
            <div class="carousel-caption d-none d-md-block">
                <h3>Ouveture de la maternité</h3>
                <h5>Réouverture du service de la maternité après la rénovation de son bâtiment.</h5>
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/img/imgcaroussel3.png" alt="joke" />
        </div>
    </div>
</div>
<!-- Card deck pour montrer les services -->
<div class="row">
    <div class="col-12">
        <div class="card-deck p-2">
            <div class="col-4">
                <div class="card border-danger mb-3" style="max-width: 18rem;">
                    <img src="assets/img/logoNurse.jpg" class="card-img-top" alt="nurse" />
                    <div class="card-body">
                        <h5 class="card-title">Une qualité de service</h5>
                        <p class="card-text">Nos infirmiers prennent soin de vous et vous accompagnent tout au long de votre séjour.</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card border-danger mb-3" style="max-width: 18rem;">
                    <img src="assets/img/logoMaternity.png" class="card-img-top" alt="maternity" />
                    <div class="card-body">
                        <h5 class="card-title">Une écoute</h5>
                        <p class="card-text">Les naissances sont pour nous le point essentiel de notre hôpital et de leurs prises en charges.</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card border-danger mb-3" style="max-width: 18rem;">
                    <img src="assets/img/logoGeriatrics.jpeg" class="card-img-top" alt="geriatrics"/>
                    <div class="card-body">
                        <h5 class="card-title">Un accompagnement</h5>
                        <p class="card-text">Nous aidons et respectons nos aînés lors de leur venue et les accompagnons lors de leur retour à domicile.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>