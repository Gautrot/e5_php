<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <?php include_once '../../../include/head.php' ?>
    <title>Modifier</title>
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
                    <li class="list-inline-item"><a class="h2 text-primary font-secondary"
                                                    href="teacher.html">Profil</a></li>
                    <li class="list-inline-item text-white h3 font-secondary nasted">Modification</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- /page title -->

<!-- teacher details -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-5">
                <h3>Modification de <?php echo $_SESSION['edit']['nom']; ?></h3>
            </div>
            <div class="col-12">
                <form method="POST" action="/e5_php/traitement/modifier-util-tr.php" style="width:100%">
                    <div class="form-group">
                        <label for="idUtilisateur" hidden>ID</label>
                        <input type="text" class="form-control form-control-sm mb-3" id="idUtilisateur"
                               name="idUtilisateur" value="<?php echo $_SESSION['edit']['idUtilisateur']; ?>" hidden>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control form-control-sm mb-3" id="nom" name="nom" required
                               maxlength="40" value="<?php echo $_SESSION['edit']['nom']; ?>">
                        <small>Avant : <?php echo $_SESSION['edit']['nom']; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control form-control-sm mb-3" id="prenom" name="prenom" required
                               maxlength="40" value="<?php echo $_SESSION['edit']['prenom']; ?>">
                        <small>Avant : <?php echo $_SESSION['edit']['prenom']; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="dateNaissance">Né.e le</label>
                        <input type="date" class="form-control form-control-sm mb-3" id="dateNaissance"
                               name="dateNaissance" required value="<?php echo $_SESSION['edit']['dateNaissance']; ?>">
                        <small>Avant : <?php echo $_SESSION['edit']['dateNaissance']; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Numéro de Téléphone</label>
                        <input type="text" class="form-control form-control-sm mb-3" id="telephone" name="telephone"
                               required maxlength="10" value="<?php echo $_SESSION['edit']['telephone']; ?>">
                        <small>Avant : <?php echo $_SESSION['edit']['telephone']; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control form-control-sm mb-3" id="adresse" name="adresse"
                               required value="<?php echo $_SESSION['edit']['adresse']; ?>">
                        <small>Avant : <?php echo $_SESSION['edit']['adresse']; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="mail">Adresse Mél</label>
                        <input type="email" class="form-control form-control-sm mb-3" id="mail" name="mail"
                               required value="<?php echo $_SESSION['edit']['mail']; ?>">
                        <small>Avant : <?php echo $_SESSION['edit']['mail']; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" class="form-control form-control-sm mb-3" id="login" name="login" required
                               maxlength="40" value="<?php echo $_SESSION['edit']['login']; ?>">
                        <small>Avant : <?php echo $_SESSION['edit']['login']; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="mdp">Mot de passe</label>
                        <input type="password" class="form-control form-control-sm mb-3" id="mdp" name="mdp"
                               required value="<?php echo $_SESSION['edit']['mdp']; ?>">
                        <small>Avant : <?php echo $_SESSION['edit']['mdp']; ?></small>
                    </div>
                    <button type="submit" class="btn btn-primary">
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
                    <form method="POST" action="/e5_php/traitement/retour-session-modif-tr">
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
