<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class MastersProducts extends Phalcon\Mvc\Model
{
    public $Master_id;
    public $Produto_id;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("MastersProducts");
        $this->belongsTo("Master_id", "Masters", "Master_id");
        $this->belongsTo("Produto_id", "Products", "Produto_id");
    }
    
}
