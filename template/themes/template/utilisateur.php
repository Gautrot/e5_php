<?php
//session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../../include/head.php' ?>
    <title>Détail de l'utilisateur</title>
</head>

<body>
<!-- preloader start -->
<?php include_once '../../../include/modal/preloader.php' ?>
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

<!-- about -->
<section class="page-title-section overlay">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item">
                        <a class="h2 text-primary font-secondary" href="@@page-link">
                            <?php echo $_SESSION['show']['nom']; ?>
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
                <table class="table table-sm table-hover table-bordered" style="width:100%">
                    <thead></thead>
                    <tbody>
                    <tr>
                        <th scope="row">Nom</th>
                        <td><?php echo $_SESSION['show']['nom'] . ' ' . $_SESSION['show']['prenom']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Né.e le</th>
                        <td><?php echo $_SESSION['show']['dateNaissance']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Tél.</th>
                        <td><?php echo $_SESSION['show']['telephone']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Adresse</th>
                        <td><?php echo $_SESSION['show']['adresse']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">E-mail</th>
                        <td><?php echo $_SESSION['show']['mail']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Login</th>
                        <td><?php echo $_SESSION['show']['login']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Mot de passe</th>
                        <td><?php echo $_SESSION['show']['mdp']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Statut</th>
                        <td>
                            <?php
                            switch ($_SESSION['show']['statut']) {
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
                            }
                            ?>
                        </td>
                    </tr>
                    <?php switch ($_SESSION['show']['statut']) {
                        case '1':
                            echo '
                                <tr>
                                    <th scope="row">Classe</th>
                                    <td>' . $_SESSION['show']['classe'] . '</td>
                                </tr>';
                            break;
                        case '2':
                            echo '
                                <tr>
                                    <th scope="row">Métier</th>
                                    <td>' . $_SESSION['show']['metier'] . '</td>
                                </tr>';
                            break;
                        case '3':
                            echo '
                                <tr>
                                    <th scope="row">Matière</th>
                                    <td>' . $_SESSION['show']['matiere'] . '</td>
                                </tr>';
                            break;
                        default:
                            break;
                    }
                    ?>
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
                    <form method="POST" action="/e5_php/traitement/admin/retour-session-tr.php">
                        <button type="submit" class="btn btn-primary">
                            Retour
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- footer -->
<?php include_once '../../../include/footer.php' ?>
<!-- /footer -->

<!-- script -->
<?php include_once '../../../include/script.php' ?>

</body>
</html>
