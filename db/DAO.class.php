<?php
require_once("Artiste.class.php");
require_once("Booker.class.php");
require_once("Evenement.class.php");
require_once("Groupe.class.php");
require_once("Actualite.class.php");
require_once("faitPartie.class.php");
require_once("organise.class.php");
require_once("participeArtiste.class.php");
require_once("participeGroupe.class.php");
require_once("paye.class.php");
require_once("soccupe.class.php");

class DAO {

    private $db; // L'objet de la base de donnée

    // Ouverture de la base de donnée
    function __construct() {
        $dsn = 'sqlite:booker.db'; // Data source name
        try {
            $this->db = new PDO($dsn);
        } catch (PDOException $e) {
            exit("Erreur ouverture BD : " . $e->getMessage());
        }
    }
    //////////////////////////////////////////////////////////
    // Methodes CRUD sur Artiste
    //////////////////////////////////////////////////////////
    // Crée un nouvel artiste à partir d'un id
    // Si l'artiste existe déjà on ne le crée pas
    function AfficherArtiste($idAr){
      try{
        $requete ="SELECT * FROM artiste WHERE idAr = '$idAr'";
        $reponse = $this->db->query($requete);
        if($reponse){
          $reponse = $reponse->fetchAll(PDO::FETCH_CLASS,'Artiste');
        }
      }catch (PDOException $e) {
        die('erreur'.$e->getMessage());
      }
      if($reponse){
        return $reponse[0];
      }else{
        return NULL;
      }
    }
    function AjouterArtiste($idAr) {
      //ajoute un nouvel artiste
      $artiste = $this->AfficherArtiste($idAr);
      if ($artiste == NULL){
        try{
         $q = "INSERT INTO artiste (idAr) values ('$idAr')";
         $r = $this->db->exec($q);
            if ($r == 0){
              die("Erreur AjouterArtiste : pas d'artiste inséré\n");
            }
         }catch (PDOException $e){
           die("PDO Error : ".$e->getMessage());
         }
         return $this->AfficherArtiste($idAr);
       }else {
         return $artiste;
       }
     }

    function SupprimerArtiste($idAr) {
      //supprime un artiste
      $artiste = $this->AfficherArtiste($idAr);
      if ($artiste != NULL){
        try{
          $requete ="SELECT * FROM faitPartie WHERE idAr = '$idAr'";
          $reponse = $this->db->query($requete);
          $nbr = $reponse->rowCount();
          var_dump($nbr);
          if($nbr != 0){
            echo "Artiste non présent dans la table faitPartie, on continue ...\n";
          }else{
            $reponse = $reponse->fetchAll(PDO::FETCH_CLASS,'faitPartie');
            $q ="DELETE FROM faitPartie WHERE idAr = '$idAr'";
            $r = $this->db->exec($q);
            if($r == 0){
              die("Erreur SupprimerArtiste : pas d'artiste supprimé dans la table faitPartie\n");
            }else{
              echo "Suppression réussie de la table faitPartie\n";
            }
          }
         }catch (PDOException $e){
             die("PDO Error : ".$e->getMessage());
         }

         try{
           $requete ="SELECT * FROM participeArtiste WHERE idAr = '$idAr'";
           $reponse = $this->db->query($requete);
           $nbr = $reponse->rowCount();
           var_dump($nbr);
           if($nbr != 0){
             echo "Artiste non présent dans la table participeArtiste, on continue ...\n";
           }else{
             $reponse = $reponse->fetchAll(PDO::FETCH_CLASS,'participeArtiste');
             $q ="DELETE FROM participeArtiste WHERE idAr = '$idAr'";
             $r = $this->db->exec($q);
             if($r == 0){
               die("Erreur SupprimerArtiste : pas d'artiste supprimé dans la table participeArtiste\n");
             }else{
               echo "Suppression réussie de la table participeArtiste\n";
             }
           }
          }catch (PDOException $e){
              die("PDO Error : ".$e->getMessage());
          }

          try{
            $requete ="SELECT * FROM paye WHERE idAr = '$idAr'";
            $reponse = $this->db->query($requete);
            $nbr = $reponse->rowCount();
            var_dump($nbr);
            if($nbr != 0){
              echo "Artiste non présent dans la table paye, on continue ...\n";
            }else{
              $reponse = $reponse->fetchAll(PDO::FETCH_CLASS,'paye');
              $q ="DELETE FROM paye WHERE idAr = '$idAr'";
              $r = $this->db->exec($q);
              if($r == 0){
                die("Erreur SupprimerArtiste : pas d'artiste supprimé dans la table paye\n");
              }else{
                echo "Suppression réussie de la table paye\n";
              }
            }
           }catch (PDOException $e){
               die("PDO Error : ".$e->getMessage());
           }

           try{
             $requete ="SELECT * FROM soccupe WHERE idAr = '$idAr'";
             $reponse = $this->db->query($requete);
             $nbr = $reponse->rowCount();
             var_dump($nbr);
             if($nbr != 0){
               echo "Artiste non présent dans la table soccupe, on continue ...\n";
             }else{
               $reponse = $reponse->fetchAll(PDO::FETCH_CLASS,'soccupe');
               $q ="DELETE FROM soccupe WHERE idAr = '$idAr'";
               $r = $this->db->exec($q);
               if($r == 0){
                 die("Erreur SupprimerArtiste : pas d'artiste supprimé dans la table soccupe\n");
               }else{
                 echo "Suppression réussie de la table soccupe\n";
               }
             }
            }catch (PDOException $e){
                die("PDO Error : ".$e->getMessage());
            }

        try{
         $q = "DELETE FROM artiste WHERE idAr='$idAr'";
         $r = $this->db->exec($q);
         if ($r == 0){
           die("Erreur SupprimerArtiste : pas d'artiste supprimé\n");
         }else {
           echo "Suppression réussie de la table artiste\n";
         }
         }catch (PDOException $e){
             die("PDO Error : ".$e->getMessage());
         }
       }else {
         echo "L'artiste que vous souhaitez supprimer n'existe pas !\n";
       }
     }

     function ModifierArtiste(Artiste $artiste) {
       //modifie un artiste
       $nomAr = $this->db->quote($artiste->getNomAr());
       $prenomAr = $this->db->quote($artiste->getPrenomAr());
       $roleAr = $this->db->quote($artiste->getRoleAr());
       $telephoneAr = $this->db->quote($artiste->getTelephoneAr());
       $adresseAr = $this->db->quote($artiste->getAdresseAr());
       $emailAr = $this->db->quote($artiste->getEmailAr());
       $descriptionCAr = $this->db->quote($artiste->getDescriptionCAr());
       $descriptionLAr = $this->db->quote($artiste->getDescriptionLAr());
       $lienAr = $this->db->quote($artiste->getLienAr());
       $imageAr = $this->db->quote($artiste->getImageAr());
       $solde = $this->db->quote($artiste->getSolde());
         try{
           $q = "UPDATE artiste SET nomAr= $nomAr, prenomAr = $prenomAr, roleAr = $roleAr,
           telephoneAr = $telephoneAr, adresseAr = $adresseAr, emailAr = $emailAr,
           descriptionCAr =  $descriptionCAr, descriptionLAr = $descriptionLAr,
           lienAr = $lienAr, imageAr = $imageAr, solde = $solde WHERE idAr={$artiste->idAr}";
           $r = $this->db->exec($q);
           if($r == 0){
             die("Artiste non modifié\n");
           }
          }catch (PDOException $e){
              die("PDO Error : ".$e->getMessage());
          }
      }

    //////////////////////////////////////////////////////////
    // Methodes CRUD sur Groupe
    //////////////////////////////////////////////////////////
    // Crée un nouveau groupe à partir d'un id
    // Si le groupe existe déjà on ne le crée pas
    function AfficherGroupe($idG){
      try{
        $requete ="SELECT * FROM groupe WHERE idG = '$idG'";
        $reponse = $this->db->query($requete);
        if($reponse){
          $reponse = $reponse->fetchAll(PDO::FETCH_CLASS,'Groupe');
        }
      }catch (PDOException $e) {
        die('erreur'.$e->getMessage());
      }
      if($reponse){
        return $reponse[0];
      }else{
        return NULL;
      }
    }

    function AjouterGroupe($idG) {
      //ajoute un nouveau groupe
      $groupe = $this->AfficherGroupe($idG);
      if ($groupe == NULL){
        try{
         $q = "INSERT INTO groupe (idG) values('$idG')";
         $r = $this->db->exec($q);
      if ($r == 0){
         die("Erreur AjouterGroupe : pas de groupe inséré\n");
      }
      return $this->AfficherGroupe($idG);
         }catch (PDOException $e){
      die("PDO Error : ".$e->getMessage());
         }
       }else {
         return $groupe;
       }
     }

    function SupprimerGroupe($idG) {
      //supprime un groupe
      $groupe = $this->AfficherGroupe($idG);
      if ($groupe != NULL){
        try{
          $requete ="SELECT * FROM faitPartie WHERE idG = '$idG'";
          $reponse = $this->db->query($requete);
          $nbr = $reponse->rowCount();
          var_dump($nbr);
          if($nbr != 0){
            echo "Groupe non présent dans la table faitPartie, on continue ...\n";
          }else{
            $reponse = $reponse->fetchAll(PDO::FETCH_CLASS,'faitPartie');
            $q ="DELETE FROM faitPartie WHERE idG = '$idG'";
            $r = $this->db->exec($q);
            if($r == 0){
              die("Erreur SupprimerGroupe : pas de groupe supprimé dans la table faitPartie\n");
            }else{
              echo "Suppression réussie de la table faitPartie\n";
            }
          }
         }catch (PDOException $e){
             die("PDO Error : ".$e->getMessage());
         }

         try{
           $requete ="SELECT * FROM participeGroupe WHERE idG = '$idG'";
           $reponse = $this->db->query($requete);
           $nbr = $reponse->rowCount();
           var_dump($nbr);
           if($nbr != 0){
             echo "Groupe non présent dans la table participeGroupe, on continue ...\n";
           }else{
             $reponse = $reponse->fetchAll(PDO::FETCH_CLASS,'participeGroupe');
             $q ="DELETE FROM participeGroupe WHERE idG = '$idG'";
             $r = $this->db->exec($q);
             if($r == 0){
               die("Erreur SupprimerGroupe : pas de groupe supprimé dans la table participeGroupe\n");
             }else{
               echo "Suppression réussie de la table participeGroupe\n";
             }
           }
          }catch (PDOException $e){
              die("PDO Error : ".$e->getMessage());
          }

        try{
         $q = "DELETE FROM groupe WHERE idG='$idG'";
         $r = $this->db->exec($q);
         if ($r == 0){
           die("Erreur SupprimerGroupe : pas de groupe supprimé\n");
         }else {
           echo "Suppression réussie de la table Groupe\n";
         }
         }catch (PDOException $e){
             die("PDO Error : ".$e->getMessage());
         }
       }else {
         echo "Le groupe que vous souhaitez supprimer n'existe pas !\n";
       }
     }

     function ModifierGroupe(Groupe $groupe) {
       //modifie un groupe
       $nomG = $this->db->quote($groupe->getNomG());
       $descriptionCG = $this->db->quote($groupe->getDescriptionCG());
       $descriptionLG = $this->db->quote($groupe->getDescriptionLG());
       $lienG = $this->db->quote($groupe->getLienG());
       $videoG = $this->db->quote($groupe->getVideoG());
       $imageG = $this->db->quote($groupe->getImageG());
         try{
           $q = "UPDATE groupe SET nomG= $nomG, descriptionCG =  $descriptionCG, descriptionLG = $descriptionLG,
           lienG = $lienG, videoG = $videoG, imageG = $imageG WHERE idG={$groupe->idG}";
           $r = $this->db->exec($q);
           if($r == 0){
             die("Groupe non modifié\n");
           }
          }catch (PDOException $e){
              die("PDO Error : ".$e->getMessage());
          }
      }

    //////////////////////////////////////////////////////////
    // Methodes CRUD sur Evènement
    //////////////////////////////////////////////////////////
    // Crée un nouvel évènement à partir d'un id
    // Si l'évènement existe déjà on ne le crée pas
    //Affichage d'un évènement
    function AfficherEvenement($idE){
      try{
        $requete ="SELECT * FROM evenements WHERE idE = '$idE'";
        $reponse = $this->db->query($requete);
        if($reponse){
          $reponse = $reponse->fetchAll(PDO::FETCH_CLASS,'Evenement');
        }
      }catch (PDOException $e) {
        die('erreur'.$e->getMessage());
      }
      if($reponse){
        return $reponse[0];
      }else{
        return NULL;
      }
    }

    function AjouterEvenement($idE) {
      //ajoute un nouvel evenement
      $evenement = $this->AfficherEvenement($idE);
      if ($evenement == NULL){
        try{
         $q = "INSERT INTO evenements (idE) values('$idE')";
         $r = $this->db->exec($q);
      if ($r == 0){
         die("Erreur AjouterEvenement : pas d'evenement inséré\n");
      }
         }catch (PDOException $e){
      die("PDO Error : ".$e->getMessage());
         }
         return $this->AfficherEvenement($idE);
       }else {
         return $evenement;
       }
     }

    function SupprimerEvenement($idE) {
      //supprime un evenement
      $evenement = $this->AfficherEvenement($idE);
      if ($evenement != NULL){
        try{
          $requete ="SELECT * FROM participeArtiste WHERE idE = '$idE'";
          $reponse = $this->db->query($requete);
          $nbr = $reponse->rowCount();
          var_dump($nbr);
          if($nbr != 0){
            echo "Evenement non présent dans la table participeArtiste, on continue ...\n";
          }else{
            $reponse = $reponse->fetchAll(PDO::FETCH_CLASS,'participeArtiste');
            $q ="DELETE FROM participeArtiste WHERE idE = '$idE'";
            $r = $this->db->exec($q);
            if($r == 0){
              die("Erreur SupprimerEvenement : pas d'evenement supprimé dans la table participeArtiste\n");
            }else{
              echo "Suppression réussie de la table participeArtiste\n";
            }
          }
         }catch (PDOException $e){
             die("PDO Error : ".$e->getMessage());
         }

         try{
           $requete ="SELECT * FROM participeGroupe WHERE idE = '$idE'";
           $reponse = $this->db->query($requete);
           $nbr = $reponse->rowCount();
           var_dump($nbr);
           if($nbr != 0){
             echo "Evenement non présent dans la table participeGroupe, on continue ...\n";
           }else{
             $reponse = $reponse->fetchAll(PDO::FETCH_CLASS,'participeGroupe');
             $q ="DELETE FROM participeGroupe WHERE idE = '$idE'";
             $r = $this->db->exec($q);
             if($r == 0){
               die("Erreur SupprimerEvenement : pas d'evenement supprimé dans la table participeGroupe\n");
             }else{
               echo "Suppression réussie de la table participeGroupe\n";
             }
           }
          }catch (PDOException $e){
              die("PDO Error : ".$e->getMessage());
          }

          try{
            $requete ="SELECT * FROM organise WHERE idE = '$idE'";
            $reponse = $this->db->query($requete);
            $nbr = $reponse->rowCount();
            var_dump($nbr);
            if($nbr != 0){
              echo "Evenement non présent dans la table organise, on continue ...\n";
            }else{
              $reponse = $reponse->fetchAll(PDO::FETCH_CLASS,'organise');
              $q ="DELETE FROM organise WHERE idE = '$idE'";
              $r = $this->db->exec($q);
              if($r == 0){
                die("Erreur SupprimerEvenement : pas d'evenement supprimé dans la table organise\n");
              }else{
                echo "Suppression réussie de la table organise\n";
              }
            }
           }catch (PDOException $e){
               die("PDO Error : ".$e->getMessage());
           }

        try{
         $q = "DELETE FROM evenements WHERE idE='$idE'";
         $r = $this->db->exec($q);
         if ($r == 0){
           die("Erreur SupprimerEvenement : pas d'evenement supprimé\n");
         }else {
           echo "Suppression réussie de la table evenements\n";
         }
         }catch (PDOException $e){
             die("PDO Error : ".$e->getMessage());
         }
       }else {
         echo "L'evenement que vous souhaitez supprimer n'existe pas !\n";
       }
     }

     function ModifierEvenement(Evenement $evenement) {
       //modifie un evenement
       $nomE = $this->db->quote($evenement->getNomE());
       $dateE = $this->db->quote($evenement->getDateE());
       $lieuE = $this->db->quote($evenement->getLieuE());
       $lienBE = $this->db->quote($evenement->getLienBE());
       $infoE = $this->db->quote($evenement->getInfoE());
       $imageE = $this->db->quote($evenement->getImageE());
         try{
           $q = "UPDATE evenements SET nomE= $nomE, dateE = $dateE, lieuE = $lieuE,
           lienBE = $lienBE, infoE = $infoE, imageE = $imageE WHERE idE={$evenement->idE}";
           $r = $this->db->exec($q);
           if($r == 0){
             die("Evenement non modifié\n");
           }
          }catch (PDOException $e){
              die("PDO Error : ".$e->getMessage());
          }
      }

     //////////////////////////////////////////////////////////
     // Methodes CRUD sur Booker
     //////////////////////////////////////////////////////////
     // Crée un nouveau booker à partir d'un id
     // Si le booker existe déjà on ne le crée pas
     //Affichage d'un booker
     function AfficherBooker($idB){
       try{
         $requete ="SELECT * FROM booker WHERE idB = '$idB'";
         $reponse = $this->db->query($requete);
         if($reponse){
           $reponse = $reponse->fetchAll(PDO::FETCH_CLASS,'Booker');
         }
       }catch (PDOException $e) {
         die('erreur'.$e->getMessage());
       }
       if($reponse){
         return $reponse[0];
       }else{
         return NULL;
       }
     }

     function AjouterBooker($idB) {
       //ajoute un nouveau booker
       $booker = $this->AfficherBooker($idB);
       if ($booker == NULL){
         try{
          $q = "INSERT INTO booker (idB) values('$idB')";
          $r = $this->db->exec($q);
       if ($r == 0){
          die("Erreur AjouterBooker : pas de booker inséré\n");
       }
       return $this->AfficherBooker($idB);
          }catch (PDOException $e){
       die("PDO Error : ".$e->getMessage());
          }
        }else {
          return $booker;
        }
      }

     function SupprimerBooker($idB) {
       //supprime un booker
       $booker = $this->AfficherBooker($idB);
       if ($booker != NULL){
         try{
           $requete ="SELECT * FROM soccupe WHERE idB = '$idB'";
           $reponse = $this->db->query($requete);
           $nbr = $reponse->rowCount();
           var_dump($nbr);
           if($nbr != 0){
             echo "Booker non présent dans la table soccupe, on continue ...\n";
           }else{
             $reponse = $reponse->fetchAll(PDO::FETCH_CLASS,'soccupe');
             $q ="DELETE FROM soccupe WHERE idB = '$idB'";
             $r = $this->db->exec($q);
             if($r == 0){
               die("Erreur SupprimerBooker : pas de booker supprimé dans la table soccupe\n");
             }else{
               echo "Suppression réussie de la table soccupe\n";
             }
           }
          }catch (PDOException $e){
              die("PDO Error : ".$e->getMessage());
          }

         try{
          $q = "DELETE FROM booker WHERE idB='$idB'";
          $r = $this->db->exec($q);
          if ($r == 0){
            die("Erreur SupprimerBooker : pas de booker supprimé\n");
          }else {
            echo "Suppression réussie de la table booker\n";
          }
          }catch (PDOException $e){
              die("PDO Error : ".$e->getMessage());
          }
        }else {
          echo "Le booker que vous souhaitez supprimer n'existe pas !\n";
        }
      }

      function ModifierBooker(Booker $booker) {
        //modifie un  booker
        $nomB = $this->db->quote($booker->getNomB());
        $mdp = $this->db->quote($booker->getMdp());
        $infoB = $this->db->quote($booker->getInfoB());
          try{
            $q = "UPDATE booker SET nomB= $nomB, mdp = $mdp, infoB = $infoB
             WHERE idB={$booker->idB}";
            $r = $this->db->exec($q);
            if($r == 0){
              die("Booker non modifié\n");
            }
           }catch (PDOException $e){
               die("PDO Error : ".$e->getMessage());
           }
       }

       //////////////////////////////////////////////////////////
       // Methodes CRUD sur Actualite
       //////////////////////////////////////////////////////////
       // Crée une nouvelle actu à partir d'un id
       // Si l'actu existe déjà on ne la crée pas
       //Affichage d'une actu
       function AfficherActualite($idAc){
         try{
           $requete ="SELECT * FROM actualites WHERE idAc = '$idAc'";
           $reponse = $this->db->query($requete);
           if($reponse){
             $reponse = $reponse->fetchAll(PDO::FETCH_CLASS,'Actualite');
           }
         }catch (PDOException $e) {
           die('erreur'.$e->getMessage());
         }
         if($reponse){
           return $reponse[0];
         }else{
           return NULL;
         }
       }

       function AjouterActualite($idAc) {
         //ajoute une nouvelle actu
         $actu = $this->AfficherActualite($idAc);
         if ($actu == NULL){
           try{
            $q = "INSERT INTO actualites (idAc) values('$idAc')";
            $r = $this->db->exec($q);
         if ($r == 0){
            die("Erreur AjouterActualite : pas d'actu insérée\n");
         }
         return $this->AfficherActualite($idAc);
            }catch (PDOException $e){
         die("PDO Error : ".$e->getMessage());
            }
          }else {
            return $actu;
          }
        }

       function SupprimerActualite($idAc) {
         //supprime une actu
         $actu = $this->AfficherActualite($idAc);
         if ($actu != NULL){
           try{
            $q = "DELETE FROM actualites WHERE idAc='$idAc'";
            $r = $this->db->exec($q);
            if ($r == 0){
              die("Erreur SupprimerActualite : pas d'actu supprimée\n");
            }else {
              echo "Suppression réussie de la table actualité\n";
            }
            }catch (PDOException $e){
                die("PDO Error : ".$e->getMessage());
            }
          }else {
            echo "L'actu que vous souhaitez supprimer n'existe pas !\n";
          }
        }

        function ModifierActualite(Actualite $actu) {
          //modifie une actu
          $titreAc = $this->db->quote($actu->getTitreAc());
          $texteAc = $this->db->quote($actu->getTexteAc());
          $imageAc = $this->db->quote($actu->getImageAc());
            try{
              $q = "UPDATE actualites SET titreAc= $titreAc, texteAc = $texteAc, imageAc = $imageAc
               WHERE idAc={$actu->idAc}";
              $r = $this->db->exec($q);
              if($r == 0){
                die("Actu non modifiée\n");
              }
             }catch (PDOException $e){
                 die("PDO Error : ".$e->getMessage());
             }
         }
}
?>
