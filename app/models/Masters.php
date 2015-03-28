<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Masters extends Phalcon\Mvc\Model
{
    public $Master_id;
    public $Master_nome;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("Masters");
        $this->hasMany("Master_id", "MastersClients", "Master_id");
        $this->hasMany("Master_id", "MastersUsers", "Master_id");
        $this->hasMany("Master_id", "MastersProducts", "Master_id");
        $this->hasMany("Master_id", "ShoppingMovements", "Usuario_id");
    }
    
     public function getMastersClients($parameters=null)
    {
        return $this->getRelated('MastersClients', $parameters);
    }
}