<?php

use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

class Clients extends Phalcon\Mvc\Model
{
    public $Cliente_id;
    public $Cliente_cnpj;
    public $Cliente_nome;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("Clients");
        $this->hasMany("Cliente_id", "UsersClients", "Cliente_id", array(
            "foreignKey" => array(
                "message" => "The Client cannot be deleted because other Entitys are using it"
            )
        ));
        $this->hasMany("Cliente_id", "MastersClients", "Cliente_id", array(
            "foreignKey" => array(
                "message" => "The Client cannot be deleted because other Entitys are using it"
            )
        ));
        $this->hasMany("Cliente_id", "ClientsProducts", "Cliente_id");
        $this->hasMany("Cliente_id", "UsersPackages", "Usuario_id");
        $this->hasMany("Cliente_id", "ShoppingMovements", "Usuario_id");
        $this->hasOne("Cliente_id", "ClientsFunds", "Cliente_id");
       // $this->hasMany("Cliente_id", "UsersLogin", "UserLogin_Usuario_id");
    }
    
    public function validation()
    {
        $this->validate(new EmailValidator(array(
            'field' => 'Cliente_email'
        )));
        $this->validate(new UniquenessValidator(array(
            'field' => 'Cliente_email',
            'message' => 'Desculpa, mas esse endereço de email já foi cadastrado.'
        )));
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
    
     public function getMastersClients($parameters=null)
    {
        return $this->getRelated('MastersClients', $parameters);
    }
}