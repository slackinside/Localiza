<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Packages extends Phalcon\Mvc\Model
{
    public $Pacote_id;
    public $Produto_id;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("Packages");
        $this->hasMany("Produto_id", "Products", "Produto_id");
        $this->hasMany("Pacote_id", "UserPackages", "Pacote_id");
        $this->hasMany("Pacote_id", "ShoppingMovements", "Pacote_id");
    }
    
}
