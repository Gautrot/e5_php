<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <?php include_once '../../../include/head.php' ?>
    <title>Modifier mon mots de passe</title>
</head>

<body>
<!-- preloader start -->
<div class="preloader">
    <img src="images/preloader.gif" alt="preloader">
</div>
<!-- preloader end -->

<!-- header -->
<?php include_once '../../../include/header.php' ?>
<!-- /header -->

<!-- Modal Inscription-->
<?php include_once '../../../include/modal/inscription.php' ?>

<!-- Modal MotsDePasse-->
<?php include_once '../../../include/modal/mdp.php' ?>

<!-- Modal Login-->
<?php include_once '../../../include/modal/login.php' ?>


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
<!-- /page title -->
<!DOCTYPE html>
<html>
<head>
    <title>Modification de mon mots de passe</title>
    <meta charset="utf-8">
</head>
<body>
<p>Bonjour, veuillez modifier votre mots de passe :</p>

<!--Recuperate l'url -->
<?php
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
{
    $url = "https";
}
else
{
    $url = "http";
}
$url .= "://";
$url .= $_SERVER['HTTP_HOST'];
$url .= $_SERVER['REQUEST_URI'];

$parse = parse_url($url, PHP_URL_QUERY);
//var_dump($parse);
$str = str_replace("mail=", "", $parse);
//var_dump($str);
//var_dump($url);
?>
<!--Fin de la recuperation -->

<?php
$bdd= new PDO('mysql:host=localhost;dbname=projet_lprs_sgs;charset=utf8','root',''); // on se connecte à la base de donnée "lprs", avec l'uttilisateur "root" avec l'encodage utf-8

$reponse = $bdd->prepare('SELECT mail, mdp FROM utilisateur WHERE mail = :mail') ;  //on prepare la requete de php pour accéder aux identifiants dans la base de données en sql
$reponse->execute(array('mail'=>$str)); //on insère sous forme de tableau les données que l'on veut récupérer de la base
$donne = $reponse->fetch(); //on execute finalement la requete
var_dump($donne);

echo 'Email : ' .$donne['mail'].'<br>';
echo 'Mots de passe : ' .$donne['mdp'].'<br>';
?>

<!-- footer -->
<?php include_once '../../../include/footer.php' ?>
<!-- /footer -->

<!-- script -->
<?php include_once '../../../include/script.php' ?>

</body>
</html>