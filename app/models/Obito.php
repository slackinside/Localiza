<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Obito extends \Phalcon\Mvc\Model
{
     public function initialize()
    {
        $this->setConnectionService('obito');
        $this->setSource("obitos");
    }
}