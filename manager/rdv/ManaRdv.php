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
      $statut = ['parent', 'professeur'];
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM rdv');
        $res = $req->fetchAll();

        // Cherche le créateur du rdv
        for ($i = 0; $i < 2; $i++) {
            $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN ' . $statut[$i] . ' ON ' . $statut[$i] . '.idUtil = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
            $req->execute([
                'idUtilisateur' => $_SESSION['user']['idUtilisateur']
            ]);
            $res2 = $req->fetch();
            if (isset($res2['idParent'])) {
                $idCreateurParent = $res2;
                break;
            } else if (isset($res2['idProf'])) {
                $idCreateurProf = $res2;
                break;
            }
        }
        // Cherche l'invité du rdv
if (isset($idCreateurProf)) {
   $req = $bdd->prepare('SELECT * FROM utilisateur INNER JOIN parent ON parent.idUtil = utilisateur.idUtilisateur WHERE idUtilisateur = :idUtilisateur');
   $req->execute([
       'idUtilisateur' => $_POST['idInviteParent']
   ]);
   $res3 = $req->fetch();
   //var_dump($_POST['idInviteParent']);
   //var_dump($res3);
   //die();
   if (isset($res3)) {
       $idInviteParent = $res3;
   }
} else if (isset($idCreateurParent)) {
  $req = $bdd->prepare('SELECT * FROM professeur WHERE idProf = :idProf');
  $req->execute([
      'idProf' => $_POST['idInviteProf']
  ]);
  $res3 = $req->fetch();
  if (isset($res3)) {
      $idInviteProf = $res3;
  }
}

        var_dump($res2);
        var_dump($res3);

        if (isset($idCreateurParent) && isset($idInviteProf)) {
        $req = $bdd->prepare('INSERT INTO rdv (objet, message, date, horaire, dateCreation, idCreateurParent, idInviteProf) VALUES (:objet, :message, :date, :horaire, NOW(), :idCreateurParent, :idInviteProf)');
        $res1 = $req->execute([
            'objet' => $rdv->getObjet(),
            'message' => $rdv->getMessage(),
            'date' => $rdv->getDate(),
            'horaire' => $rdv->getHoraire(),
            'idCreateurParent' => $idCreateurParent['idParent'],
            'idInviteProf' => $idInviteProf['idProf']
        ]);
        //var_dump($res1);

       }

        else if (isset($idCreateurProf) && isset($idInviteParent)) {
          $req = $bdd->prepare('INSERT INTO rdv (objet, message, date, horaire, dateCreation, idCreateurProf, idInviteParent) VALUES (:objet, :message, :date, :horaire, NOW(), :idCreateurProf, :idInviteParent)');
          $res1 = $req->execute([
              'objet' => $rdv->getObjet(),
              'message' => $rdv->getMessage(),
              'date' => $rdv->getDate(),
              'horaire' => $rdv->getHoraire(),
              'idCreateurProf' => $idCreateurProf['idProf'],
              'idInviteParent' => $idInviteParent['idParent']
          ]);


          //var_dump($res1);

        }
        //die();
        // S'il créé avec succès le rdv, alors il retourne un succès.
        if ($res1) {
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
