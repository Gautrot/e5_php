<?php
//session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../../include/head.php' ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="../../../vendor/datatables/datatables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../../../style/css/datatables.css">

    <title>Table des utilisateurs</title>
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
                    <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="@@page-link">Liste des
                            utilisateurs</a></li>
                    <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                </ul>
                <p class="text-lighten">La liste des utilisateurs inscrit sur le site.</p>
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
                <table id="utilisateur" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Né.e le</th>
                        <th>Adresse</th>
                        <th>Tél.</th>
                        <th>E-mail</th>
                        <th>Login</th>
                        <th>Mot de passe</th>
                        <th>Statut</th>
                        <th>Activation</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Né.e le</th>
                        <th>Adresse</th>
                        <th>Tél.</th>
                        <th>E-mail</th>
                        <th>Login</th>
                        <th>Mot de passe</th>
                        <th>Statut</th>
                        <th>Activation</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- /table -->

<!-- ajouter un utilisateur -->
<section class="section-sm bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2 class="text-white">Ajouter un utilisateur</h2>
                    <form method="post" action="../../../traitement/creer-util-tr">
                        <table>
                            <thead></thead>
                            <tbody>
                            <tr>
                                <td>
                                    <label>
                                        <input type="text" name="nom" placeholder="Nom" required maxlength="40">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="text" name="prenom" placeholder="Prénom" required maxlength="40">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="date" name="dateNaissance" placeholder="Date de naissance"
                                               required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="text" name="adresse" placeholder="Adresse" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="text" name="telephone" placeholder="No. Téléphone" required
                                               maxlength="10">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="email" name="mail" placeholder="E-mail" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="text" name="login" placeholder="Login" required maxlength="40">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="password" name="mdp" placeholder="Mot de passe" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <select name="statut" required>
                                            <option name="util" value="0">Utilisateur</option>
                                            <option name="eleve" value="1">Elève</option>
                                            <option name="parent" value="2">Parent</option>
                                            <option name="prof" value="3">Professeur</option>
                                            <option name="admin" value="4">Administrateur</option>
                                        </select>
                                    </label>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                        <div>
                            <input type="submit" value="Ajouter"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /ajouter un utilisateur -->

<!-- footer -->
<?php include_once '../../../include/footer.php' ?>
<!-- /footer -->

<!-- script -->
<?php include_once '../../../include/script.php' ?>
<!-- DataTables -->
<script type="text/javascript"
        src="../../../vendor/datatables/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../../style/js/datatables.js"></script>

</body>
</html>
