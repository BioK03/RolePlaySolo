<?php

namespace RolePlaySolo\Domain;

class Commentaire 
{
    /**
     * Comment id.
     *
     * @var integer
     */
    private $id;

    /**
     * Comment author.
     *
     * @var string
     */
    private $auteur;

    /**
     * Comment content.
     *
     * @var integer
     */
    private $content;

    /**
     * Associated product.
     *
     * @var \RolePlaySolo\Domain\Article
     */
    private $produit;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getAuteur() {
        return $this->auteur;
    }

    public function setAuteur(Client $auteur) {
        $this->auteur = $auteur;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getProduit() {
        return $this->produit;
    }

    public function setProduit(Produit $produit) {
        $this->produit = $produit;
    }
}