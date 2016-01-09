<?php

/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 09/01/16
 * Time: 16:48
 */
class groupe
{
    private $id;
    private $nom;
    private $description;
    private $imageHeader;

    /**
     * groupe constructor.
     * @param $id
     * @param $nom
     * @param $description
     */
    public function __construct($id, $nom, $description, $image)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->imageHeader = $image;
    }

    /**
     * @return mixed
     */
    public function getImageHeader()
    {
        return $this->imageHeader;
    }

    /**
     * @param mixed $imageHeader
     */
    public function setImageHeader($imageHeader)
    {
        $this->imageHeader = $imageHeader;
    }


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