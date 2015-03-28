<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LimitUsers extends Phalcon\Mvc\Model
{
    public $Usuario_id;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("LimitUsers");
        $this->hasMany("Usuario_id", "UsersLogin", "UserLogin_Usuario_id");
    }
}