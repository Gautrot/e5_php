<?php
require_once __DIR__ . '/../Manager.php';

// création de la classe modifMDP
class MDP_Modif extends Manager
{
// Méthode de modification mot de passe

    /**
     * @throws Exception
     */
    public function modifMDP(Utilisateur $MDP_Modif)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM utilisateur');
        $res = $req->fetchAll();
        $req = $bdd->prepare('UPDATE utilisateur SET mdp = :mdp WHERE mail = :mail');
        $req->execute([
            'mdp' => $MDP_Modif->getMdp()
        ]);
        $req = $bdd->prepare('SELECT idUtilisateur, login, mdp, validUtilisateur FROM utilisateur WHERE mail = :mail');
        $req->execute([
            'mail' => $MDP_Modif->getMail()
        ]);
        $res2 = $req->fetch();
        // S'il modifie avec succès l'étudiant, alors il envoie la session.
        if ($res2) {
            unset($_SESSION['erreur']);
            return $_SESSION['user'] = $res2;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Modification échouée !');
    }
}