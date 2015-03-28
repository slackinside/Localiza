<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class MastersPackages extends Phalcon\Mvc\Model
{
    public $Master_id;
    public $Pacote_id;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("MastersPackages");
        $this->belongsTo("Master_id", "Masters", "Master_id");
        $this->belongsTo("Pacote_id", "Packages", "Pacote_id");
    }
    
}
