<?php
/**
 * Created by PhpStorm.
 * User: arthurveys
 * Date: 09/01/16
 * Time: 17:12
 */

require_once 'controler/groupeController.php';
require_once 'model/DAO.php';

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);

session_start();

if(isset($_GET['page']))
{
    switch($_GET['page'])
    {
        case "home":

            break;

    }
}
else{
    getAllGroupes();
    echo "FIN";
}
