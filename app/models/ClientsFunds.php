<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ClientsFunds extends Phalcon\Mvc\Model
{
    public $Cliente_id;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("ClientsFunds");
        $this->belongsTo("Cliente_id", "Clients", "Cliente_id");
    }
    
}