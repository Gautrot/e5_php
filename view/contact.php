<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include_once '../include/head.php' ?>
    <title>Contactez-nous !</title>
</head>

<body>
<?php
// Manager
include_once '../manager/Manager.php';
// Preloader
include_once '../include/modal/preloader.php';
// Header
include_once '../include/header.php';
// Modal Inscription
include_once '../include/modal/inscription.php';
// Modal Mot de passe oublié
include_once '../include/modal/mdp.php';
// Modal Login
include_once '../include/modal/login.php';
include_once '../include/modal/connectionEleve.php';
include_once '../include/modal/connectionParent.php';
include_once '../include/modal/connectionProf.php';
include_once '../include/modal/connectionAdmin.php';
?>

<!-- page title -->
<section class="page-title-section overlay" data-background="/e5_php/style/images/backgrounds/page-title.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item"><a class="h2 text-primary font-secondary">Contactez-nous</a></li>
                    <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                </ul>
                <p class="text-lighten">Si vous avez des questions, vous pouvez nous contacter par mail ou par téléphone.</p>
            </div>
        </div>
    </div>
</section>
<!-- /page title -->

<!-- contact -->
<section class="section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title">LYCEE ROBERT SCHUMAN</h2>
                <h3 class="title">ADRESSE</h3>
                <p>5 avenue du Général de Gaulle - 93440 Dugny</p>
                <h3 class="title">TELEPHONE</h3>
                <p> 01 48 37 74 26 </p><p>01 48 35 48 14</p>
                <h3 class="title">MAIL</h3>
                <p>administration@lyceerobertschuman.com</p>
            </div>
        </div>
    </div>
</section>
<!-- /contact -->

<?php
// Footer
include_once '../include/footer.php';
// Script
include_once '../include/script.php';
?>

</body>
</html>