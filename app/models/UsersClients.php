<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UsersClients extends Phalcon\Mvc\Model
{
    public $Cliente_id;
    public $Usuario_id;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("UsersClients");
        $this->hasMany("Usuario_id", "Users", "Usuario_id");
        $this->hasMany("Cliente_id", "Clients", "Cliente_id");
        $this->hasMany("Usuario_id", "UsersLogin", "UserLogin_Usuario_id");
    }
}

