<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UsersUsers extends Phalcon\Mvc\Model
{
    public $Usuario_admin;
    public $Usuario_supervisor;
    public $Usuario_usuario;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("UsersUsers");
        $this->belongsTo("Usuario_admin", "Users", "Usuario_id");
        $this->belongsTo("Usuario_supervisor", "Users", "Usuario_id");
        $this->belongsTo("Usuario_usuario", "Users", "Usuario_id");
    }
}
