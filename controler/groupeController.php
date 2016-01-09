<?php
/**
 * Created by PhpStorm.
 * User: arthurveys
 * Date: 09/01/16
 * Time: 18:12
 */

require_once '../model/DAO.php';

function getAllGroupes(){
    $request = 'select * from groupe';
    $db = new DAO();
    $result = $db->executeRequest($request);
    foreach($result as $value){
        var_dump($value);
    }

}