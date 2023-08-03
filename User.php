<?php
class User
{
    private $id;
    private $name;
    private $email;
    private $senha;

    public function __construct($id, $name, $email,$senha)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->senha=$senha;
    }

    // Getters e Setters

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getSenha(){
        return $this->senha;
    }
    public function setSenha($senha){
        $this->senha=$senha;
    }
}