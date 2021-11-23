<?php
require_once __DIR__ . '/../Manager.php';

// création de la classe ManaRdv
class ManaRdv extends Manager
{
// Méthode de création d'un évènement

    /**
     * @throws Exception
     */
    public function creerRDV(Rdv $rdv)
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM rdv');
        $res = $req->fetchAll();

        if ($user['statut'] === '2') {
        $req = $bdd->prepare('INSERT INTO rdv (objet, message, date, horaire, dateCreation, idCreateurParent, idInviteProf) VALUES (:idCreateur, :objet, :message, :date, :horaire, :dateCreation, idCreateurParent, :idInviteProf)');
        $res2 = $req->execute([
            'objet' => $rdv->getObjet(),
            'message' => $rdv->getMessage(),
            'date' => $rdv->getDate(),
            'horaire' => $rdv->getHoraire(),
            'idCreateurParent' => $res2[0],
            'idInviteProf' => $res3[0]
        ]); }

        else if ($user['statut'] === '3') {
          $req = $bdd->prepare('INSERT INTO rdv (objet, message, date, horaire, dateCreation, idCreateurProf, idInviteParent) VALUES (:idCreateur, :objet, :message, :date, :horaire, :dateCreation, idCreateurProf, :idInviteParent)');
          $res2 = $req->execute([
              'objet' => $rdv->getObjet(),
              'message' => $rdv->getMessage(),
              'date' => $rdv->getDate(),
              'horaire' => $rdv->getHoraire(),
              'idCreateurProf' => $res3[0],
              'idInviteParent' => $res2[0]
          ]);
        }
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
