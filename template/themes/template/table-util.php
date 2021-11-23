<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../../include/head.php' ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="/e5_php/vendor/datatables/datatables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/e5_php/style/css/datatables.css">

    <title>Table des utilisateurs</title>
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
?>

<!-- about -->
<section class="page-title-section overlay">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item">
                        <a class="h2 text-primary font-secondary"">Liste des utilisateurs</a></li>
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
                        <th></th>
                        <th>Nom</th>
                        <!--
                        <th>ID</th>
                        <th>Né.e le</th>
                        <th>Adresse</th>
                        <th>Tél.</th>
                        <th>E-mail</th>
                        <th>Login</th>
                        <th>Mot de passe</th>
                        <th>Statut</th>
                        -->
                        <th>Activation</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Nom</th>
                        <!--
                        <th>ID</th>
                        <th>Né.e le</th>
                        <th>Adresse</th>
                        <th>Tél.</th>
                        <th>E-mail</th>
                        <th>Login</th>
                        <th>Mot de passe</th>
                        <th>Statut</th>
                        -->
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
                <div class="table-responsive-sm">
                    <h2 class="text-white">Ajouter un utilisateur</h2>
                    <form method="post" action="/e5_php/traitement/admin/creer-util-tr" id="ajoutUtil">
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control form-control-sm mb-3" id="nom" name="nom" required
                                   maxlength="40">
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control form-control-sm mb-3" id="prenom" name="prenom"
                                   required maxlength="40">
                        </div>
                        <div class="form-group">
                            <label for="dateNaissance">Né.e le</label>
                            <input type="date" class="form-control form-control-sm mb-3" id="dateNaissance"
                                   name="dateNaissance" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Numéro de Téléphone</label>
                            <input type="text" class="form-control form-control-sm mb-3" id="telephone"
                                   name="telephone" required maxlength="10">
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control form-control-sm mb-3" id="adresse" name="adresse"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="mail">Adresse Mél</label>
                            <input type="email" class="form-control form-control-sm mb-3" id="mail" name="mail"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="login">Login</label>
                            <input type="text" class="form-control form-control-sm mb-3" id="login" name="login"
                                   required maxlength="40">
                        </div>
                        <div class="form-group">
                            <label for="mdp">Mot de passe</label>
                            <input type="password" class="form-control form-control-sm mb-3" id="mdp" name="mdp"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="listeStatut">Statut</label>
                            <select class="form-control form-control-sm mb-3" name="statut" id="listeStatut" required>
                                <option name="util" value="0">Utilisateur</option>
                                <option name="eleve" value="1">Elève</option>
                                <option name="parent" value="2">Parent</option>
                                <option name="prof" value="3">Professeur</option>
                                <option name="admin" value="4">Administrateur</option>
                            </select>
                        </div>
                        <table class="table table-borderless table-sm" id="statutUtil" style="width: 100%;">
                            <thead></thead>
                            <tbody>
                            <tr id="1">
                                <td>
                                    <label for="classe">Classe</label>
                                    <input class="form-control form-control-sm mb-3" type="text" name="classe"
                                           id="classe">
                                </td>
                            </tr>
                            <tr id="2">
                                <td>
                                    <label for="metier">Métier</label>
                                    <input class="form-control form-control-sm mb-3" type="text" name="metier"
                                           id="metier">
                                </td>
                            </tr>
                            <tr id="3">
                                <td>
                                    <label for="matiere">Matière</label>
                                    <input class="form-control form-control-sm mb-3" type="text" name="matiere"
                                           id="matiere">
                                </td>
                            </tr>
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                        <button type="submit" class="btn btn-primary">
                            Ajouter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /ajouter un utilisateur -->

<?php
// Footer
include_once '../../../include/footer.php';
// Script
include_once '../../../include/script.php';
?>
<!-- DataTables -->
<script type="text/javascript" src="/e5_php/vendor/datatables/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/e5_php/style/js/datatables.js"></script>

</body>
</html>
