<?php
require_once __DIR__ . '/../Manager.php';

// création de la classe ManaParent
class ManaParent extends Manager
{
  // Méthode d'inscription pour un parent

  /**
   * @throws Exception
   */
  public function inscriptionParent(Parents $parent)
  {
      $bdd = (new BDD)->getBase();
      $req = $bdd->query('SELECT * FROM utilisateur WHERE statut = 1');
      $res = $req->fetchAll();
      // parcours de la table eleve pour verifier que les données ne soient pas les mêmes et concordent avec le parent
      foreach ($res as $verification) {
        if ($verification['prenom'] == $_POST['prenom']) {
          throw new Exception('Ce prénom existe déjà.');
        }
        if ($verification['dateNaissance'] == $_POST['dateNaissance']) {
          throw new Exception('Cette date de naissance n\'est pas possible.');
        }
        if ($verification['login'] == $_POST['login']) {
          throw new Exception('Ce login est déjà pris.');
        }
        if ($verification['telephone'] == $_POST['telephone']) {
          throw new Exception('Ce numéro de téléphone n\'est pas possible.');
        }
      }
          // preparation de la requête
          $req = $bdd->prepare('
              INSERT INTO utilisateur (nom, prenom, dateNaissance, adresse, telephone, mail, login, mdp, statut) VALUES (:nom, :prenom, :dateNaissance, :adresse, :telephone, :mail, :login, :mdp, :statut);
              INSERT INTO parent (idParent, metier, idEleve) VALUES (LAST_INSERT_ID(), :metier, :idEleve);
          ');
          // execution de la requête
          $res2 = $req->execute([
              'nom' => $parent->getNom(),
              'prenom' => $parent->getPrenom(),
              'dateNaissance' => $parent->getDateNaissance(),
              'adresse' => $parent->getAdresse(),
              'telephone' => $parent->getTelephone(),
              'mail' => $parent->getMail(),
              'login' => $parent->getLogin(),
              'mdp' => $parent->getMdp(),
              'statut' => $parent->getStatut(),
              'metier' => $parent->getMetier(),
              'idEleve' => $parent->getIdEleve()
          ]);
  //        var_dump($res2);
          if ($res2) {
              $req = $bdd->prepare('SELECT idUtilisateur, login, mdp, statut FROM utilisateur WHERE login = :login');
              $req->execute([
                  'login' => $parent->getLogin()
              ]);
              $res3 = $req->fetch();
              header('Location: /e5_php/template/themes/template/index');
              return $_SESSION['user'] = $res3;
          } else {
              // sinon redirection vers la page inscription
              throw new Exception('Inscription échouée.');
          }

      throw new Exception('Erreur.');
  }

}
