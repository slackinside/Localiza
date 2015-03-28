<?php

use Phalcon\Tag;
use Phalcon\Mvc\Model\Criteria;

include __DIR__ . '/../../app/config/db_medoo.php';

class ProductsController extends ControllerBase {

    public function initialize() {
        $this->view->setTemplateAfter('base');
        $this->tag->setTitle('Produtos');
        $auth = $this->session->get('auth');
        if ($auth['type'] != -1) {
            $this->flash->error("Apenas o Master tem permissão.");
            return $this->forward("index/index");
        }
        $this->view->setVar('name', $auth['name']);
        $this->view->setVar('status', 0);
        parent::initialize();
    }

    public function indexAction() {
        global $boardLVM;
        $auth = $this->session->get('auth');
        $id = $auth['id'];
        $usersProducts = $boardLVM->query("Select product_id From UsersProducts Where user_id = " . $id)->fetchAll();
        $counter = 0;
        foreach ($usersProducts as $userProduct) {
            $showProducts[$counter] = $boardLVM->query("Select * From Products Where product_id = " . $userProduct['product_id'])->fetch();
            $selectProducts[$counter] = $boardLVM->query("Select product_name From Products Where product_id = " . $userProduct['product_id'])->fetch();
            $counter++;
        }
        if (!empty($showProducts)) {
            $this->view->products = $showProducts;
        } else {
            $this->view->products = null;
        }
        if (!empty($selectProducts)) {
            $this->view->selectProducts = $selectProducts;
        } else {
            $this->view->selectProducts = null;
        }
    }

    public function packageAction() {
        $auth = $this->session->get('auth');
        $id = $auth['id'];
        $request = $this->request;
        if (!$request->isPost()) {
            return $this->forward("products/index");
        }
        $produtoId = $request->getPost('product');
        $nomePacote = $request->getPost('Pacote_nome');
        $precoPacote = $request->getPost('Pacote_preco');
        $nomeFound = Packages::findFirst("Pacote_nome = '$nomePacote'");
        if ($nomeFound != null) {
            $this->flash->error("Pacote com este nome já foi adicionado!");
            return $this->forward("products/index");
        }
        $packages = new Packages();
        $packages->Produto_id = $produtoId;
        $packages->Pacote_nome = $nomePacote;
        $packages->Pacote_preco = $precoPacote;
        if ($packages->save()) {
            $this->flash->success("Pacote adicionado com sucesso!");
            return $this->response->redirect("products/index");
        }
    }

    public function statusAction($id, $status) {
        global $boardLVM;
        $last_product_id = $boardLVM->update("Products", [
            "product_active" => $status
                ], [
            "product_id" => $id
        ]);
        $this->flash->success("Estado do Produto Alterado.");
        return $this->forward("products/index");
    }

    public function createAction() {
        global $boardLVM;
        $auth = $this->session->get('auth');
        $id = $auth['id'];
        $request = $this->request;
        if (!$request->isPost()) {
            return $this->forward("products/index");
        }
        $nome = $request->getPost("Produto_nome");
        $productPrice = $request->getPost("Produto_preco");
        $nomeFound = $boardLVM->query("Select up.product_id From Products p Inner Join UsersProducts up On p.product_id=up.product_id Where up.user_id = $id And p.product_name = '$nome'")->fetch();
        if (!empty($nomeFound)) {
            $this->flash->error("Produto com este nome já foi adicionado!");
            return $this->forward("products/index");
        }
        $last_product_id = $boardLVM->insert("Products", [
            "product_name" => $nome,
            "product_active" => 0,
            "product_price" => $productPrice
        ]);
        //Store and check for errors
        $last_userproduct = $boardLVM->insert("UsersProducts", [
            "user_id" => $id,
            "product_id" => $last_product_id
        ]);
        if (empty($last_product_id)) {
            $this->flash->error("Erro!! Ocorreu um erro ao tentar adicionar o Produto $nome");
            return $this->forward("products/index");
        } else {
            $this->flash->success("Produto $nome foi criado com sucesso!");
            return $this->forward("products/index");
        }
    }

}
