<?php

namespace RolePlaySolo\Domain;

class Serie 
{
    /**
     * Serie id.
     *
     * @var integer
     */
    private $id;

    /**
     * Serie name.
     *
     * @var string
     */
    private $intitule;

    /**
     * Serie picture.
     *
     * @var string
     */
    private $image;
	
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIntitule() {
        return $this->intitule;
    }

    public function setIntitule($intitule) {
        $this->intitule = $intitule;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }
}