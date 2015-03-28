<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ClientsProducts extends Phalcon\Mvc\Model
{
    public $Produto_id;
    public $Cliente_id;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("ClientsProducts");
        $this->belongsTo("Cliente_id", "Clients", "Cliente_id");
        $this->belongsTo("Produto_id", "Products", "Produto_id");
    }
    
}