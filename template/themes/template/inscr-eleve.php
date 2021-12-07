<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../../include/head.php' ?>
    <title>Inscription</title>
</head>

<body>
<?php
// Preloader
include_once '../../../include/modal/preloader.php';
// Header
include_once '../../../include/header.php';
// ManaClasse
include_once '../../../manager/classe/ManaClasse.php';
$liste = new ManaClasse();
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
                            Inscription
                        </a>
                    </li>
                    <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                </ul>
                <p class="text-lighten">Inscrivez-vous sur le site en tant qu'étudiant.</p>
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
                <div class="modal-body">
                    <div class="login">
                        <form method="POST" action="/e5_php/traitement/eleve/inscription-tr.php" style="width:100%">
                            <div class="form-row">
                                <div class="col">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control form-control-sm mb-3" id="nom" name="nom"
                                           required maxlength="40" placeholder="ex : Schuman">
                                </div>
                                <div class="col">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" class="form-control form-control-sm mb-3" id="prenom"
                                           name="prenom" required maxlength="40" placeholder="ex : Robert">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dateNaissance">Né.e le</label>
                                <input type="date" class="form-control form-control-sm mb-3" id="dateNaissance"
                                       name="dateNaissance" required>
                            </div>
                            <div class="form-group">
                                <label for="telephone">Numéro de Téléphone</label>
                                <input type="text" class="form-control form-control-sm mb-3" id="telephone"
                                       name="telephone" required maxlength="10" placeholder="ex : 0123456789">
                            </div>
                            <div class="form-group">
                                <label for="adresse">Adresse</label>
                                <input type="text" class="form-control form-control-sm mb-3" id="adresse" name="adresse"
                                       required placeholder="ex : 123 rue Robert Schuman">
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="login">Login</label>
                                    <input type="text" class="form-control form-control-sm mb-3" id="login"
                                           name="login" required maxlength="40" placeholder="ex : rSchuman93">
                                </div>
                                <div class="col">
                                    <label for="mail">Adresse Mél</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">@</span>
                                        </div>
                                        <input type="email" class="form-control form-control-sm" id="mail"
                                               name="mail" required placeholder="ex : r.schuman@gmail.com">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="mdp">Mot de passe</label>
                                    <input type="password" class="form-control form-control-sm mb-3" id="mdp"
                                           name="mdp" required>
                                </div>
                                <div class="col">
                                    <label for="confirm">Confirmer</label>
                                    <input type="password" class="form-control form-control-sm mb-3" id="confirm"
                                           name="confirm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="idClasse">Classe</label>
                                <select class="form-control idClasse" name="idClasse" id="idClasse">
                                    <option value="">- SELECTIONNER -</option>
                                    <?php foreach ($res as $classe) { ?>
                                        <option value="<?= $classe['id_classe'] ?>"><?= $classe['nom'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                S'inscrire
                            </button>
                        </form>
                    </div>
                </div>
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
include_once '../../../include/footer.php';
// Script
include_once '../../../include/script.php';
?>

</body>
</html>
