<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ENDERECOSCNPJ extends \Phalcon\Mvc\Model
{
     public function initialize()
    {
        $this->setConnectionService('cnpj');
        $this->setSource("ENDERECOS");
    }
}