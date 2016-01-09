<?php

/**
 * Created by PhpStorm.
 * User: arthurveys
 * Date: 09/01/16
 * Time: 16:50
 */
class evenement
{
    private $id;
    private $nom;
    private $date;
    private $lieuadresse;
    private $lieuville;
    private $lieucp;
    private $description;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getLieuadresse()
    {
        return $this->lieuadresse;
    }

    /**
     * @param mixed $lieuadresse
     */
    public function setLieuadresse($lieuadresse)
    {
        $this->lieuadresse = $lieuadresse;
    }

    /**
     * @return mixed
     */
    public function getLieuville()
    {
        return $this->lieuville;
    }

    /**
     * @param mixed $lieuville
     */
    public function setLieuville($lieuville)
    {
        $this->lieuville = $lieuville;
    }

    /**
     * @return mixed
     */
    public function getLieucp()
    {
        return $this->lieucp;
    }

    /**
     * @param mixed $lieucp
     */
    public function setLieucp($lieucp)
    {
        $this->lieucp = $lieucp;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


}