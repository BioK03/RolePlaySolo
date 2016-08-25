<?php

namespace RolePlaySolo\DAO;

use RolePlaySolo\Domain\Produit;

class ProduitDAO extends DAO
{
    /**
     * Return a list of all products, sorted by date (most recent first).
     *
     * @return array A list of all products.
     */
    public function findAll() {
        $sql = "select * from t_produit order by prod_idProduit desc";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $produits = array();
        foreach ($result as $row) {
            $produitId = $row['prod_idProduit'];
            $produits[$produitId] = $this->buildDomainObject($row);
        }
        return $produits;
    }

    /**
     * Creates a product object based on a DB row.
     *
     * @param array $row The DB row containing Product data.
     * @return \RolePlaySolo\Domain\Produit
     */
    protected function buildDomainObject($row) {
        $produit = new Produit();
        $produit->setId($row['prod_idProduit']);
        $produit->setNom($row['prod_nom']);
        $produit->setEditeur($row['prod_editeur']);
		$produit->setAuteur($row['prod_auteur']);
		$produit->setNumero($row['prod_numero']);
		$produit->setIsbn($row['prod_isbn']);
		$produit->setPrix($row['prod_prix']);
		$produit->setDescription($row['prod_description']);
		$produit->setImage($row['prod_image']);
		$produit->setQuantite($row['prod_quantite']);
		$produit->setNumSerie($row['prod_numSerie']);
        return $produit;
    }
	
	/**
     * Returns a list of Products contained in a Serie
     *
     * @param array $row The DB row containing Products.
     * @return \RolePlaySolo\Domain\Produit
     */
	public function findAllBySerie($id) {
        $sql = "select * from t_produit where prod_numserie=? order by prod_idProduit desc";
        $result = $this->getDb()->fetchAll($sql, array($id));
        
        // Convert query result to an array of domain objects
        $produits = array();
        foreach ($result as $row) {
            $produitId = $row['prod_idProduit'];
            $produits[$produitId] = $this->buildDomainObject($row);
        }
        return $produits;
    }
	
	/**
     * Returns a product matching the supplied id.
     *
     * @param integer $id
     *
     * @return \RolePlaySolo\Domain\Produit|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from t_produit where prod_idProduit=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No product matching id " . $id);
    }
}