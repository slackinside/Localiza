<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EMPRESAS_BR extends \Phalcon\Mvc\Model
{
    public $CNPJ;
    
     public function initialize()
    {
        $this->setConnectionService('juridico');
        $this->setSource("EMPRESAS_BR");
    }
}