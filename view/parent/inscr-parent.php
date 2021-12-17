<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../include/head.php' ?>
    <title>Inscription</title>
</head>

<body>
<?php
// Manager
include_once '../../manager/Manager.php';
// Preloader
include_once '../../include/modal/preloader.php';
// Header
include_once '../../include/header.php';
// ManaDiscus
include_once '../../manager/discussion/ManaDiscus.php';
$liste = new Manager();
$res = $liste->listeUtil();
// Modal Inscription
include_once '../../include/modal/inscription.php';
// Modal Mot de passe oublié
include_once '../../include/modal/mdp.php';
// Modal Login
include_once '../../include/modal/login.php';
include_once '../../include/modal/connectionEleve.php';
include_once '../../include/modal/connectionParent.php';
include_once '../../include/modal/connectionProf.php';
include_once '../../include/modal/connectionAdmin.php';
?>

<!-- about -->
<section class="page-title-section overlay">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item">
                        <a class="h2 text-primary font-secondary">
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
                        <form method="POST" action="/e5_php/traitement/parent/inscription-tr.php" style="width:100%">
                            <div class="form-row">
                                <div class="col mb-3">
                                    <label for="nom">Nom</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-pencil-square"
                                                     viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd"
                                                          d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="nom" name="nom"
                                               required maxlength="40" placeholder="ex : Schumann">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="prenom">Prénom</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-pencil-square"
                                                     viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd"
                                                          d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="prenom"
                                               name="prenom" required maxlength="40" placeholder="ex : Robert">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="dateNaissance">Né.e le</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-control-sm" id="dateNaissance"
                                           name="dateNaissance" required>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="telephone">Numéro de Téléphone</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-phone-fill" viewBox="0 0 16 16">
                                                <path d="M3 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V2zm6 11a1 1 0 1 0-2 0 1 1 0 0 0 2 0z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" id="telephone"
                                           name="telephone" required maxlength="10" placeholder="ex : 0123456789">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col mb-3">
                                    <label for="adresse">Adresse</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                          d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                                                    <path fill-rule="evenodd"
                                                          d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="adresse"
                                               name="adresse" required placeholder="ex : 5 Av. du Général de Gaulle">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="ville">Ville / Commune</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                          d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/>
                                                    <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="ville" name="ville"
                                               maxlength="40" required placeholder="Dugny">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="codePostal">Code Postal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-123" viewBox="0 0 16 16">
                                                    <path d="M2.873 11.297V4.142H1.699L0 5.379v1.137l1.64-1.18h.06v5.961h1.174Zm3.213-5.09v-.063c0-.618.44-1.169 1.196-1.169.676 0 1.174.44 1.174 1.106 0 .624-.42 1.101-.807 1.526L4.99 10.553v.744h4.78v-.99H6.643v-.069L8.41 8.252c.65-.724 1.237-1.332 1.237-2.27C9.646 4.849 8.723 4 7.308 4c-1.573 0-2.36 1.064-2.36 2.15v.057h1.138Zm6.559 1.883h.786c.823 0 1.374.481 1.379 1.179.01.707-.55 1.216-1.421 1.21-.77-.005-1.326-.419-1.379-.953h-1.095c.042 1.053.938 1.918 2.464 1.918 1.478 0 2.642-.839 2.62-2.144-.02-1.143-.922-1.651-1.551-1.714v-.063c.535-.09 1.347-.66 1.326-1.678-.026-1.053-.933-1.855-2.359-1.845-1.5.005-2.317.88-2.348 1.898h1.116c.032-.498.498-.944 1.206-.944.703 0 1.206.435 1.206 1.07.005.64-.504 1.106-1.2 1.106h-.75v.96Z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="codePostal"
                                               name="codePostal" maxlength="5" required placeholder="93440">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col mb-3">
                                    <label for="login">Login</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="login"
                                               name="login" required maxlength="40" placeholder="ex : rSchuman93">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="mail">Adresse Mél</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-at" viewBox="0 0 16 16">
                                                    <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control form-control-sm" id="mail"
                                               name="mail" required placeholder="ex : r.schuman@gmail.com">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col mb-3">
                                    <label for="mdp">Mot de passe</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                                                    <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control form-control-sm" id="mdp"
                                               name="mdp" maxlength="40" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="confirm">Confirmer</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                                                    <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control form-control-sm" id="confirm"
                                               name="confirm" maxlength="40" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="metier">Métier</label>
                                <input type="text" class="form-control form-control-sm mb-3" id="metier" name="metier"
                                       required placeholder="ex : Français">
                            </div>
                            <div class="form-group">
                                <label for="idEleve">Parent de :</label>
                                <select class="form-control idEleve" name="idEleve" id="idEleve">
                                    <option value="">- SELECTIONNER -</option>
                                    <?php foreach ($res as $invite) {
                                        if ($invite['statut'] == '1') { ?>
                                            <option value="<?= $invite['idEleve'] ?>"><?= $invite['nom'] . ' ' . $invite['prenom'] ?></option>
                                        <?php }
                                    } ?>
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
                    <form method="POST" action="/e5_php/index">
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
include_once '../../include/footer.php';
// Script
include_once '../../include/script.php';
?>

</body>
</html>
