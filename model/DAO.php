<?php

/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 09/01/16
 * Time: 16:56
 */
class DAO
{
    private $db;

    private $DB_HOST= "localhost";
    private $DB_PORT=8889;
    private $DB_NAME="projetRobin";
    private $DB_USER="root";
    private $DB_PASS="root";
    /**
     * DAO constructor.
     * @param $db
     */
    public function __construct()
    {
        try {
            $dbh = new PDO('mysql:host=' . $this->DB_HOST . ';port=' . $this->DB_PORT . ';dbname=' . $this->DB_NAME, $this->DB_USER, $this->DB_PASS);
            $this->db = $dbh;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function executeRequest($request){
        try {
            $sth = $this->db->query($request);
            return $sth->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @return PDO
     */
    public function getDb()
    {
        return $this->db;
    }



}