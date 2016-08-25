<?php

namespace RolePlaySolo\Domain;

class Panier 
{
    /**
     * Panier id.
     *
     * @var integer
     */
    private $id;

    /**
     * Panier customer.
     *
     * @var string
     */
    private $client;

    /**
     * Panier quantity.
     *
     * @var integer
     */
    private $quantite;

    /**
     * Associated product.
     *
     * @var \RolePlaySolo\Domain\Produit
     */
    private $produit;
	
	/**
	 * Total of this panier.
	 *
	 *@var  integer
	 */
	 private $total;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getClient() {
        return $this->client;
    }

    public function setClient(Client $client) {
        $this->client = $client;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    public function getProduit() {
        return $this->produit;
    }

    public function setProduit(Produit $produit) {
        $this->produit = $produit;
    }
	
	public function getTotal()
	{
		return $this->total;
	}
	
	public function getTotalPanier()
	{
		$this->total = ($this->produit->getPrix()*$this->quantite);
	}
}