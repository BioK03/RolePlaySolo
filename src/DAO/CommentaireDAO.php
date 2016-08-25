<?php

namespace RolePlaySolo\DAO;

use RolePlaySolo\Domain\Commentaire;

class CommentaireDAO extends DAO 
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
     * Return a list of all comments for a product, sorted by date (most recent last).
     *
     * @param integer $articleId The article id.
     *
     * @return array A list of all comments for the article.
     */
    public function findAllByProduit($produitId) {
        // The associated product is retrieved only once
        $produit = $this->produitDAO->find($produitId);

        // idProduit is not selected by the SQL query
        // The product won't be retrieved during domain objet construction
        $sql = "select com_idCommentaire, com_content, com_idClient from t_commentaire where com_idProduit=? order by com_idCommentaire";
        $result = $this->getDb()->fetchAll($sql, array($produitId));

        // Convert query result to an array of domain objects
        $commentaires = array();
        foreach ($result as $row) {
            $comId = $row['com_idCommentaire'];
            $commentaire = $this->buildDomainObject($row);
            // The associated product is defined for the constructed comment
            $commentaire->setProduit($produit);
            $commentaires[$comId] = $commentaire;
        }
        return $commentaires;
    }

    /**
     * Creates a Comment object based on a DB row.
     *
     * @param array $row The DB row containing Comment data.
     * @return \RolePlaySolo\Domain\Comment
     */
    protected function buildDomainObject($row) {
        $commentaire = new Commentaire();
        $commentaire->setId($row['com_idCommentaire']);
        $commentaire->setContent($row['com_content']);

        if (array_key_exists('com_idProduit', $row)) {
            // Find and set the associated article
            $produitId = $row['com_idProduit'];
            $produit = $this->produitDAO->find($produitId);
            $commentaire->setProduit($produit);
        }
        if (array_key_exists('com_idClient', $row)) {
            // Find and set the associated author
            $clientId = $row['com_idClient'];
            $client = $this->clientDAO->find($clientId);
            $commentaire->setAuteur($client);
        }
        
        return $commentaire;
    }
	
	
	/**
     * Saves a comment into the database.
     *
     * @param \RolePlaySolo\Domain\Comment $commentaire The comment to save
     */
    public function save(Commentaire $commentaire) {
        $commentaireData = array(
            'com_idProduit' => $commentaire->getProduit()->getId(),
            'com_idClient' => $commentaire->getAuteur()->getId(),
            'com_content' => $commentaire->getContent()
            );
		
        if ($commentaire->getId()) {
            // The comment has already been saved : update it
            $this->getDb()->update('t_commentaire', $commentaireData, array('com_idCommentaire' => $commentaire->getId()));
        } else {
            // The comment has never been saved : insert it
            $this->getDb()->insert('t_commentaire', $commentaireData);
            // Get the id of the newly created comment and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $commentaire->setId($id);
        }
    }
}