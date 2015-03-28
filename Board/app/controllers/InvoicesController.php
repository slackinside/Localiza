<?php

use Phalcon\Tag;
use Phalcon\Flash;
use Phalcon\Session;

class InvoicesController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('base');
        $this->tag->setTitle('Manage your Invoices');
        parent::initialize();
    }

    public function indexAction()
    {
    }

    /**
     * Edit the active user profile
     *
     */
    public function profileAction()
    {
        //Get session info
        $auth = $this->session->get('auth');

        //Query the active user
        $user = Users::findFirst($auth['id']);
        if ($user == false) {
            return $this->_forward('index/index');
        }

        if (!$this->request->isPost()) {
            $this->tag->setDefault('name', $user->Usuario_nome);
            $this->tag->setDefault('email', $user->Usuario_email);
        } else {

            $name = $this->request->getPost('Usuario_nome', array('string', 'striptags'));
            $email = $this->request->getPost('Usuario_email');

            $user->Usuario_nome = $name;
            $user->Usuario_email = $email;
            if ($user->save() == false) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                $this->flash->success('Your profile information was updated successfully');
            }
        }
    }
}
