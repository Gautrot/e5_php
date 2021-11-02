<?php
//session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../../include/head.php' ?>
    <title>Inscription</title>
</head>

<body>
<!-- preloader start -->
<?php include_once '../../../include/modal/preloader.php' ?>
<!-- preloader end -->

<!-- header -->
<?php include_once '../../../include/header.php';
include_once '../../../model/BDD.php'; ?>
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
                            Inscription
                        </a>
                    </li>
                    <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                </ul>
                <p class="text-lighten">Inscrivez-vous sur le site en tant que parent.</p>
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
                        <form method="POST" action="/e5_php/traitement/inscription-parent-tr.php" style="width:100%">
                            <div class="form-row">
                                <div class="col">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control form-control-sm mb-3" id="nom" name="nom"
                                           required
                                           maxlength="40" placeholder="ex : Robert">
                                </div>
                                <div class="col">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" class="form-control form-control-sm mb-3" id="prenom"
                                           name="prenom"
                                           required maxlength="40" placeholder="ex : Schuman">
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
                            <div class="form-group">
                                <label for="mail">Adresse Mail</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">@</span>
                                    </div>
                                    <input type="email" class="form-control form-control-sm" id="mail" name="mail"
                                           required placeholder="ex : r.schuman@gmail.com">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="login">Login</label>
                                <input type="text" class="form-control form-control-sm mb-3" id="login" name="login"
                                       required maxlength="40" placeholder="ex : rSchuman93">
                            </div>
                            <div class="form-group">
                                <label for="mdp">Mot de passe</label>
                                <input type="password" class="form-control form-control-sm mb-3" id="mdp" name="mdp"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="metier">Métier</label>
                                <input type="text" class="form-control form-control-sm mb-3" id="metier" name="metier"
                                       required placeholder="ex : Banquier.ère">
                            </div>
                            <div class="form-group">
                                <label for="adresse">Parent de :</label>
                                  <select>
                                <?php $bdd = (new BDD)->getBase();
                                $req = $bdd->query("SELECT nom, prenom FROM utilisateur WHERE statut = '1'");
                                $res = $req->fetchall();
                                foreach ($res as $value) { ?>
                                  <option value="">- SELECTIONNER -</option>
                                  <option value="<?php echo $value['nom'], $value['prenom']?>"><?php echo $value['nom'], $value['prenom']?></option>
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
                    <form method="POST" action="/e5_php/traitement/retour-session-admin-tr.php">
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
