<?php

namespace RolePlaySolo\DAO;

use RolePlaySolo\Domain\Panier;

class PanierDAO extends DAO 
{
    /**
     * @var \RolePlaySolo\DAO\ProduitDAO
     */
    private $produitDAO;

    /**
     * @var \RolePlaySolo\DAO\ClientDAO
     */
    private $clientDAO;

    public function setProduitDAO(ProduitDAO $produitDAO) {
        $this->produitDAO = $produitDAO;
    }

    public function setClientDAO($clientDAO) {
        $this->clientDAO = $clientDAO;
    }

    /**
     * Return a list of all products for a customer, sorted by date (most recent last).
     *
     * @param integer $clientId The customer id.
     *
     * @return array A list of all products for the customer.
     */
    public function findAllByClient($clientId) {
        // The associated customer is retrieved only once
        $client = $this->clientDAO->find($clientId);

        // idProduit is not selected by the SQL query
        // The product won't be retrieved during domain objet construction
        $sql = "select pan_idPanier, pan_idProduit, pan_idClient, pan_quantite from t_panier where pan_idClient=? order by pan_idPanier";
        $result = $this->getDb()->fetchAll($sql, array($clientId));

        // Convert query result to an array of domain objects
        $paniers = array();
        foreach ($result as $row) {
            $panId = $row['pan_idPanier'];
            $panier = $this->buildDomainObject($row);
            // The associated product is defined for the constructed panier
            $panier->setClient($client);
            $paniers[$panId] = $panier;
        }
        return $paniers;
    }
	
	/**
     * Return a id of panier that has the same product and client).
     *
     * @param integer $panierData The panier.
     *
     * @return Existing panier (or default null).
     */
    public function findByData($panierData) {
        $sql = "select pan_idPanier, pan_idProduit, pan_idClient, pan_quantite from t_panier where pan_idClient=? and pan_idProduit=?";
        $result = $this->getDb()->fetchAll($sql, array($panierData['pan_idClient'], $panierData['pan_idProduit']));
		
        // Convert query result to an array of domain objects
        foreach ($result as $row) {
			return $this->buildDomainObject($row);
        }

    }
	
    /**
     * Creates a Panier object based on a DB row.
     *
     * @param array $row The DB row containing Panier data.
	 *
     * @return \RolePlaySolo\Domain\Panier
     */
    protected function buildDomainObject($row) {
        $panier = new Panier();
        $panier->setId($row['pan_idPanier']);
        $panier->setQuantite($row['pan_quantite']);

        if (array_key_exists('pan_idProduit', $row)) {
            // Find and set the associated article
            $produitId = $row['pan_idProduit'];
            $produit = $this->produitDAO->find($produitId);
            $panier->setProduit($produit);
			$panier->getTotalPanier();
        }
        if (array_key_exists('pan_idClient', $row)) {
            // Find and set the associated author
            $clientId = $row['pan_idClient'];
            $client = $this->clientDAO->find($clientId);
            $panier->setClient($client);
        }
        return $panier;
    }
	
	/*
	 * Delete all paniers for a client
	 *
	 * @param integer clientId
	 */
	public function deleteAllByClient($clientId) {
		$clientData = array(
			'pan_idClient' => $clientId
		);
		$this->getDb()->delete('t_panier', $clientData);
	}
	
	/**
     * Saves a panier into the database.
     *
     * @param \RolePlaySolo\Domain\Panier $panier The panier to save
     */
    public function save(Panier $panier) {
        $panierData = array(
            'pan_idProduit' => $panier->getProduit()->getId(),
            'pan_idClient' => $panier->getClient()->getId(),
            'pan_quantite' => $panier->getQuantite()
        );
		
		$panierBD = $this->findByData($panierData);
		if($panierBD)
		{
			$panier->setId($panierBD->getId());
			$panierData['pan_quantite'] = $panierBD->getQuantite()+1;
		}
		
        if ($panier->getId()) {
            // The panier has already been saved : update it
            $this->getDb()->update('t_panier', $panierData, array('pan_idPanier' => $panier->getId()));
        } else {
            // The panier has never been saved : insert it
            $this->getDb()->insert('t_panier', $panierData);
            // Get the id of the newly created comment and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $panier->setId($id);
        }
    }
}