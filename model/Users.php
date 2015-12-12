<?php

class Users
{
    protected $tableNameBdd;
    protected $Id;
    protected $Name;
    protected $Password;

    public function set_tableNameBdd($tableNameBdd)
    {
      return $this->tableNameBdd = $tableNameBdd;
    }

    public function get_tableNameBdd()
    {
      return $this->tableNameBdd;
    }

    public function getId()
    {
      return $this->Id;
    }

    public function setId($Id)
    {
      $this->Id = $Id;
    }

    public function getName()
    {
      return $this->Name;
    }

    public function setName($Name)
    {
      $this->Name = $Name;
    }

    public function getPassword()
    {
      return $this->Password;
    }

    public function setPassword($Password)
    {
      $this->Password = $Password;
    }

}
