<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class IndexController extends ControllerBase {

    public function initialize() {
        $this->view->setTemplateAfter('base');
        $this->tag->setTitle('Dashboard');
        $auth = $this->session->get('authl');
        $this->view->setVar('name', $auth['name']);
        parent::initialize();
    }

    public function indexAction() {
    }
}
