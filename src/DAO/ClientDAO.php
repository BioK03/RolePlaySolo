<?php

namespace RolePlaySolo\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use RolePlaySolo\Domain\Client;

use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class ClientDAO extends DAO implements UserProviderInterface
{
    /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The user id.
     *
     * @return \RolePlaySolo\Domain\Client|throws an exception if no matching user is found
     */
    public function find($id) {
        $sql = "select * from t_client where cli_idClient=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No user matching id " . $id);
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $sql = "select * from t_client where cli_name=?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $client)
    {
        $class = get_class($client);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($client->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'RolePlaySolo\Domain\Client' === $class;
    }
	
	/*
	 * {@inheritDoc}
	 */
	public function mailExisteId($mail, $id)
	{
		if($id == -1)
		{
			$sql = "select * from t_client where cli_name=?";
			$row = $this->getDb()->fetchAssoc($sql, array($mail));

			if ($row)
				return true;
			else
				return false;
		}
		else
		{
			$sql = "select * from t_client where cli_name=? AND cli_idClient<>?";
			$row = $this->getDb()->fetchAssoc($sql, array($mail, $id));

			if ($row)
				return true;
			else
				return false;
		}
	}

    /**
     * Creates a Customer object based on a DB row.
     *
     * @param array $row The DB row containing Customer data.
     * @return \RolePlaySolo\Domain\Client
     */
    protected function buildDomainObject($row) {
        $client = new Client();
        $client->setId($row['cli_idClient']);
		$client->setPseudo($row['cli_pseudo']);
        $client->setUsername($row['cli_name']);
		$client->setAddress($row['cli_address']);
		$client->setCp($row['cli_cp']);
		$client->setCity($row['cli_city']);
        $client->setPassword($row['cli_password']);
        $client->setSalt($row['cli_salt']);
        $client->setRole($row['cli_role']);
        return $client;
    }
	
	/**
     * Changes the password of a Customer into the database.
     *
     * @param \RolePlaySolo\Domain\Client $client The customer to modify
	 * @param string password
     */
	public function modifyPass(Client $client) {
		$defaultEncoder = new MessageDigestPasswordEncoder('sha512', true, 5000);
		$weakEncoder = new MessageDigestPasswordEncoder('md5', true, 1);
		$encoders = array(
			'Symfony\\Component\\Security\\Core\\User\\User' => $defaultEncoder,
			'Acme\\Entity\\LegacyUser' => $weakEncoder,
		);
		$encoderFactory = new EncoderFactory($encoders);
		$encodedPassword = $defaultEncoder->encodePassword($client->getPassword(), $client->getSalt());
		
		$clientData = array(
            'cli_idClient' => $client->getId(),
            'cli_pseudo' => $client->getPseudo(),
            'cli_name' => $client->getUsername(),
			'cli_address' => $client->getAddress(),
			'cli_cp' => $client->getCp(),
			'cli_city' => $client->getCity(),
			'cli_password' => $encodedPassword,
			'cli_salt' => $client->getSalt(),
			'cli_role' => $client->getRole()
            );
			
		if ($client->getId()) {
            $this->getDb()->update('t_client', $clientData, array('cli_idClient' => $client->getId()));
		}
	}	
	
	
	/**
     * Saves a Customer into the database.
     *
     * @param \RolePlaySolo\Domain\Client $client The customer to save 
     */
    public function save(Client $client) {		
        $clientData = array(
            'cli_idClient' => $client->getId(),
            'cli_pseudo' => $client->getPseudo(),
            'cli_name' => $client->getUsername(),
			'cli_address' => $client->getAddress(),
			'cli_cp' => $client->getCp(),
			'cli_city' => $client->getCity(),
			'cli_password' => $client->getPassword(),
			'cli_salt' => $client->getSalt(),
			'cli_role' => $client->getRole()
            );

        if ($client->getId()) {
            // The comment has already been saved : update it
            $this->getDb()->update('t_client', $clientData, array('cli_idClient' => $client->getId()));
        } else {
            // The comment has never been saved : insert it
            $this->getDb()->insert('t_client', $clientData);
            // Get the id of the newly created comment and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $client->setId($id);
        }
    }
	
	/**
     * Saves a Customer into the database.
     *
     * @param \RolePlaySolo\Domain\Client $client The customer to save 
     */
    public function register(Client $client) {
		$client->setSalt(uniqid('', true));
		$client->setRole("ROLE_USER");
		$defaultEncoder = new MessageDigestPasswordEncoder('sha512', true, 5000);
		$weakEncoder = new MessageDigestPasswordEncoder('md5', true, 1);
		$encoders = array(
			'Symfony\\Component\\Security\\Core\\User\\User' => $defaultEncoder,
			'Acme\\Entity\\LegacyUser' => $weakEncoder,
		);
		$encoderFactory = new EncoderFactory($encoders);
		$encodedPassword = $defaultEncoder->encodePassword($client->getPassword(), $client->getSalt());
		
        $clientData = array(
            'cli_idClient' => $client->getId(),
            'cli_pseudo' => $client->getPseudo(),
            'cli_name' => $client->getUsername(),
			'cli_address' => $client->getAddress(),
			'cli_cp' => $client->getCp(),
			'cli_city' => $client->getCity(),
			'cli_password' => $encodedPassword,
			'cli_salt' => $client->getSalt(),
			'cli_role' => $client->getRole()
        );
		
		// The comment has never been saved : insert it
		$this->getDb()->insert('t_client', $clientData);
		// Get the id of the newly created comment and set it on the entity.
		$id = $this->getDb()->lastInsertId();
		$client->setId($id);
        
    }
}