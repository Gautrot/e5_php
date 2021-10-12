<?php
session_start();
?>
<div>
    <table id="utilisateur" class="display" style="width:100%">
        <thead>
        <tr>
            <th colspan="2">Détail de l'utilisateur</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>Nom</th>
            <td><?php echo $_SESSION['show']['nom'] . ' ' . $_SESSION['show']['prenom']; ?></td>
        </tr>
        <tr>
            <th>Né.e le</th>
            <td><?php echo $_SESSION['show']['dateNaissance']; ?></td>
        </tr>
        <tr>
            <th>Tél.</th>
            <td><?php echo $_SESSION['show']['telephone']; ?></td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td><?php echo $_SESSION['show']['adresse']; ?></td>
        </tr>
        <tr>
            <th>E-mail</th>
            <td><?php echo $_SESSION['show']['mail']; ?></td>
        </tr>
        <tr>
            <th>Login</th>
            <td><?php echo $_SESSION['show']['login']; ?></td>
        </tr>
        <tr>
            <th>Mot de passe</th>
            <td><?php echo $_SESSION['show']['mdp']; ?></td>
        </tr>
        <tr>
            <th>Statut</th>
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
                    <th>Classe</th>
                    <td>' . $_SESSION['show']['classe'] . '</td>
                </tr>';
                break;
            case '2':
                echo '
                <tr>
                    <th>Métier</th>
                    <td>' . $_SESSION['show']['metier'] . '</td>
                </tr>
                <tr>
                    <th>Enfant</th>
                    <td>' . $_SESSION['show']['idEleve'] . '</td>
                </tr>';
                break;
            case '3':
                echo '
                <tr>
                    <th>Matière</th>
                    <td>' . $_SESSION['show']['matiere'] . '</td>
                </tr>';
                break;
            default:
                break;
        }
        ?>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>

<a href="../traitement/retour-session-tr">
    <input type="submit" value="Retour"/>
</a>
