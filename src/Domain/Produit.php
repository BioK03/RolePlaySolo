<?php

namespace RolePlaySolo\Domain;

class Produit 
{
    /**
     * Product id.
     *
     * @var integer
     */
    private $id;

    /**
     * Product name.
     *
     * @var string
     */
    private $nom;

    /**
     * Product editor.
     *
     * @var string
     */
    private $editeur;
	
	/**
     * Product author.
     *
     * @var string
     */
    private $auteur;
	
	/**
     * Product num.
     *
     * @var integer
     */
    private $numero;
	
	/**
     * Product isbn.
     *
     * @var string
     */
    private $isbn;
	
	/**
     * Product price.
     *
     * @var float
     */
    private $prix;
	
	/**
     * Product desc.
     *
     * @var string
     */
    private $description;
	
	/**
     * Product picture.
     *
     * @var string
     */
    private $image;
	
	/**
     * Product quantity.
     *
     * @var string
     */
    private $quantite;
	
	/**
     * Product num serie.
     *
     * @var integer
     */
    private $numSerie;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getEditeur() {
        return $this->editeur;
    }

    public function setEditeur($editeur) {
        $this->editeur = $editeur;
    }
	
	public function getAuteur() {
        return $this->auteur;
    }

    public function setAuteur($auteur) {
        $this->auteur = $auteur;
    }
	
	public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }
	
	public function getIsbn() {
        return $this->isbn;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }
	
	public function getPrix() {
        return $this->prix;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }
	
	public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
	
	public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }
	
	public function getQuantite() {
        return $this->quantite;
    }

    public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }
	
	public function getNumSerie() {
        return $this->numSerie;
    }

    public function setNumSerie($numSerie) {
        $this->numSerie = $numSerie;
    }
}