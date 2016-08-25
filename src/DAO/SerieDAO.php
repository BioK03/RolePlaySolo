<?php

namespace RolePlaySolo\DAO;

use RolePlaySolo\Domain\Serie;

class SerieDAO extends DAO
{
    /**
     * Return a list of all articles, sorted by date (most recent first).
     *
     * @return array A list of all series.
     */
    public function findAll() {
        $sql = "select * from t_serie order by ser_idSerie desc";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $series = array();
        foreach ($result as $row) {
            $serieId = $row['ser_idSerie'];
            $series[$serieId] = $this->buildDomainObject($row);
        }
        return $series;
    }
	
	/**
     * Return a serie called 'Tous les produits'
     *
     * @returna serie.
     */
	public function genAllProduits() {
		$serie = new Serie();
		$serie->setId(-1);
        $serie->setIntitule("Tous les produits");
        $serie->setImage("");
        return $serie;
	}
	
    /**
     * Creates a Serie object based on a DB row.
     *
     * @param array $row The DB row containing Serie data.
     * @return \RolePlaySolo\Domain\Serie
     */
    protected function buildDomainObject($row) {
        $serie = new Serie();
        $serie->setId($row['ser_idSerie']);
        $serie->setIntitule($row['ser_intitule']);
        $serie->setImage($row['ser_image']);
        return $serie;
    }
	
	/**
     * Returns a serie matching the supplied id.
     *
     * @param integer $id
     *
     * @return \RolePlaySolo\Domain\Serie|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from t_serie where ser_idSerie=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No serie matching id " . $id);
    }
}