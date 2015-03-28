<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UsersProducts extends Phalcon\Mvc\Model
{
    public $Usuario_id;
    public $Produto_id;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("UsersProducts");
        $this->belongsTo("Usuario_id", "Users", "Usuario_id");
        $this->belongsTo("Produto_id", "Products", "Produto_id");
    }
    
}