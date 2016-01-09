<?php
  require_once("DAO.class.php");

  $db = new DAO();
echo "\nFonction Artiste :\n";
  $ar = $db->AfficherArtiste(1);
        if (!isset($ar)) {
          echo "L'artiste :".$ar." n'est pas connu, ";
          echo "On l'ajoute ... \n";
          $ar = $db->AjouterArtiste(1);
          var_dump($ar);
        }else {
          echo "L'artiste est déjà présent dans la base de données\n";
          var_dump($ar);
        }

$ar = $db->AfficherArtiste(1);
        if (!isset($ar)) {
          echo "L'artiste n'est pas connu, ";
          echo "On ne peut pas le modifier ... \n";
        }else {
          echo "L'artiste est présent dans la base de données, on le modifie ...\n ";
          var_dump($ar);
          $ar->nomAr = 'Lebron';
          $db->ModifierArtiste($ar);
          var_dump($ar);
        }
$ar = $db->AfficherArtiste(1);
        if (!isset($ar)) {
          echo "L'artiste n'est pas connu, ";
          echo "On ne peut pas le supprimer ... \n";
        }else {
          echo "L'artiste est présent dans la base de données, on le supprime ...\n ";
          var_dump($ar);
          $ar = $db->SupprimerArtiste(1);
        }

  echo "\nFonction Booker :\n";
  $bo = $db->AfficherBooker(1);
        if (!isset($bo)) {
          echo "Le booker :".$bo." n'est pas connu, ";
          echo "On l'ajoute ... \n";
          $bo = $db->AjouterBooker(1);
          var_dump($bo);
        }else {
          echo "Le booker est déjà présent dans la base de données\n";
          var_dump($bo);
        }

$bo = $db->AfficherBooker(1);
        if (!isset($bo)) {
          echo "Le booker n'est pas connu, ";
          echo "On ne peut pas le modifier ... \n";
        }else {
          echo "Le booker est présent dans la base de données, on le modifie ...\n ";
          var_dump($bo);
          $bo->nomB = 'Bernard Dufour';
          $bo->mdp = 'dufourbe';
          $db->ModifierBooker($bo);
          var_dump($bo);
        }
$bo = $db->AfficherBooker(1);
        if (!isset($bo)) {
          echo "Le booker n'est pas connu, ";
          echo "On ne peut pas le supprimer ... \n";
        }else {
          echo "Le booker est présent dans la base de données, on le supprime ...\n ";
          var_dump($bo);
          $bo = $db->SupprimerBooker(1);
        }


  echo "\n Fonction Evenement :\n";
  $ev = $db->AfficherEvenement(1);
        if (!isset($ev)) {
          echo "L'évènement :".$ev." n'est pas connu, ";
          echo "On l'ajoute ... \n";
          $ev = $db->AjouterEvenement(1);
          var_dump($ev);
        }else {
          echo "L'évènement est déjà présent dans la base de données\n";
          var_dump($ev);
        }
  $ev = $db->AfficherEvenement(1);
        if (!isset($ev)) {
          echo "L'évènement n'est pas connu, ";
          echo "On ne peut pas le modifier ... \n";
        }else {
          echo "L'évènement est présent dans la base de données, on le modifie ... \n";
          var_dump($ev);
          $ev->nomE = 'Soft Second Tour';
          $db->ModifierEvenement($ev);
          var_dump($ev);
        }

  $ev = $db->AfficherEvenement(1);
        if (!isset($ev)) {
          echo "L'évènement n'est pas connu, ";
          echo "On ne peut pas le supprimer ... \n";
        }else {
          echo "L'évènement est présent dans la base de données, on le supprime ...\n ";
          var_dump($ev);
          $ev = $db->SupprimerEvenement(1);
        }

  echo "\nFonction Groupe : \n";
  $gr = $db->AfficherGroupe(1);
        if (!isset($gr)) {
          echo "Le groupe :".$gr." n'est pas connu, ";
          echo "On l'ajoute ... \n";
          $gr = $db->AjouterGroupe(1);
          var_dump($gr);
        }else {
          echo "Le groupe est déjà présent dans la base de données\n";
          var_dump($gr);
        }

  $gr = $db->AfficherGroupe(1);
        if (!isset($gr)) {
          echo "Le groupe n'est pas connu, ";
          echo "On ne peut pas le modifier ... \n";
        }else {
          echo "Le groupe est présent dans la base de données, on le modifie ... \n";
          var_dump($gr);
          $gr->descriptionCG ='Hard Rock/Métal';
          $db->ModifierGroupe($gr);
          var_dump($gr);
        }

  $gr = $db->AfficherGroupe(1);
        if (!isset($gr)) {
          echo "Le groupe n'est pas connu, ";
          echo "On ne peut pas le supprimer ... \n";
        }else {
          echo "Le groupe est présent dans la base de données, on le supprime ... \n";
          var_dump($gr);
          $gr = $db->SupprimerGroupe(1);
        }

echo "\nFonction Actualité :\n";
$ac = $db->AfficherActualite(5);
      if (!isset($ac)) {
        echo "L'actu :".$ac." n'est pas connue, ";
        echo "On l'ajoute ... \n";
        $ac = $db->AjouterActualite(5);
        var_dump($ac);
      }else {
        echo "L'actu est déjà présente dans la base de données\n";
        var_dump($ac);
      }

$ac = $db->AfficherActualite(5);
        if (!isset($ac)) {
          echo "L'actu n'est pas connue, ";
          echo "On ne peut pas la modifier ... \n";
        }else {
          echo "L'actu est présente dans la base de données, on la modifie ...\n ";
          var_dump($ac);
          $ac->titreAc = 'test';
          $ac->texteAc = 'test';
          $ac->imageAc = 'image';
          $db->ModifierActualite($ac);
          var_dump($ac);
        }
$ac = $db->AfficherActualite(5);
      if (!isset($ac)) {
        echo "L'actu n'est pas connue, ";
        echo "On ne peut pas la supprimer ... \n";
      }else {
        echo "L'actu est présente dans la base de données, on la supprime ...\n ";
        var_dump($ac);
        $ac = $db->SupprimerActualite(5);
      }

?>
