<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../../include/head.php' ?>
    <title>Détail de l'utilisateur</title>
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
require_once '../../../traitement/admin/cherche-util-tr.php'
?>

<!-- about -->
<section class="page-title-section overlay">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item">
                        <a class="h2 text-primary font-secondary" href="@@page-link">
                            <?php echo $show['nom']; ?>
                        </a>
                    </li>
                    <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                </ul>
                <p class="text-lighten">Les détails de l'utilisateur sélectionné sur le site.</p>
            </div>
        </div>
    </div>
</section>
<!-- /about -->

<!-- table -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-sm table-hover table-bordered table-borderless" style="width:100%">
                    <thead></thead>
                    <tbody>
                    <tr>
                        <th scope="row">Nom</th>
                        <td><?php echo $show['nom'] . ' ' . $show['prenom']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Né.e le</th>
                        <td><?php echo $show['dateNaissance']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Numéro de téléphone</th>
                        <td><?php echo $show['telephone']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Adresse</th>
                        <td><?php echo $show['adresse']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Adresse mél</th>
                        <td><?php echo $show['mail']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Login</th>
                        <td><?php echo $show['login']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Statut</th>
                        <td>
                            <?php switch ($show['statut']) {
                                case '1':
                                    echo 'Eleve';
                                    break;
                                case '2':
                                    echo 'Parent';
                                    break;
                                case '3':
                                    echo 'Professeur';
                                    break;
                                case '4':
                                    echo 'Administrateur';
                                    break;
                                default:
                                    echo 'Utilisateur';
                                    break;
                            } ?>
                        </td>
                    </tr>
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
                    } ?>
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- /table -->

<section class="section-sm bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <a href="table-util" type="submit" class="btn btn-primary">Retour</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Footer
include_once '../../../include/footer.php';
// Script
include_once '../../../include/script.php';
?>

</body>
</html>
