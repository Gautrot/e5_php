<?php
require_once __DIR__ . '/../Manager.php';

// création de la classe ManaDiscus
class ManaDiscus extends Manager
{
// Méthode de création d'une discussion

    /**
     * @throws Exception
     */
    public function creerDiscussion(Discussion $discus, Reponse $reponse)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM discussion');
        $res = $req->fetchAll();
        foreach ($res as $error) {
            // Vérifie les conditions lors de l'ajout d'une discussion.
            // S'il y a une erreur, la fonction s'arrête.
            switch ($error) {
                case ($error['titre'] == $_POST['titre']):
                    throw new Exception('Le titre de la discussion est déja pris.');
            }
        }
        $req = $bdd->prepare('
            INSERT INTO discussion (idCreateur, idInvite, titre, description, dateCreation) VALUES (:idCreateur, :idInvite, :titre, :description, NOW());
            INSERT INTO reponse (idDiscussion, idCreateur, reponse) VALUES (LAST_INSERT_ID(), :idCreateur, :reponse);
        ');
        $res2 = $req->execute([
            'idCreateur' => $discus->getIdCreateur(),
            'idInvite' => $discus->getIdInvite(),
            'titre' => $discus->getTitre(),
            'description' => $discus->getDescription(),
            'reponse' => $reponse->getReponse()
        ]);
        // S'il créé avec succès la discussion, alors il retourne un succès.
        if ($res2) {
            unset($_SESSION['erreur']);
            return;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Ajout échouée !');
    }

// Méthode de liste de discusssion

    /**
     * @throws Exception
     */
    public function listeDiscussion()
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM discussion ORDER BY dateCreation DESC');
        return $req->fetchAll();
    }

// Méthode d'affichage d'une discusssion

    /**
     * @throws Exception
     */
    public function chercheDiscussion(Discussion $discus)
    {
        // on appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT * FROM discussion INNER JOIN utilisateur ON utilisateur.idUtilisateur = discussion.idCreateur WHERE idDiscussion = :idDiscussion');
        $req->execute([
            'idDiscussion' => $discus->getIdDiscussion()
        ]);
        $res = $req->fetch();
        if ($res) {
            unset($_SESSION['erreur']);
            return $res;
        }
        // sinon affiche un message d'erreur
        throw new Exception('Erreur pendant la recherche de la discussion.', 1);
    }

// Méthode de réponse d'une discussion

    /**
     * @throws Exception
     */
    public function reponseDiscussion(Reponse $reponse)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('INSERT INTO reponse (idDiscussion, idCreateur, reponse, dateCreation) VALUES (:idDiscussion, :idCreateur, :reponse, NOW())');
        $res = $req->execute([
            'idDiscussion' => $reponse->getIdDiscussion(),
            'idCreateur' => $reponse->getIdCreateur(),
            'reponse' => $reponse->getReponse()
        ]);
        // S'il créé avec succès la discussion, alors il retourne un succès.
        if ($res) {
            unset($_SESSION['erreur']);
            return true;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Ajout échouée !');
    }

// Méthode de liste de réponse

    /**
     * @throws Exception
     */
    public function listeReponse()
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM reponse INNER JOIN utilisateur ON utilisateur.idUtilisateur = reponse.idCreateur ORDER BY dateCreation DESC');
        return $req->fetchAll();
    }
}