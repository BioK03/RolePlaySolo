<?php

namespace RolePlaySolo\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class Client implements UserInterface
{
    /**
     * Customer id.
     *
     * @var integer
     */
    private $id;
	
	/**
     * Customer name.
     *
     * @var string
     */
    private $pseudo;
	
    /**
     * Customer mail.
     *
     * @var string
     */
    private $username;
	
	/**
     * Customer address.
     *
     * @var string
     */
    private $address;
	
	/**
     * Customer cp.
     *
     * @var string
     */
    private $cp;
	
	/**
     * Customer city.
     *
     * @var string
     */
    private $city;
	
    /**
     * Customer password.
     *
     * @var string
     */
    private $password;

    /**
     * Salt that was originally used to encode the password.
     *
     * @var string
     */
    private $salt;

    /**
     * Role.
     * Values : ROLE_USER or ROLE_ADMIN.
     *
     * @var string
     */
    private $role;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
	
	public function getPseudo() {
        return $this->pseudo;
    }

    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }
	
    /**
     * @inheritDoc
     */
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }
	
	/**
     * @inheritDoc
     */
    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }
	
	/**
     * @inheritDoc
     */
    public function getCp() {
        return $this->cp;
    }

    public function setCp($cp) {
        $this->cp = $cp;
    }
	
	/**
     * @inheritDoc
     */
    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }
	
    /**
     * @inheritDoc
     */
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array($this->getRole());
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        // Nothing to do here
    }
}