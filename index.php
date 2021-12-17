<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once 'include/head.php' ?>
    <title>Lycée privé et UFA - Robert Schuman</title>
</head>

<body>
<?php
// Manager
include_once 'manager/Manager.php';
// Preloader
include_once 'include/modal/preloader.php';
// Header
include_once 'include/header.php';
// Modal Inscription
include_once 'include/modal/inscription.php';
// Modal Mot de passe oublié
include_once 'include/modal/mdp.php';
// Modal Login
include_once 'include/modal/login.php';
include_once 'include/modal/connectionEleve.php';
include_once 'include/modal/connectionParent.php';
include_once 'include/modal/connectionProf.php';
include_once 'include/modal/connectionAdmin.php';
?>

<!-- hero slider -->
<section class="hero-section overlay bg-cover" data-background="/e5_php/style/images/backgrounds/page-title.jpg">
    <div class="container">
        <div class="hero-slider">
            <!-- slider item -->
            <div class="hero-slider-item">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="text-white" data-animation-out="fadeOutUp" data-delay-out="5" data-duration-in=".3"
                            data-animation-in="fadeInDown" data-delay-in=".1">LYCÉE PRIVÉ ET UFA - ROBERT SCHUMAN </h1>
                        <p class="text-muted mb-4" data-animation-out="fadeOutUp" data-delay-out="5"
                           data-duration-in=".3" data-animation-in="fadeInDown" data-delay-in=".4">Enseignement catholique sous contrat avec l'état.</p>
                        <a href="/e5_php/view/contact" class="btn btn-primary" data-animation-out="fadeOutUp" data-delay-out="5"
                           data-duration-in=".3" data-animation-in="fadeInDown" data-delay-in=".7">Contactez-nous</a>
                    </div>
                </div>
            </div>
            <!-- slider item -->
            <div class="hero-slider-item">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="text-white" data-animation-out="fadeOutUp" data-delay-out="5" data-duration-in=".3"
                            data-animation-in="fadeInDown" data-delay-in=".1">LYCÉE PRIVÉ ET UFA - ROBERT SCHUMAN </h1>
                        <p class="text-muted mb-4" data-animation-out="fadeOutUp" data-delay-out="5"
                           data-duration-in=".3" data-animation-in="fadeInDown" data-delay-in=".4">Enseignement catholique sous contrat avec l'état.</p>
                        <a href="contact.php" class="btn btn-primary" data-animation-out="fadeOutUp" data-delay-out="5"
                           data-duration-in=".3" data-animation-in="fadeInDown" data-delay-in=".7">Contactez-nous</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /hero slider -->

<!-- about -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img class="img-fluid w-100 mb-4" src="/e5_php/style/images/arbre.jpg" >
                <h2 class="section-title">HISTORIQUE</h2>
                <p>LYCEE ROBERT SCHUMAN</p>
                <p>L’établissement a été créé en 1920 par quelques ingénieurs centraliens chrétiens qui fondèrent une association pour alphabétiser des jeunes gens en difficultés : c’était la naissance de « l’Entraide Éducative ». Plus tard, s’ajouteront différentes formations professionnelles pour devenir le Lycée privé Robert Schuman (Sous contrat d’association avec l’État).</p>
            </div>
        </div>
    </div>
</section>
<!-- /about -->

<!-- funfacts -->
<section class="section-sm bg-primary">
    <div class="container">
        <div class="row">
            <!-- funfacts item -->
            <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
                <div class="text-center">
                    <h2 class="count text-white" data-count="30">0</h2>
                    <h5 class="text-white">PROFESSEURS</h5>
                </div>
            </div>
            <!-- funfacts item -->
            <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
                <div class="text-center">
                    <h2 class="count text-white" data-count="15">0</h2>
                    <h5 class="text-white">FORMATIONS</h5>
                </div>
            </div>
            <!-- funfacts item -->
            <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
                <div class="text-center">
                    <h2 class="count text-white" data-count="450">0</h2>
                    <h5 class="text-white">ETUDIANTS</h5>
                </div>
            </div>
            <!-- funfacts item -->
            <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
                <div class="text-center">
                    <h2 class="count text-white" data-count="90">0</h2>
                    <h5 class="text-white">TAUX DE REUSSITE</h5>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /funfacts -->

<!-- success story -->
<section class="section bg-cover" data-background="/e5_php/style/images/backgrounds/success-story.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-8">
                <div class="bg-white p-5">
                    <h2 class="section-title">PRESENTATION EN VIDEO</h2>
                    <div class="col-lg-6 col-sm-4 position-relative success-video">
                        <a class="play-btn venobox" href="https://www.youtube.com/watch?v=5fQu2KygRL0" data-vbtype="video">
                            <i class="ti-control-play"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /success story -->

<?php
// Footer
include_once 'include/footer.php';
// Script
include_once 'include/script.php';
?>

</body>
</html>
