<?php
require_once __DIR__ . '/../Manager.php';

// création de la classe ManaDiscus
class ManaDiscus extends Manager
{
// Méthode de création d'une discussion

    /**
     * @throws Exception
     */
    public function creerDiscussion(Discussion $discus)
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
        $req = $bdd->prepare('INSERT INTO discussion (idCreateur, idInvite, titre, description, dateCreation, archive) VALUES (:idCreateur, :idInvite, :titre, :description, NOW(), :archive)');
        $res2 = $req->execute([
            'idCreateur' => $discus->getIdCreateur(),
            'idInvite' => $discus->getIdInvite(),
            'titre' => $discus->getTitre(),
            'description' => $discus->getDescription(),
            'archive' => $discus->getArchive()
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

// Méthode d'affichage d'un utilisateur dans la session 'show'

    /**
     * @throws Exception
     */
    public function chercheDiscussion(Discussion $discus)
    {
        // on appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->prepare('SELECT * FROM discussion WHERE idDiscussion = :idDiscussion');
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
}