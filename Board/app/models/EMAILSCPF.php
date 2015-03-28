<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EMAILSCPF extends \Phalcon\Mvc\Model
{
    public $CPF;
    
     public function initialize()
    {
        $this->setConnectionService('fisico');
        $this->setSource("EMAILS");
    }
}