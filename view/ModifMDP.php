<?php
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $url = "https";
} else {
    $url = "http";
}
$url .= "://";
$url .= $_SERVER['HTTP_HOST'];
$url .= $_SERVER['REQUEST_URI'];

$parse = parse_url($url, PHP_URL_QUERY);
$str = str_replace("mail=", "", $parse);

$bdd = new PDO('mysql:host=localhost;dbname=projet_lprs_sgs;charset=utf8', 'root', ''); // on se connecte à la base de donnée "lprs", avec l'uttilisateur "root" avec l'encodage utf-8
$reponse = $bdd->prepare('SELECT mail, mdp FROM utilisateur WHERE mail = :mail');  //on prepare la requete de php pour accéder aux identifiants dans la base de données en sql
$reponse->execute([
    'mail' => $str
]); //on insère sous forme de tableau les données que l'on veut récupérer de la base
$donne = $reponse->fetch(); //on execute finalement la requete
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <?php include_once '../../include/head.php' ?>
    <title>Modifier mon mots de passe</title>
</head>

<body>
<?php
// Manager
include_once '../../manager/Manager.php';
// Preloader
include_once '../../include/modal/preloader.php';
// Header
include_once '../../include/header.php';
// Modal Inscription
include_once '../../include/modal/inscription.php';
// Modal Mot de passe oublié
include_once '../../include/modal/mdp.php';
// Modal Login
include_once '../../include/modal/login.php';
include_once '../../include/modal/connectionEleve.php';
include_once '../../include/modal/connectionParent.php';
include_once '../../include/modal/connectionProf.php';
include_once '../../include/modal/connectionAdmin.php';
// Traitement "cherche-util-tr"
require_once '../../traitement/cherche-util-tr.php'
?>

<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item">
                        <a class="h2 text-primary font-secondary" href="profil">Profil</a></li>
                    <li class="list-inline-item text-white h3 font-secondary nasted">Modification de mots de passe</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!--Recupere l'url -->

<!--Fin de la recuperation -->

<!-- /page title -->

<!-- teacher details -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-5">
                <h3>Modification de mot de passe</h3>
                <form action="/e5_php/traitement/modifMDP-tr.php" method="post">
                    <div class="form-group">
                        <div class="col-12">
                            <label for="mail">Mail</label>
                            <input type="text" class="form-control form-control-sm mb-3" id="mail" name="mail"
                                   required
                                   maxlength="40" value="<?= $donne['mail']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="mdp">Mot de passe</label>
                            <input type="password" class="form-control form-control-sm mb-3" id="mdp" name="mdp"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary" href="/e5_php/traitement/modifMDP-tr">
                            Modifier
                        </button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /teacher details -->

<section class="section-sm bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <form method="POST" action="index">
                        <button type="submit" class="btn btn-primary">
                            Retour
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Footer
include_once '../../include/footer.php';
// Script
include_once '../../include/script.php';
?>

</body>
</html>
