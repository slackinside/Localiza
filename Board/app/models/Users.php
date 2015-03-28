<?php


use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

class Users extends Phalcon\Mvc\Model
{
    public $Usuario_id;
    public $Usuario_nome;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("Users");
        $this->hasMany("Usuario_id", "UsersClients", "Usuario_id");
        $this->hasMany("Usuario_id", "MastersUsers", "Usuario_id");
        $this->hasMany("Usuario_id", "UsersUsers", "Usuario_admin");
        $this->hasMany("Usuario_id", "UsersUsers", "Usuario_supervisor");
        $this->hasMany("Usuario_id", "UsersUsers", "Usuario_usuario");
        $this->hasMany("Usuario_id", "UsersPackages", "Usuario_id");
        $this->hasMany("Usuario_id", "ShoppingMovements", "Usuario_id");
    }
    
    public function validation()
    {
        $this->validate(new EmailValidator(array(
            'field' => 'Usuario_email'
        )));
        $this->validate(new UniquenessValidator(array(
            'field' => 'Usuario_email',
            'message' => 'Desculpa, mas esse endereço de email já foi cadastrado.'
        )));
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
