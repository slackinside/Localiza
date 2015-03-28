<?php

use Phalcon\Tag as Tag;
include __DIR__ . '/../../app/config/db_medoo.php';
class SessionController extends ControllerBase {

    public function initialize() {
        $auth = $this->session->get('authl');
        $this->view->setVar('name', $auth['name']);
        parent::initialize();
    }

    public function indexAction() {
        
    }

    private function _registerSession($user, $name) {
        $this->session->set('authl', array(
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
            $product = $boardLVM->query("Select product_id From Products Where product_name = 'Localiza'")->fetch();
            $userProductAccess = $boardLVM->query("Select query_price state From UsersProducts Where user_id = ".$userLogInfo['userLogin_id']." And product_id = ".$product['product_id'])->fetch();
            if($userProductAccess['state']!=30){
                $this->flash->error('Sem Acesso! Aguarde liberação do produto ou proceda ao pagamento caso ainda não o tenha feito..');
            return $this->response->redirect('');
            }
            if (!empty($userLogInfo)) {

                $user_name = $boardLVM->query("Select user_name From Users Where user_id = ".$userLogInfo['userLogin_id'])->fetch();


                $this->_registerSession($userLogInfo, $user_name['user_name']);

                $this->flash->success('Bem Vindo ' . $user_name['user_name']);

                //Forward to the 'invoices' controller if the user is valid
                return $this->dispatcher->forward(array(
                            'controller' => 'user',
                            'action' => 'index'
                ));
            }
            
            $this->flash->error('Login ou Password errados.');
            return $this->response->redirect('');
        }

        //Forward to the login form again
        return $this->forward('/');
    }

    public function endAction() {
        $this->session->remove('authl');
        $this->flash->success('Logout bem sucedido!');
        return $this->response->redirect('');
    }

}
