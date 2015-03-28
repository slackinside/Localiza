<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ShoppingMovements extends Phalcon\Mvc\Model
{
    public $Usuario_id;
    public $Pacote_id;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("ShoppingMovements");
        $this->belongsTo("Usuario_id", "Masters", "Master_id");
        $this->belongsTo("Usuario_id", "Clients", "Cliente_id");
        $this->belongsTo("Usuario_id", "Users", "Usuario_id");
        $this->belongsTo("Pacote_id", "Packages", "Pacote_id");
    }
    
}