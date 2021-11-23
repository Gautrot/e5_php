<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <?php include_once '../../../include/head.php' ?>
    <title>Modifier</title>
</head>

<body>
<?php
// Preloader
include_once '../../../include/modal/preloader.php';
// Header
include_once '../../../include/header.php';
// Modal Inscription
include_once '../../../include/modal/inscription.php';
// Modal Mot de passe oublié
include_once '../../../include/modal/mdp.php';
// Modal Login
include_once '../../../include/modal/login.php';
include_once '../../../include/modal/connectionEleve.php';
include_once '../../../include/modal/connectionParent.php';
include_once '../../../include/modal/connectionProf.php';
include_once '../../../include/modal/connectionAdmin.php';
// Traitement "cherche-util-tr"
require_once '../../../traitement/cherche-util-tr.php'
?>

<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item">
                        <a class="h2 text-primary font-secondary" href="profil">Profil</a></li>
                    <li class="list-inline-item text-white h3 font-secondary nasted">Modification</li>
                </ul>
                <p class="text-lighten">Votre profil.</p>
            </div>
        </div>
    </div>
</section>
<!-- /page title -->

<!-- teacher details -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-sm table-hover table-bordered table-borderless" style="width: 100%;">
                    <thead></thead>
                    <tbody>
                    <tr>
                        <th scope="row">Nom</th>
                        <td><?php echo $show['nom'] . ' ' . $show['prenom']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Né.e le</th>
                        <td class="form-group"><?php echo $show['dateNaissance']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Numéro de téléphone</th>
                        <td class="form-group"><?php echo $show['telephone']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Adresse</th>
                        <td class="form-group"><?php echo $show['adresse']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Adresse mél</th>
                        <td class="form-group"><?php echo $show['mail']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Login</th>
                        <td class="form-group"><?php echo $show['login']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Mot de passe</th>
                        <td class="form-group"><?php echo $show['mdp']; ?></td>
                    </tr>
                    <tr>
                        <?php switch ($show['statut']) {
                            case '1':
                                echo '
                                <tr>
                                    <th scope="row">Classe</th>
                                    <td>' . $show['classe'] . '</td>
                                </tr>';
                                break;
                            case '2':
                                echo '
                                <tr>
                                    <th scope="row">Métier</th>
                                    <td>' . $show['metier'] . '</td>
                                </tr>';
                                break;
                            case '3':
                                echo '
                                <tr>
                                    <th scope="row">Matière</th>
                                    <td>' . $show['matiere'] . '</td>
                                </tr>';
                                break;
                            default:
                                break;
                        }
                        ?>
                    </tr>
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- /teacher details -->

<?php
// Footer
include_once '../../../include/footer.php';
// Script
include_once '../../../include/script.php';
?>

</body>
</html>
