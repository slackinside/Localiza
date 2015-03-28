<?php

use Phalcon\Tag as Tag;
include __DIR__ . '/../../app/config/db_medoo.php';
class SessionController extends ControllerBase {

    public function initialize() {
        
        $this->view->setTemplateAfter('base');
        Tag::setTitle('Cadastro/Login');
        $auth = $this->session->get('auth');
        $this->view->setVar('name', $auth['name']);
        parent::initialize();
    }

    public function indexAction() {
        
    }

    public function newAction() {
        $this->view->setTemplateAfter('base');
        Tag::setTitle('Cadastro');
    }

    public function registerAction() {
        global $boardLVM;
        $request = $this->request;
        if ($request->isPost()) {

            $name = $request->getPost("Usuario_nome");
            $email = $request->getPost("Usuario_email");
            $telefone = $request->getPost("Usuario_telefone");
            $morada = $request->getPost("Usuario_morada");
            $username = $request->getPost("Usuario_login");
            $password = $request->getPost("Usuario_password");
            $repeatPassword = $request->getPost("Usuario_password_conf");
        }

        $usernameFound = $boardLVM->get("UsersLogin", [
            "username"
                ], [
            "username" => $username
        ]);
        if (!empty($usernameFound)) {
            $this->flash->error('Usuário já cadastrado! Tente um diferente');
            return false;
        }
        if (strcmp($password, $repeatPassword) != 0) {
            $this->flash->error('Passwords diferentes');
            return false;
        }
        $password = sha1($password);
        $last_user_id = $boardLVM->insert("UsersLogin", [
            "username" => $username,
            "password" => $password,
            "user_type" => -1,
            "user_active" => 1
        ]);

        $inserted_user_id = $boardLVM->insert("Users", [
            "user_id" => $last_user_id,
            "user_name" => $name,
            "user_email" => $email,
            "user_address" => $morada,
            "user_phone" => $telefone,
            "user_created_at" => date('Y-m-d')
        ]);

        if (!empty($inserted_user_id)) {
            $this->flash->error("Ocorreu um erro ao tentar cadastrar! Contacte o Suporte do Sistema.");
        } else {
            Tag::setDefault('Usuario_email', '');
            Tag::setDefault('Usuario_password', '');
            $this->flash->success('Obrigado pelo seu cadastro, faça login para começar a gerir');
            return $this->forward('session/index');
        }
    }

    private function _registerSession($user, $name) {
        $this->session->set('auth', array(
            'id' => $user['userLogin_id'],
            'name' => $name,
            'type' => $user['user_type']
        ));
    }

    public function startAction() {
        if ($this->request->isPost()) {
            global $boardLVM;
            //Receiving the variables sent by POST
            $username = $this->request->getPost('Usuario_login');
            $password = $this->request->getPost('Usuario_password');
            //crypt to compare with db
            $password = sha1($password);

            //Find the user in the database
            $userLogInfo = $boardLVM->query("Select userLogin_id, user_type From UsersLogin Where username = '$username' And password = '$password' And user_active = 1")->fetch();
            if (!empty($userLogInfo)) {

                $user_name = $boardLVM->query("Select user_name From Users Where user_id = ".$userLogInfo['userLogin_id'])->fetch();


                $this->_registerSession($userLogInfo, $user_name['user_name']);

                $this->flash->success('Bem Vindo ' . $user_name['user_name']);

                //Forward to the 'invoices' controller if the user is valid
                return $this->dispatcher->forward(array(
                            'controller' => 'index',
                            'action' => 'index'
                ));
            }
            
            $this->flash->error('Login ou Password errados.');
            return $this->dispatcher->forward(array(
                    'controller' => 'session',
                    'action' => 'index'
        ));
        }

        //Forward to the login form again
        return $this->dispatcher->forward(array(
                    'controller' => 'session',
                    'action' => 'index'
        ));
    }

    public function endAction() {
        $this->session->remove('auth');
        $this->flash->success('Logout bem sucedido!');
        return $this->dispatcher->forward(array(
                    'controller' => 'index',
                    'action' => 'index'
        ));
    }

}
