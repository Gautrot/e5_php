<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../../include/head.php' ?>
    <title>Supprimer un projet éducatif</title>
</head>

<body>
<?php
// Preloader
include_once '../../../include/modal/preloader.php';
// Header
include_once '../../../include/header.php';
// ManaPee
include_once '../../../manager/pee/Manapee.php';
$liste = new Manapee();
$res = $liste->listeClasse();
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
?>

<!-- about -->
<section class="page-title-section overlay">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item">
                        <a class="h2 text-primary font-secondary" href="@@page-link">
                            Supprimer un projet éducatif sur le site.
                        </a>
                    </li>
                    <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                </ul>
                <p class="text-lighten">Vous pouvez supprimer un projet éducatif sur le site..</p>
            </div>
        </div>
    </div>
</section>
<!-- /about -->

<!-- table -->
<section id="eventInterne" class="section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="modal-body">
                    <tbody>
                    <?php
                    $bdd = (new BDD)->getBase();
                    // Cherche le créateur du projet
                    $pee = $bdd->prepare("SELECT * FROM projet_edu ");
                    $pee->execute(array());
                    $pee = $pee->fetchall();

                    foreach ($pee as $value){



                        ?>


                        <tr>
                            <td><?php echo $value['id_projet'];?></td></br>
                            <td><?php echo $value['nom'];?></td></br>
                            <td>
                                <a class="w-70 d-block mx-auto btn btn-danger text-white" href="../../traitement/pee/suppr-pee-tr.php?id_projet=<?php echo $value['id_projet'];?>"><i class="fas fa-times" onclick="(this.id)"> SUPPRIMER</i></a>
                            </td>

                        </tr>

                    <?php } ?>
                    </tbody>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /table -->

<?php
// Footer
include_once '../../../include/footer.php';
// Script
include_once '../../../include/script.php';
?>

</body>
</html>
