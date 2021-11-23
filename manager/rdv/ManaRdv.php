<?php
require_once __DIR__ . '/../Manager.php';

// création de la classe ManaRdv
class ManaRdv extends Manager
{
// Méthode de création d'un évènement

    /**
     * @throws Exception
     */
    public function creerRDV(rdv $rdv)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM rdv');
        $res = $req->fetchAll();
        foreach ($res as $error) {
            // Vérifie les conditions lors de l'ajout d'un évènement.
            // S'il y a une erreur, la fonction s'arrête.
            switch ($error) {
                case ($error['objet'] == $_POST['objet']):
                    throw new Exception('Le nom est déja pris dans un autre rdv.');
            }
        }
        $req = $bdd->prepare('INSERT INTO rdv (idCreateur, objet, organisateur, date, horaire, dateCreation) VALUES (:idCreateur, :objet, :organisateur, :type, :date, :horaire)');
        $res2 = $req->execute([
            'idCreateur' => $rdv->getIdCreateur(),
            'objet' => $rdv->getObjet(),
            'organisateur' => $rdv->getOrganisateur(),
            'objet' => $rdv->getObjet(),
            'date' => $rdv->getDate(),
            'horaire' => $rdv->getHoraire()
        ]);
        // S'il créé avec succès le rdv, alors il retourne un succès.
        if ($res2) {
            unset($_SESSION['erreur']);
            return;
        }
        // Sinon, on affiche un message d'erreur
        throw new Exception('Ajout échouée !');
    }

// Méthode de liste de rdv

    /**
     * @throws Exception
     */
    public function listeRdv()
    {
        #Instancie la classe BDD
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM rdv ORDER BY dateCreation DESC');
        return $req->fetchAll();
    }
}
