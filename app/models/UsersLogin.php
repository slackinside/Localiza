<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UsersLogin extends Phalcon\Mvc\Model
{
    public $UserLogin_Usuario_id;
    public $UserLogin_username;
    public $UserLogin_tipo;
    public $UserLogin_active;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("UsersLogin");
        $this->hasMany("UserLogin_Usuario_id", "Users", "Usuario_id");
       // $this->belongsTo("UserLogin_Usuario_id", "Clients", "Cliente_id");
        $this->hasMany("UserLogin_Usuario_id", "Masters", "Master_id");
       // $this->hasMany("UserLogin_Usuario_id", "MastersClients", "Cliente_id");
    }
}