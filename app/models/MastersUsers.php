<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MastersUsers extends Phalcon\Mvc\Model
{
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("MastersUsers");
        $this->hasMany("Usuario_id", "Users", "Usuario_id");
        $this->hasMany("Master_id", "Masters", "Master_id");
        $this->hasMany("Usuario_id", "UsersLogin", "UserLogin_Usuario_id");
    }
}