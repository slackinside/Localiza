<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Phalcon\Tag;
use Phalcon\Mvc\Model\Criteria;

include __DIR__ . '/../../app/config/db_medoo.php';

class ClientsController extends ControllerBase {

    public function initialize() {
        $this->view->setTemplateAfter('base');
        $this->tag->setTitle('Gestão de Clientes');
        $auth = $this->session->get('auth');
        $this->view->setVar('name', $auth['name']);
        if ($auth['type'] > 0) {
            $this->flash->error("Você não tem permissão.");
            return $this->forward("index/index");
        }
        parent::initialize();
    }

    public function indexAction() {
        $_SESSION['counter'] = 0;
        global $boardLVM;
        $auth = $this->session->get('auth');
        if ($auth['type'] == 0) {
            return $this->response->redirect("clients/shopping/" . false . "#hide");
        }
        $id = $auth['id'];
        $clients = $boardLVM->query("Select * From MastersClients Where user_master_id = " . $id)->fetchAll();
        foreach ($clients as $client) {
            $showUsersLogin[$client['user_client_id']] = $boardLVM->query("Select userLogin_id, user_active From UsersLogin Where userLogin_id = " . $client['user_client_id'])->fetch();
            $showClients[$client['user_client_id']] = $boardLVM->query("Select user_id, user_name From Users Where user_id = " . $client['user_client_id'])->fetch();
        }
        if (!empty($showClients)) {
            $this->view->clients = $showClients;
            $this->view->usersLogins = $showUsersLogin;
        } else {
            $this->view->clients = null;
            $this->view->usersLogins = null;
        }
    }

    public function newAction() {
        $this->tag->setTitle('Cadastro de Clientes');
    }

    public function productsAction() {
        global $boardLVM;
        $this->tag->setTitle('Permissões de Clientes com Produtos');
        $this->view->setTemplateAfter('base');
        $auth = $this->session->get('auth');
        if ($auth['type'] == 0 || $auth['type'] == 3) {
            $this->flash->error("Não têm permissão.");
            return $this->response->redirect("clientes/index");
        }
        $id = $auth['id'];

        if ($auth['type'] == -1) {
            // clientes associados
            $usersFound = $boardLVM->query("Select * From MastersClients Where user_master_id = " . $id)->fetchAll();
            if (!empty($usersFound)) {
                // produtos associados
                $masterProducts = $boardLVM->query("Select * From UsersProducts Where user_id = " . $id)->fetchAll();
                $counter = 0;
                if (!empty($masterProducts)) {
                    foreach ($masterProducts as $masterProduct) {
                        $products[$counter] = $boardLVM->query("Select * From Products Where product_id = " . $masterProduct['product_id'])->fetch();
                        foreach ($usersFound as $user) {
                            if (!empty($boardLVM->query("Select * From UsersProducts Where user_id = " . $user['user_client_id'] . " And product_id = " . $masterProduct['product_id'])->fetch())) {
                                $usersProducts[$counter] = array('user_id' => $boardLVM->query("Select * From UsersProducts Where user_id = " . $user['user_client_id'] . "And product_id = " . $masterProduct['product_id'])->fetch()['user_id'],
                                    'product_id' => $boardLVM->query("Select * From UsersProducts Where user_id = " . $user['user_client_id'] . "And product_id = " . $masterProduct['product_id'])->fetch()['product_id'],
                                    'product_discount' => $boardLVM->query("Select * From UsersProducts Where user_id = " . $user['user_client_id'] . "And product_id = " . $masterProduct['product_id'])->fetch()['product_discount'],
                                    'product_price_with_discount' => $boardLVM->query("Select * From UsersProducts Where user_id = " . $user['user_client_id'] . "And product_id = " . $masterProduct['product_id'])->fetch()['product_price_with_discount'],
                                    'query_price' => $boardLVM->query("Select * From UsersProducts Where user_id = " . $user['user_client_id'] . "And product_id = " . $masterProduct['product_id'])->fetch()['query_price'],
                                    'user_name' => $boardLVM->query("Select * From Users Where user_id = " . $user['user_client_id'])->fetch()['user_name'],
                                    'product_name' => $boardLVM->query("Select * From Products Where product_id = " . $masterProduct['product_id'])->fetch()['product_name']);
                            }
                            $counter++;
                        }
                    }
                    foreach ($usersFound as $user) {
                        //diferenciação por clients
                        if ($boardLVM->query("Select user_type From UsersLogin Where userLogin_id = " . $user['user_client_id'])->fetch()['user_type'] == 0) {
                            $clients[$user['user_client_id']] = $boardLVM->query("Select * From Users Where user_id = " . $user['user_client_id'])->fetch()['user_name'];
                        }
                    }
                    (empty($clients)) ? $this->view->clientsOutAssoc = null : $this->view->clientsOutAssoc = $clients;
                }
            }
            if (!empty($products)) {
                $this->view->products = $products;
            } else {
                $this->view->products = null;
            }

            if (empty($usersProducts)) {
                $this->view->clientsProducts = null;
            } else {
                $this->view->clientsProducts = $usersProducts;
            }
        }
    }

    public function assocAction() {
        $request = $this->request;
        if ($request->isPost()) {
            global $boardLVM;
            $usuarios = $request->getPost('clients');
            $produto_desconto = $request->getPost('product_discount');
            $queryPrice = $request->getPost('query_price');
            $check = $request->getPost('list');
            if (empty($check)) {
                $this->response->redirect("clients/products");
                $this->flash->error("Tem de selecionar os produtos que deseja associar.");
                $this->view->disable();
            }
            foreach ($check as $checked) {

                if (!empty($checked)) {
                    $founddedProduto_id = $checked;
                    $foundedProdutoDesconto = $produto_desconto[$checked];
                    $foundedQueryPrice = $queryPrice[$checked];
                    $product_price = $boardLVM->query("Select product_price From Products Where product_id = " . $founddedProduto_id)->fetch();
                    $productPriceWithDiscount = $product_price['product_price'] - ($product_price['product_price'] * ($foundedProdutoDesconto / 100));
                    foreach ($usuarios as $usuario) {
                        if (empty($boardLVM->query("Select user_id from UsersProducts where user_id = " . $usuario . " and product_id = " . $founddedProduto_id)->fetch())) {
                            $last_userLogin_id = $boardLVM->insert("UsersProducts", [
                                "user_id" => $usuario,
                                "product_id" => $founddedProduto_id,
                                "product_discount" => $foundedProdutoDesconto,
                                "product_price_with_discount" => $productPriceWithDiscount,
                                "state" => 10,
                                "query_price" => $foundedQueryPrice
                            ]);
                        }
                    }
                }
            }
            $this->response->redirect("clients/products");
            $this->flash->success("Associação criada com sucesso.");
        }
    }

    public function editAssocAction($user, $product, $query_price, $discount) {
        global $boardLVM;
        $request = $this->request;
        if ($request->isPost()) {
            $query_price = $request->getPost('query_price');
            $produto_desconto = $request->getPost('product_discount');
            $check = $request->getPost('listAssocEdit');
            foreach ($check as $checked) {
                $founddedProduto_id = substr($checked, 0, strpos($checked, '-'));
                $founddedUsuario_id = substr(strrchr($checked, "-"), 1);
                $foundedProdutoDesconto = $produto_desconto[$checked];
                $foundedQueryPrice = $query_price[$checked];
                $product_price = $boardLVM->query("Select product_price From Products Where product_id = " . $founddedProduto_id)->fetch();
                $productPriceWithDiscount = $product_price['product_price'] - ($product_price['product_price'] * ($foundedProdutoDesconto / 100));
                $boardLVM->query("Update UsersProducts set product_discount = " . $foundedProdutoDesconto . ", product_price_with_discount = " . $productPriceWithDiscount . ", query_price = " . $foundedQueryPrice . " Where user_id = " . $founddedUsuario_id . " And product_id = " . $founddedProduto_id)->fetch();
            }
            $this->response->redirect("clients/products");
            $this->flash->success("Associações editadas com sucesso.");
        } else {
            if (!empty($user) && !empty($product)) {
                $productPriceWithDiscount = 0;
                $product_price = $boardLVM->query("Select product_price From Products Where product_id = " . $product)->fetch();
                if ($discount != 0) {
                    $productPriceWithDiscount = $product_price['product_price'] - ($product_price['product_price'] * ($discount / 100));
                }
                if ($discount == null && $query_price != null) {
                    $boardLVM->query("Update UsersProducts set query_price = " . $query_price . " Where user_id = " . $user . " And product_id = " . $product)->fetch();
                } else if ($discount != null && $query_price == null) {
                    $boardLVM->query("Update UsersProducts set product_discount = " . $discount . ", product_price_with_discount = " . $productPriceWithDiscount . " Where user_id = " . $user . " And product_id = " . $product)->fetch();
                } else if ($discount != null && $query_price != null) {
                    $boardLVM->query("Update UsersProducts set product_discount = " . $discount . ", product_price_with_discount = " . $productPriceWithDiscount . ", query_price = " . $query_price . " Where user_id = " . $user . " And product_id = " . $product)->fetch();
                }
                $this->response->redirect("clients/products");
                $this->flash->success("Edição finalizada com sucesso.");
            }
        }
    }

    public function remAssocAction($product, $user) {
        global $boardLVM;
        $request = $this->request;
        if ($request->isPost()) {
            $check = $request->getPost('listAssocRem');
            if (empty($check)) {
                $this->response->redirect("clients/products");
                $this->flash->error("Erro! Tem de selecionar as associações a remover..");
            }
            foreach ($check as $checked) {
                $founddedProduto_id = substr($checked, 0, strpos($checked, '-'));
                $founddedUsuario_id = substr(strrchr($checked, "-"), 1);
                $boardLVM->query("Delete From UsersProducts Where user_id = " . $founddedUsuario_id . " And product_id = " . $founddedProduto_id)->fetch();
            }
            $this->response->redirect("clients/products");
            $this->flash->success("Associação(ões) removida(s) com sucesso.");
        } else {
            if (!empty($user) && !empty($product) && $type == 1) {
                $boardLVM->query("Delete From UsersProducts Where user_id = " . $user . " And product_id = " . $product)->fetch();
            }
            $this->response->redirect("clients/products");
            $this->flash->success("Associação removida com sucesso.");
        }
    }

    public function shoppingAction($flag) {
        global $boardLVM;
        $auth = $this->session->get('auth');
        $_SESSION['counter'] ++;
        if ($auth['type'] != 0) {
            $this->response->redirect("index");
            $this->flash->notice("Apenas o cliente pode comprar produtos.");
        }
        if ($flag == false || empty($flag) || $_SESSION['counter'] == 2) {
            $_SESSION['counter'] = 0;
            return $this->response->redirect("clients/shopping/" . $auth['id'] . "#hide");
        }
        $id = $auth['id'];
        $client = $boardLVM->query("Select * From Users Where user_id =" . $id)->fetch();
        $shoppingMovements = $boardLVM->query("Select * From UsersProducts Where user_id =" . $id)->fetchAll();
        echo "<table class='table col-lg-5'><thead><tr><th>Nome do Produto</th><th>Valor</th><th>Estado</th><th>Comprar?</th></tr></thead><tbody>";
        if (!empty($client)) {
            if (!empty($shoppingMovements)) {
                foreach ($shoppingMovements as $shoppingMovement) {
                    $produtoId = $shoppingMovement['product_id'];
                    $produto = $boardLVM->query("Select * From Products Where product_id =" . $produtoId)->fetch();
                    echo "<tr><td>" . $produto['product_name'] . "</td><td>" . $shoppingMovement['product_price_with_discount'] . "</td><td>";
                    if ($shoppingMovement['state'] == 10) {
                        echo "A aguardar pedido";
                    }
                    if ($shoppingMovement['state'] == 20) {
                        echo "Pendente";
                    }
                    if ($shoppingMovement['state'] == 30) {
                        echo "Liberado";
                    }
                    echo "</td><td>";
                    echo ($shoppingMovement['state'] == 10) ? Phalcon\Tag::linkTo(array('bilhetagem/buyPackage/' . $id . '/' . $shoppingMovement['product_id'], 'Comprar', 'target' => '_blank')) : '--';
                    echo "</td></tr>";
                }
            }
        }
        echo "</tbody></table>";
    }

    public function packagesAction() {
        global $boardLVM;
        $auth = $this->session->get('auth');
        $id = $auth['id'];
        if ($auth['type'] == -1) {
            // search for clients by master
            $mastersClients = $boardLVM->query("Select * From MastersClients Where user_master_id = " . $id)->fetchAll();
            if (!empty($mastersClients)) {
                foreach ($mastersClients as $masterClient) {
                    $clients[$masterClient['user_client_id']] = $boardLVM->query("Select * From Users Where user_id = " . $masterClient['user_client_id'])->fetch();
                    $clientsSelect[$masterClient['user_client_id']] = $boardLVM->query("Select user_name From Users Where user_id = " . $masterClient['user_client_id'])->fetch()['user_name'];
                    $userPackages[$masterClient['user_client_id']] = $boardLVM->query("Select * From UsersPackages Where user_id = " . $masterClient['user_client_id'])->fetch();
                }
                $this->view->clients = $clients;
                $this->view->clientsSelect = $clientsSelect;
                $this->view->userPackages = $userPackages;
            } else {
                $this->view->clients = null;
                $this->view->clientsSelect = array(0 => "Sem Clientes");
            }

            //search for packages 
            $masterProducts = $boardLVM->query("Select * From UsersProducts Where user_id = " . $id)->fetchAll();
            $packagesProducts = $boardLVM->query("Select * From PackagesProducts")->fetchAll();
            if (!empty($masterProducts)) {
                foreach ($packagesProducts as $packageProduct) {
                    $idProduto = $packageProduct['product_id'];
                    if (!empty($boardLVM->query("Select * From UsersProducts Where user_id = " . $id . " And product_id = " . $idProduto)->fetch())) {
                        $packagesSelect[$packageProduct['package_id']] = $boardLVM->query("Select package_name From Packages where package_id = " . $packageProduct['package_id'])->fetch()['package_name'];
                        $packagesByClient[$packageProduct['package_id']] = $boardLVM->query("Select * From Packages where package_id = " . $packageProduct['package_id'])->fetch();
                    }
                }
                if (!empty($packagesSelect)) {
                    $this->view->packagesSelect = $packagesSelect;
                } else {
                    $this->view->packagesSelect = array(0 => "Sem Pacotes");
                }
            }
            if (!empty($packagesByClient)) {
                $this->view->packages = $packagesByClient;
            }
            $this->view->setVar('counter', 0);
            $clienteId = $boardLVM->query("Select user_client_id From MastersClients Where user_master_id = " . $id)->fetch();
            if (!empty($clienteId)) {
                $pacoteId = $boardLVM->query("Select package_id From UsersPackages Where user_id = " . $clienteId['user_client_id'])->fetch()['package_id'];
                if (!empty($pacoteId)) {
                    $this->view->status = 0;
                    $this->view->showStatus = 'Desassociar';
                } else {
                    $this->view->status = 1;
                    $this->view->showStatus = 'Associar';
                }
            } else {
                $this->view->status = 1;
                $this->view->showStatus = 'Associar';
            }
        }
    }

    public function verifyassocAction($usuarioId, $pacoteId) {
        $resultAssoc = UserPackages::findFirst("Usuario_id = $usuarioId And Pacote_id = $pacoteId");
        if (!empty($resultAssoc)) {
            $this->view->status = 0;
            echo Phalcon\Tag::hiddenField(array('status', 'value' => '0'));
            echo Phalcon\Tag::submitButton(array("Desassociar", "class" => "btn btn-primary"));
        } else {
            $this->view->status = 1;
            echo Phalcon\Tag::hiddenField(array('status', 'value' => '1'));
            echo Phalcon\Tag::submitButton(array("Associar", "class" => "btn btn-primary"));
        }
        $this->view->disable();
    }

    public function assocPackageAction() {
        $request = $this->request;
        if ($request->isPost()) {
            global $boardLVM;
            $cliente_id = $request->getPost('client');
            $pacote_id = $request->getPost('pacote');
            $status = $request->getPost('status');

            if ($status == 1) {
                /* $shoppingMovements = new ShoppingMovements();
                  $shoppingMovements->Usuario_id = $cliente_id;
                  $shoppingMovements->Pacote_id = $pacote_id;
                  $shoppingMovements->Estado = 10;
                  $shoppingMovements->save(); */
                $boardLVM->insert("UsersPackages", [
                    "user_id" => $cliente_id,
                    "package_id" => $pacote_id,
                ]);
                $this->flash->success('O pacote foi associado com sucesso!');
                return $this->response->redirect('clients/packages');
            } else if ($status == 0) {
                /* $foundedShop = ShoppingMovements::findFirst("Usuario_id = $cliente_id And Pacote_id = $pacote_id");
                  if (!empty($foundedShop)) {
                  $foundedShop->delete();
                  } */
                $boardLVM->query("Delete From UsersPackages Where user_id = " . $cliente_id . " And package_id = " . $pacote_id)->fetch();
                $this->flash->success('O pacote foi desassociado com sucesso!');
                return $this->response->redirect('clients/packages');
            }
        }
    }

    public function statusAction($id, $status) {
        global $boardLVM;
        $last_userLogin_id = $boardLVM->update("UsersLogin", [
            "user_active" => $status
                ], [
            "userLogin_id" => $id
        ]);
        $this->flash->success("Estado do Cliente alterado.");
        return $this->forward("clients/index");
    }

    public function registerAction() {
        $request = $this->request;
        if ($request->isPost()) {
            global $boardLVM;
            $cnpj = $request->getPost('Cliente_cnpj');
            $razaoSocial = $request->getPost('Cliente_razao_social');
            $nomeFantasia = $request->getPost('Cliente_nome_fantasia');
            $enderecoFiscalRuaAv = $request->getPost('Cliente_fiscal_endereco_rua_av');
            $enderecoFiscalNumero = $request->getPost('Cliente_fiscal_numero');
            $enderecoFiscalComplemento = $request->getPost('Cliente_fiscal_complemento');
            $enderecoFiscalCep = $request->getPost('Cliente_fiscal_cep');
            $enderecoFiscalBairro = $request->getPost('Cliente_fiscal_bairro');
            $enderecoFiscalCidade = $request->GetPost('Cliente_fiscal_cidade');
            $enderecoFiscalEstado = $request->getPost('Cliente_fiscal_estado');
            $enderecoCorrespondenciaRuaAv = $request->getPost('Cliente_correspondencia_endereco_rua_av');
            $enderecoCorrespondenciaNumero = $request->getPost('Cliente_correspondencia_numero');
            $enderecoCorrespondenciaComplemento = $request->getPost('Cliente_correspondencia_complemento');
            $enderecoCorrespondenciaCep = $request->getPost('Cliente_correspondencia_cep');
            $enderecoCorrespondenciaBairro = $request->getPost('Cliente_correspondencia_bairro');
            $enderecoCorrespondenciaCidade = $request->GetPost('Cliente_correspondencia_cidade');
            $enderecoCorrespondenciaEstado = $request->getPost('Cliente_correspondencia_estado');
            $name = $request->getPost("Cliente_nome_contato");
            $email = $request->getPost("Cliente_email_contato");
            $telefone = $request->getPost("Cliente_telefone_contato");
            $morada = $request->getPost("Cliente_morada_contato");
            $username = $request->getPost("Cliente_login");
            $password = $request->getPost("Cliente_password");
            $repeatPassword = $request->getPost("Cliente_password_conf");
        }

        $usernameFound = $boardLVM->query("Select * From UsersLogin Where username = '$username'")->fetchAll();
        if (!empty($usernameFound)) {
            $this->flash->error('Usuário já cadastrado! Tente um diferente');
            return false;
        }
        if ($password != $repeatPassword) {
            $this->flash->error('Passwords diferentes');
            return false;
        }

        $last_deliver_address_id = $boardLVM->insert("DeliverAddress", [
            "deliver_address_av_rua" => $enderecoCorrespondenciaRuaAv,
            "deliver_address_num" => $enderecoCorrespondenciaNumero,
            "deliver_address_comp" => $enderecoCorrespondenciaComplemento,
            "deliver_address_cep" => $enderecoCorrespondenciaCep,
            "deliver_address_bairro" => $enderecoCorrespondenciaBairro,
            "deliver_address_cidade" => $enderecoCorrespondenciaCidade,
            "deliver_address_estado" => $enderecoCorrespondenciaEstado
        ]);

        $last_fiscal_address_id = $boardLVM->insert("FiscalAddress", [
            "fiscal_address_av_rua" => $enderecoCorrespondenciaRuaAv,
            "fiscal_address_num" => $enderecoCorrespondenciaNumero,
            "fiscal_address_comp" => $enderecoCorrespondenciaComplemento,
            "fiscal_address_cep" => $enderecoCorrespondenciaCep,
            "fiscal_address_bairro" => $enderecoCorrespondenciaBairro,
            "fiscal_address_cidade" => $enderecoCorrespondenciaCidade,
            "fiscal_address_estado" => $enderecoCorrespondenciaEstado
        ]);

        $password = sha1($password);
        $last_userLogin_id = $boardLVM->insert("UsersLogin", [
            "username" => $username,
            "password" => $password,
            "user_active" => 0,
            "user_type" => 0
        ]);

        $last_user_id = $boardLVM->insert("Users", [
            "user_id" => $last_userLogin_id,
            "user_name" => $name,
            "user_email" => $email,
            "user_address" => NULL,
            "user_cnpj" => $cnpj,
            "user_razao_social" => $razaoSocial,
            "user_nome_fantasia" => $nomeFantasia
        ]);

        $last_user_fiscal_address_id = $boardLVM->insert("UsersFiscalAddress", [
            "user_id" => $last_userLogin_id,
            "fiscal_address_id" => $last_fiscal_address_id
        ]);

        $last_user_deliver_address_id = $boardLVM->insert("UsersDeliverAddress", [
            "user_id" => $last_userLogin_id,
            "deliver_address_id" => $last_deliver_address_id
        ]);

        //Associação ao Master
        $auth = $this->session->get('auth');
        $last_master_client_id = $boardLVM->insert("MastersClients", [
            "user_master_id" => $auth['id'],
            "user_client_id" => $last_userLogin_id
        ]);

        if (empty($last_userLogin_id)) {
            $this->flash->error('Erro!! Ocorreu um erro ao tentar cadastrar Cliente');
            Tag::setDefault('Cliente_email', '');
            Tag::setDefault('Cliente_password', '');
        } else {
            $this->flash->success('Novo Cliente cadastrado com sucesso!');
            return $this->response->redirect('clients/index');
        }
    }

}
