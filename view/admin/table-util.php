<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Table des utilisateurs</title>
    <link rel="stylesheet" href="../../vendor/datatables/datatables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../../style/css/datatables.css">
    <script type="text/javascript" src="../../vendor/components/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../../vendor/datatables/datatables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../../style/js/datatables.js"></script>
</head>

<body>
<div>
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
<div>
    <h1>Ajouter un utilisateur</h1>
    <form method="post" action="../../traitement/creer-util-tr">
        <table>
            <thead></thead>
            <tbody>
            <tr>
                <td>
                    <label>
                        <input type="text" name="nom" placeholder="Nom" required maxlength="40">
                    </label>
                </td>
                <td>
                    <label>
                        <input type="text" name="prenom" placeholder="Prénom" required maxlength="40">
                    </label>
                </td>
                <td>
                    <label>
                        <input type="date" name="dateNaissance" placeholder="Date de naissance" required>
                    </label>
                </td>
                <td>
                    <label>
                        <input type="text" name="adresse" placeholder="Adresse" required>
                    </label>
                </td>
                <td>
                    <label>
                        <input type="text" name="telephone" placeholder="No. Téléphone" required maxlength="10">
                    </label>
                </td>
                <td>
                    <label>
                        <input type="email" name="mail" placeholder="E-mail" required>
                    </label>
                </td>
                <td>
                    <label>
                        <input type="text" name="login" placeholder="Login" required maxlength="40">
                    </label>
                </td>
                <td>
                    <label>
                        <input type="password" name="mdp" placeholder="Mot de passe" required>
                    </label>
                </td>
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
                <td>
                    <input type="submit" value="Ajouter"/>
                </td>
            </tr>
            </tbody>
            <tfoot></tfoot>
    </form>
</div>
<div>
    <h1>Se déconnecter</h1>
    <form method="post" action="../../traitement/deconnexion-tr">
        <button type="submit">Se déconnecter</button>
    </form>
</div>
</body>

</html>
