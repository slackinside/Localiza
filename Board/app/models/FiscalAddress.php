<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FiscalAddress extends Phalcon\Mvc\Model
{
    public $Endereco_fiscal_id;
    
    public function initialize()
    {
        $this->setConnectionService('localiza');
        $this->setSource("FiscalAddress");
    }
}