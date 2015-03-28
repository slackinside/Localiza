<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Products extends \Phalcon\Mvc\Model
{
    public $Produto_id;
    public $Produto_nome;
    
     public function initialize()
    {
         $this->setConnectionService('localiza');
        $this->setSource("Products");
        $this->hasMany("Produto_id", "MastersProducts", "Produto_id");
        $this->hasMany("Produto_id", "ClientsProducts", "Produto_id");
        $this->belongsTo("Produto_id", "Packages", "Produto_id");
    }
}