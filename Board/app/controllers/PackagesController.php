<?php

use Phalcon\Tag;
use Phalcon\Mvc\Model\Criteria;

include __DIR__ . '/../../app/config/db_medoo.php';

class PackagesController extends ControllerBase {

    public function initialize() {
        global $boardLVM;
        $this->view->setTemplateAfter('base');
        $this->tag->setTitle('Pacotes');
        $auth = $this->session->get('auth');
        $id = $auth['id'];
        if ($auth['type'] > -1) {
            $this->flash->error("Apenas o Master tem permissão.");
            return $this->forward("index/index");
        }
        $usersProducts = $boardLVM->query("Select * From UsersProducts Where user_id = " . $id)->fetchAll();
        if (empty($usersProducts)) {
            $this->flash->error("Tem de cadastrar produtos primeiro.");
            return $this->response->redirect("products/index");
        }
        $this->view->setVar('name', $auth['name']);
        $this->view->setVar('status', 0);
        parent::initialize();
    }

    public function indexAction() {
        global $boardLVM;
        $auth = $this->session->get('auth');
        $id = $auth['id'];
        $usersPackages = $boardLVM->query("Select * From UsersPackages Where user_id = " . $id)->fetchAll();
        if (!empty($usersPackages)) {
            foreach ($usersPackages as $userPackage) {
                $showPackages[$userPackage['package_id']] = $boardLVM->query("Select * From Packages Where package_id = " . $userPackage['package_id'])->fetch();
            }
        }
        $usersProducts = $boardLVM->query("Select * From UsersProducts Where user_id = " . $id)->fetchAll();
        if (!empty($usersProducts)) {
            foreach ($usersProducts as $userProduct) {
                $selectProducts[$userProduct['product_id']] = $boardLVM->query("Select product_id, product_name From Products Where product_id = " . $userProduct['product_id'])->fetch();
            }
        }
        if (!empty($showPackages)) {
            $this->view->packages = $showPackages;
        } else {
            $this->view->packages = null;
        }
        if (!empty($selectProducts)) {
            $this->view->selectProducts = $selectProducts;
        } else {
            $this->view->selectProducts = null;
        }
    }

    public function statusAction($id, $status) {
        global $boardLVM;
        $last_product_id = $boardLVM->update("Packages", [
            "package_active" => $status
                ], [
            "package_id" => $id
        ]);
        $this->flash->success("Estado do Pacote Alterado.");
        return $this->response->redirect("packages/index");
    }

    public function createAction() {
        global $boardLVM;
        $auth = $this->session->get('auth');
        $id = $auth['id'];
        $request = $this->request;
        if (!$request->isPost()) {
            return $this->forward("packages/index");
        }
        $produtos = $request->getpost('product');
        $nome = $request->getPost("Pacote_nome");
        $data_expiracao = $request->getPost('Pacote_dataExpiracao');
        $preco = $request->getPost('Pacote_preco');
        $nomeFound = $boardLVM->query("Select package_id From Packages Where package_name = '$nome'")->fetch();
        if (!empty($nomeFound)) {
            $this->flash->error("Pacote com este nome já foi adicionado!");
            return $this->forward("packages/index");
        }

        $last_package_id = $boardLVM->insert("Packages", [
            "package_name" => $nome,
            "package_expire_date" => $data_expiracao,
            "package_price" => $preco,
            "package_active" => 0
        ]);
        //Store and check for errors
        $last_userproduct = $boardLVM->insert("UsersPackages", [
            "user_id" => $id,
            "package_id" => $last_package_id
        ]);
        $last_packageproduct = null;
        foreach ($produtos as $produto) {
            $last_packageproduct = $boardLVM->insert("PackagesProducts", [
                "package_id" => $last_package_id,
                "product_id" => $produto
            ]);
        }
        if (empty($last_package_id)) {
            $this->flash->error("Erro!! Ocorreu um erro ao tentar adicionar pacote.");
            return $this->forward("packages/index");
        } else {
            $this->flash->success("Pacote foi criado com sucesso!");
            return $this->forward("packages/index");
        }
    }

}
