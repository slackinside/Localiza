<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CorrespondAddress extends Phalcon\Mvc\Model
{
    public $Endereco_correspondencia_id;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("CorrespondAddress");
    }
}