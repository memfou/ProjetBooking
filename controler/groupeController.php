<?php
/**
 * Created by PhpStorm.
 * User: arthurveys
 * Date: 09/01/16
 * Time: 18:12
 */


function getAllGroupes(){
    $request = 'select * from groupe';
    $db = new DAO();
    $listgroupe = array();
    $result = $db->executeRequest($request);
    foreach($result as $value){
        $listgroupe[] = new groupe($value["groupeId"],$value["nom"],$value["description"],$value["imageHeader"]);
    }
    return $listgroupe;
}