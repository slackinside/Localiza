<?php

class ContactController extends ControllerBase {

    private $emailClient = null;
public function initialize() {
        $this->view->setTemplateAfter('contact');
        $this->tag->setTitle('Contato');
        $auth = $this->session->get('auth');
        $this->view->setVar('name', $auth['name']);
        parent::initialize();
    }

    public function indexAction() {
        
    }
    
    public function speakAction(){
        global $auth;
        if(!empty($auth['id'])){
            $idClient = UsersClients::findFirstByUsuario_id($auth['id'])->Cliente_id;
            $this->emailClient = Clients::findFirstByCliente_id($idClient)->Cliente_email;
        }
    }
    
    public function sendEmailAction(){
        
    }
    
}