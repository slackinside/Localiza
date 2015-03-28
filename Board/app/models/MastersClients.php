<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MastersClients extends Phalcon\Mvc\Model
{
    public $Master_id;
    public $Cliente_id;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("MastersClients");
        $this->belongsTo("Master_id", "Masters", "Master_id");
        $this->belongsTo("Cliente_id", "Clients", "Cliente_id");
    }
    
}