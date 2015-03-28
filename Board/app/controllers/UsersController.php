<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Phalcon\Tag;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Mvc\Model\Query\Builder;

include __DIR__ . '/../../app/config/db_medoo.php';

class UsersController extends ControllerBase {

    public function initialize() {
        $this->view->setTemplateAfter('base');
        $this->tag->setTitle('Gestão de Usuários');
        $auth = $this->session->get('auth');
        $this->view->setVar('name', $auth['name']);
        $id = $auth['id'];
        global $boardLVM;
        global $supers;
        global $users;
        global $admins;
        global $usersLogin;
//Getting a whole set

        if ($auth['type'] < 2) {
            if ($auth['type'] == 0) {
                $clients = $boardLVM->query("Select * From Users Where user_id = " . $id)->fetchAll();
                $usersClients = $boardLVM->query("Select * From ClientsUsers Where user_client_id = " . $id)->fetchAll();
                if ($usersClients != null) {
                    foreach ($usersClients as $userClient) {
                        $users[$userClient['user_user_id']] = $boardLVM->query("Select * From Users Where user_id = " . $userClient['user_user_id'])->fetch();
                        $usersLogin[$userClient['user_user_id']] = $boardLVM->query("Select * From UsersLogin Where userLogin_id = " . $userClient['user_user_id'])->fetch();
                    }
                    $userClient = $boardLVM->query("Select top 1 * From ClientsUsers Where user_client_id = " . $id)->fetch();
                    if (!empty($userClient)) {
                        $userId = $userClient['user_user_id'];
                        $usersA = $boardLVM->query("Select top 1 * From UsersUsers Where user_admin_id = " . $userId)->fetchAll();
                        $usersS = $boardLVM->query("Select top 1 * From UsersUsers Where user_super_id = " . $userId)->fetchAll();
                        $usersU = $boardLVM->query("Select top 1 * From UsersUsers Where user_user_id = " . $userId)->fetchAll();
                        foreach ($usersA as $userA) {
                            $admins[$userA['user_admin_id']] = $boardLVM->query("Select user_name From Users Where user_id = " . $userA['user_admin_id'])->fetch()['user_name'];
                        }
                        foreach ($usersS as $userS) {
                            $admins[$userS['user_super_id']] = $boardLVM->query("Select user_name From Users Where user_id = " . $userS['user_super_id'])->fetch()['user_name'];
                        }
                        foreach ($usersU as $userU) {
                            $admins[$userU['user_user_id']] = $boardLVM->query("Select user_name From Users Where user_id = " . $userA['user_user_id'])->fetch()['user_name'];
                        }
                    }
                } else {
                    $usersLogin = null;
                }
            }
            if ($auth['type'] == -1) {
                $mastersClients = $boardLVM->query("Select * From MastersClients Where user_master_id = " . $id)->fetchAll();
                if (empty($mastersClients)) {
                    $this->flash->error("Erro!! Você não pode adicionar Usuários sem ter um Cliente Cadastrado.");
                    return $this->forward("clients/new");
                }
                foreach ($mastersClients as $masterClient) {
                    $clients[$masterClient['user_client_id']] = $boardLVM->query("Select user_name From Users Where user_id = " . $masterClient['user_client_id'])->fetch()['user_name'];
                }
                $masterClient = $boardLVM->query("Select top 1 * From MastersClients Where user_master_id = " . $id)->fetch();
                if (!empty($masterClient)) {
                    $clienteId = $masterClient['user_client_id'];
                    $usersClients = $boardLVM->query("Select * From ClientsUsers Where user_client_id = " . $clienteId)->fetchAll();
                    if (!empty($usersClients)) {
                        foreach ($usersClients as $userClient) {
                            $admins[$userClient['user_user_id']] = $boardLVM->query("Select user_name From Users Where user_id = " . $userClient['user_user_id'])->fetch()['user_name'];
                        }
                    }
                }
                $userCliente = $boardLVM->query("Select top 1 * From ClientsUsers Where user_client_id = " . $clienteId)->fetch();
                if (!empty($userCliente)) {
                    $adminId = $userCliente['user_user_id'];
                    $usersUsers = $boardLVM->query("Select * From UsersUsers Where user_admin_id = " . $adminId)->fetchAll();
                    foreach ($usersUsers as $user) {
                        $supers[$user['user_super_id']] = $boardLVM->query("Select user_name From Users Where user_id = " . $user['user_super_id'])->fetch()['user_name'];
                    }
                }
                $mastersUsers = $boardLVM->query("Select * From MastersUsers Where user_master_id = " . $id)->fetchAll();
                if (!empty($mastersUsers)) {
                    foreach ($mastersUsers as $masterUser) {
                        $users[$masterUser['user_user_id']] = $boardLVM->query("Select * From Users Where user_id = " . $masterUser['user_user_id'])->fetch();
                        $usersLogin[$masterUser['user_user_id']] = $boardLVM->query("Select * From UsersLogin Where userLogin_id = " . $masterUser['user_user_id'])->fetch();
                    }
                } else {
                    $usersLogin = null;
                }
            }
            if ($auth['type'] == 1) {
                $usersClientsId = UsersClients::findFirst("Usuario_id = $id");
                $usersClients = UsersClients::find("Cliente_id = '$usersClientsId->Cliente_id'");
                $clients = Clients::find("Cliente_id = '$usersClientsId->Cliente_id'");
                if (!empty($usersClients)) {
                    foreach ($usersClients as $userClient) {
                        $users[$userClient->Usuario_id] = Users::findFirstByUsuario_id($userClient->Usuario_id);
                        $usersLogin[$userClient->Usuario_id] = UsersLogin::findFirstByUserLogin_Usuario_id($userClient->Usuario_id);
                    }
                    $currentUser = Users::findFirstByUsuario_id($id);
                    $admins = array($id => $currentUser->Usuario_nome);
                    $usersUsers = UsersUsers::find("Usuario_admin = $id");
                    if (!empty($usersUsers->getFirst("Usuario_admin = $firstAdminId")->Usuario_supervisor)) {
                        foreach ($usersUsers as $userUser) {
                            $supers[$userUser->Usuario_supervisor] = Users::findFirstByUsuario_id($userUser->Usuario_supervisor)->Usuario_nome;
                        }
                    }
                } else {
                    $usersLogin = null;
                }
            }
            $this->view->setVar('clients', $clients);
            $this->view->setVar('usersLogin', $usersLogin);
            if (!empty($users)) {
                $this->view->setVar('users', $users);
            }
            if (!empty($admins)) {
                $this->view->setVar('admins', $admins);
            } else {
                $this->view->setVar('admins', array(0, 'Não Encontrado'));
            }
            if (!empty($supers)) {
                $this->view->setVar('supers', $supers);
            } else {
                $this->view->setVar('supers', array(0, 'Não Encontrado'));
            }
        }
        if ($auth['type'] < 2 && !empty($supers)) {
            $this->view->setVar('userType', array(1 => 'Administrador', 2 => 'Supervisor', 3 => 'Usuário'));
        }
        if ($auth['type'] < 2 && empty($supers)) {
            $this->view->setVar('userType', array(1 => 'Administrador', 2 => 'Supervisor'));
        }
        if ($auth['type'] < 2 && empty($admins)) {
            $this->view->setVar('userType', array(1 => 'Administrador', 2 => 'Supervisor', 3 => 'Usuário'));
        }
        if ($auth['type'] == 2) {
            $this->view->setVar('userType', array(2 => 'Supervisor', 3 => 'Usuário'));
        }
        parent::initialize();
    }

    public function indexAction() {
        
    }

    public function getadminsAction($client, $typeUser) {
        global $boardLVM;
        $supers = null;
        $admins = null;
        Phalcon\Tag::setDefault("client", $client);
        Phalcon\Tag::setDefault("type", $typeUser);
        $auth = $this->session->get('auth');
        if ($auth['type'] < 2) {
            if ($auth['type'] == -1) {
                $masterId = $auth['id'];
                $clientes = $boardLVM->query("Select * From MastersClients Where user_master_id = " . $masterId)->fetchAll();
                foreach ($clientes as $cliente) {
                    $clients[$cliente['user_client_id']] = $boardLVM->query("Select user_name From Users Where user_id = " . $cliente['user_client_id'])->fetch()['user_name'];
                }
            }
            if ($auth['type'] > 0)
                $clients[$boardLVM->query("Select user_id From Users Where user_id = " . $client)->fetch()['user_id']] = $boardLVM->query("Select user_name From Users Where user_id = " . $client)->fetch()['user_name'];
        }
        if (!empty($client)) {
            $usersClients = $boardLVM->query("Select * From ClientsUsers Where user_client_id = " . $client)->fetchAll();
            if ($usersClients) {
                foreach ($usersClients as $userClient) {
                    $admins[$userClient['user_user_id']] = $boardLVM->query("Select user_name From Users Where user_id = " . $userClient['user_user_id'])->fetch()['user_name'];
                }
            }
            $firstAdminId = $boardLVM->query("Select top 1 user_client_id From ClientsUsers Where user_client_id = " . $client)->fetch()['user_client_id'];
            if (!empty($firstAdminId)) {
                $usersUsers = $boardLVM->query("Select * From UsersUsers Where user_admin_id = " . $firstAdminId)->fetchAll();
                foreach ($usersUsers as $userUser) {
                    $supers[$userUser['user_super_id']] = $boardLVM->query("Select user_name From Users Where user_id = " . $userUser['user_super_id'])->fetch()['user_name'];
                }
            }
            if (!empty($admins) && !empty($supers) && $auth['type'] < 2) {
                $userType = array(1 => 'Administrador', 2 => 'Supervisor', 3 => 'Usuário');
            }
            if (!empty($admins) && empty($supers) && $auth['type'] < 2) {
                $userType = array(1 => 'Administrador', 2 => 'Supervisor');
            }
            if ($auth['type'] == 2 && $typeUser == 2) {
                $userType = array(2 => 'Supervisor', 3 => 'Usuário');
            }
            if (!empty($clients)) {
                if (!empty($admins)) {
                    echo '<h3><label class="label label-default">Usuário Tipo</label></h3>' . $this->tag->select(array(
                        'type',
                        $userType,
                        'class' => 'form-control',
                        'using' => array('id', 'name'),
                        'onchange' => 'getAdmins(null,this.value)',
                    )) . '<h3><label class="label label-default">Associação Cliente</label></h3>' . $this->tag->select(array(
                        'client',
                        $clients,
                        'class' => 'form-control',
                        'using' => array('user_id', 'user_name'),
                        'onchange' => 'getAdmins(this.value,document.getElementById("type").value)',
                    ));
                    if ($typeUser > 1 && $auth['type'] < 2) {
                        echo '<h3><label class="label label-default">Associação Administrador</label></h3>' . $this->tag->select(array(
                            'admin',
                            $admins,
                            'class' => 'form-control',
                            'using' => array('user_id', 'user_name'),
                            'onchange' => 'getSupers(this.value)',
                        ));
                    }
                    if ($typeUser == 3 && !empty($supers)) {
                        echo '<div id="supers"><h3><label class="label label-default">Associação Supervisor</label></h3>' . $this->tag->select(array(
                            'super',
                            $supers,
                            'class' => 'form-control',
                            'using' => array('user_id', 'user_name'),
                        )) . '</div><br />';
                    }
                    if (empty($supers)) {
                        Phalcon\Tag::setDefault("type", 2);
                    }
                    $this->view->disable();
                }
                if (empty($admins) && empty($supers)) {
                    $userType = array(1 => 'Administrador');
                    $admins = [0 => 'Não Encontrado'];
                    Phalcon\Tag::setDefault("client", $client);
                    Phalcon\Tag::setDefault("type", 1);
                    echo '<h3><label class="label label-default">Usuário Tipo</label></h3>' . $this->tag->select(array(
                        'type',
                        $userType,
                        'class' => 'form-control',
                        'using' => array('id', 'name'),
                        'onchange' => 'getAdmins(null,this.value)',
                    )) . '<h3><label class="label label-default">Associação Cliente</label></h3>' . $this->tag->select(array(
                        'client',
                        $clients,
                        'class' => 'form-control',
                        'using' => array('user_id', 'user_name'),
                        'onchange' => 'getAdmins(this.value,document.getElementById("type").value)',
                    )) . '<br />';
                    $this->view->disable();
                }
            } else {
                Phalcon\Tag::setDefault("client", $client);
                Phalcon\Tag::setDefault("type", 1);
                echo '<h3><label class="label label-default">Usuário Tipo</label></h3>' . $this->tag->select(array(
                    'type',
                    $userType,
                    'class' => 'form-control',
                    'using' => array('id', 'name'),
                    'onchange' => 'getAdmins(null,this.value)',
                )) . '<h3><label class="label label-default">Associação Cliente</label></h3>' . $this->tag->select(array(
                    'client',
                    $userClient,
                    'class' => 'form-control',
                    'using' => array('user_id', 'user_name'),
                    'onchange' => 'getAdmins(this.value,document.getElementById("type").value)',
                )) . '<br />';
                $this->view->disable();
            }
        }
    }

    public function getsupersAction($admin) {
        if (!empty($admin)) {
            global $boardLVM;
            $users = $boardLVM->query("Select * From UsersUsers Where user_admin_id = " . $admin)->fetchAll();
            foreach ($users as $user) {
                $supers[$user['user_super_id']] = $boardLVM->query("Select user_name From Users Where user_id = " . $user['user_super_id'])->fetch()['user_name'];
            }
            if (!empty($supers)) {
                $this->view->setVar('supers', $supers);
                echo '<h3><label class="label label-default">Associação Supervisor</label></h3>' . $this->tag->select(array(
                    'super',
                    $supers,
                    'class' => 'form-control',
                    'useEmpty' => true,
                    'emptyText' => 'Selecione...',
                    'using' => array('user_id', 'user_name'),
                ));
                $this->view->disable();
            } else {
                $this->view->setVar('supers', null);
                echo '<h3><label class="label label-default">Associação Supervisor</label></h3>' . $this->tag->select(array(
                    'super',
                    $supers,
                    'class' => 'form-control',
                    'useEmpty' => true,
                    'emptyText' => 'Selecione...',
                    'using' => array('user_id', 'user_name'),
                ));
                $this->view->disable();
            }
        }
    }

    public function productsAction($userType) {
        global $boardLVM;
        $this->tag->setTitle('Permissões de Usuários com Produtos');
        $this->view->setTemplateAfter('base');
        $auth = $this->session->get('auth');
        if ($auth['type'] == 0 || $auth['type'] == 3) {
            $this->flash->error("Não têm permissão.");
            return $this->response->redirect("users/index");
        }
        $id = $auth['id'];

        if ($auth['type'] == -1 || $auth['type'] == 1) {
            $usersFound = $boardLVM->query("Select * From MastersUsers Where user_master_id = " . $id)->fetchAll();
            if (!empty($usersFound)) {
// produtos associados
                $masterProducts = $boardLVM->query("Select * From UsersProducts Where user_id = " . $id)->fetchAll();
                $counter = 0;
                if (!empty($masterProducts)) {
                    foreach ($masterProducts as $masterProduct) {
                        $products[$counter] = $boardLVM->query("Select * From Products Where product_id = " . $masterProduct['product_id'])->fetch();
                        foreach ($usersFound as $user) {
                            if (!empty($boardLVM->query("Select * From UsersProducts Where user_id = " . $user['user_user_id'] . " And product_id = " . $masterProduct['product_id'])->fetch())) {
                                $usersProducts[$counter] = array('user_id' => $boardLVM->query("Select * From UsersProducts Where user_id = " . $user['user_user_id'] . "And product_id = " . $masterProduct['product_id'])->fetch()['user_id'],
                                    'product_id' => $boardLVM->query("Select * From UsersProducts Where user_id = " . $user['user_user_id'] . "And product_id = " . $masterProduct['product_id'])->fetch()['product_id'],
                                    'product_discount' => $boardLVM->query("Select * From UsersProducts Where user_id = " . $user['user_user_id'] . "And product_id = " . $masterProduct['product_id'])->fetch()['product_discount'],
                                    'product_price_with_discount' => $boardLVM->query("Select * From UsersProducts Where user_id = " . $user['user_user_id'] . "And product_id = " . $masterProduct['product_id'])->fetch()['product_price_with_discount'],
                                    'user_name' => $boardLVM->query("Select * From Users Where user_id = " . $user['user_user_id'])->fetch()['user_name'],
                                    'product_name' => $boardLVM->query("Select * From Products Where product_id = " . $masterProduct['product_id'])->fetch()['product_name']);
                            }
                            $counter++;
                        }
                    }
                    foreach ($usersFound as $user) {
//diferenciação por usuarios tipo
                        if ($boardLVM->query("Select user_type From UsersLogin Where userLogin_id = " . $user['user_user_id'])->fetch()['user_type'] == 1) {
                            $admins[$user['user_user_id']] = $boardLVM->query("Select * From Users Where user_id = " . $user['user_user_id'])->fetch()['user_name'];
                        }
                        if ($boardLVM->query("Select user_type From UsersLogin Where userLogin_id = " . $user['user_user_id'])->fetch()['user_type'] == 2) {
                            $supers[$user['user_user_id']] = $boardLVM->query("Select * From Users Where user_id = " . $user['user_user_id'])->fetch()['user_name'];
                        }
                        if ($boardLVM->query("Select user_type From UsersLogin Where userLogin_id = " . $user['user_user_id'])->fetch()['user_type'] == 3) {
                            $usuarios[$user['user_user_id']] = $boardLVM->query("Select * From Users Where user_id = " . $user['user_user_id'])->fetch()['user_name'];
                        }
                    }

                    if ($userType == 1) {
//var_dump($userType . "" . json_encode($admins[11]));
                        (empty($admins)) ? $this->view->usersOutAssoc = null : $this->view->usersOutAssoc = $admins;
                    }
                    if ($userType == 2) {
                        (empty($supers)) ? $this->view->usersOutAssoc = null : $this->view->usersOutAssoc = $supers;
                    }
                    if ($userType == 3) {
                        (empty($usuarios)) ? $this->view->usersOutAssoc = null : $this->view->usersOutAssoc = $usuarios;
                    }
                }
            }
            if (!empty($admins) && empty($supers) && empty($usuarios)) {
                $this->view->setVar('usersType', array(1 => 'Administrador'));
                $usersType = array(1 => 'Administrador');
            }
            if (!empty($admins) && !empty($supers) && empty($usuarios)) {
                $this->view->setVar('usersType', array(1 => 'Administrador', 2 => 'Supervisor'));
                $usersType = array(1 => 'Administrador', 2 => 'Supervisor');
            }
            if (!empty($admins) && !empty($supers) && !empty($usuarios)) {
                $this->view->setVar('usersType', array(1 => 'Administrador', 2 => 'Supervisor', 3 => 'Usuário'));
                $usersType = array(1 => 'Administrador', 2 => 'Supervisor', 3 => 'Usuário');
            }
            if (empty($admins) && empty($supers) && empty($usuarios)) {
                $this->view->setVar('usersType', array(0 => 'Sem Usuarios'));
                $usersType = array(0 => 'Sem Usuarios');
            }


            if (!empty($products)) {
                $this->view->products = $products;
            } else {
                $this->view->products = null;
            }

            if (empty($usersProducts)) {
                $this->view->usersProducts = null;
            } else {
                $this->view->usersProducts = $usersProducts;
            }

            if ($requestedUser == 0) {
                Phalcon\Tag::setDefault("type", $userType);
            }
        }
    }

    public function assocAction() {
        $request = $this->request;
        if ($request->isPost()) {
            global $boardLVM;
            $produto_id = $request->getPost('product_id');
            $usuarios = $request->getPost('users');
            $produto_desconto = $request->getPost('product_discount');
            $check = $request->getPost('list');
            $status = $request->getPost('Status');
            if (empty($check)) {
                $this->response->redirect("users/products/1");
                $this->flash->error("Tem de selecionar os produtos que deseja associar.");
                $this->view->disable();
            }
            foreach ($check as $checked) {
                if ($produto_id[$checked] != null) {
                    $founddedProduto_id = $produto_id[$checked];
                    $foundedProdutoDesconto = $produto_desconto[$produto_id[$checked]];
                    if ($check[$checked] != null) {
                        $product_price = $boardLVM->query("Select product_price From Products Where product_id = " . $founddedProduto_id)->fetch();
                        $productPriceWithDiscount = $product_price['product_price'] - ($product_price['product_price'] * ($foundedProdutoDesconto / 100));
                        foreach ($usuarios as $usuario) {
                            if (empty($boardLVM->query("Select user_id from UsersProducts where user_id = " . $usuario . " and product_id = " . $founddedProduto_id)->fetch())) {
                                $last_userLogin_id = $boardLVM->insert("UsersProducts", [
                                    "user_id" => $usuario,
                                    "product_id" => $founddedProduto_id,
                                    "product_discount" => $foundedProdutoDesconto,
                                    "product_price_with_discount" => $productPriceWithDiscount,
                                    "state" => 10
                                ]);
                            }
                        }
                    }
                }
            }
            $this->response->redirect("users/products/1");
            $this->flash->success("Associação criada com sucesso.");
        }
    }

    public function editAssocAction($type, $user, $product, $discount) {
        if (empty($type)) {
            $this->response->redirect("users/products/1");
            $this->flash->error("Tem de usar uma ação para realizar alterações.");
            $this->view->disable();
        }
        global $boardLVM;
        $request = $this->request;
        if ($request->isPost()) {
            $produto_desconto = $request->getPost('product_discount');
            $check = $request->getPost('listAssocEdit');
            if ($type == 1) {
                foreach ($check as $checked) {
                    $founddedProduto_id = substr($checked, 0, strpos($checked, '-'));
                    $founddedUsuario_id = substr(strrchr($checked, "-"), 1);
                    $foundedProdutoDesconto = $produto_desconto[$checked];
                    $product_price = $boardLVM->query("Select product_price From Products Where product_id = " . $founddedProduto_id)->fetch();
                    $productPriceWithDiscount = $product_price['product_price'] - ($product_price['product_price'] * ($foundedProdutoDesconto / 100));
                    $boardLVM->query("Update UsersProducts set product_discount = " . $foundedProdutoDesconto . ", product_price_with_discount = " . $productPriceWithDiscount . " Where user_id = " . $founddedUsuario_id . " And product_id = " . $founddedProduto_id)->fetch();
                }
                $this->response->redirect("users/products/1");
                $this->flash->success("Associações editadas com sucesso.");
            }
        } else {
            if (!empty($user) && !empty($product) && $discount != null && $type == 1) {
                $productPriceWithDiscount = 0;
                $product_price = $boardLVM->query("Select product_price From Products Where product_id = " . $product)->fetch();
                if ($discount != 0) {
                    $productPriceWithDiscount = $product_price['product_price'] - ($product_price['product_price'] * ($discount / 100));
                }
                $boardLVM->query("Update UsersProducts set product_discount = " . $discount . ", product_price_with_discount = " . $productPriceWithDiscount . " Where user_id = " . $user . " And product_id = " . $product)->fetch();
                $this->response->redirect("users/products/1");
                $this->flash->success("Edição finalizada com sucesso.");
            }
        }
    }

    public function remAssocAction($type, $product, $user) {
        global $boardLVM;
        $request = $this->request;
        if ($request->isPost()) {
            $check = $request->getPost('listAssocRem');
            if (empty($check)) {
                $this->response->redirect("users/products/1");
                $this->flash->error("Erro! Tem de selecionar as associações a remover..");
            }
            foreach ($check as $checked) {
                $founddedProduto_id = substr($checked, 0, strpos($checked, '-'));
                $founddedUsuario_id = substr(strrchr($checked, "-"), 1);
                $boardLVM->query("Delete From UsersProducts Where user_id = " . $founddedUsuario_id . " And product_id = " . $founddedProduto_id)->fetch();
            }
            $this->response->redirect("users/products/1");
            $this->flash->success("Associação(ões) removida(s) com sucesso.");
        } else {
            if (!empty($user) && !empty($product) && $type == 1) {
                $boardLVM->query("Delete From UsersProducts Where user_id = " . $user . " And product_id = " . $product)->fetch();
            }
            $this->response->redirect("users/products/1");
            $this->flash->success("Associação removida com sucesso.");
        }
    }

    public function packagesAction() {
        $auth = $this->session->get('auth');
        $id = $auth['id'];
        if ($auth['type'] == -1) {
// search for clients by master
            $mastersUsers = MastersUsers::find("Master_id = $id");
            if (!empty($mastersUsers)) {
                foreach ($mastersUsers as $mastersUser) {
                    $users[$mastersUser->Usuario_id] = Users::findFirstByUsuario_id($mastersUser->Usuario_id);
                    $usersSelect[$mastersUser->Usuario_id] = Users::findFirstByUsuario_id($mastersUser->Usuario_id)->Usuario_nome;
                    $userPackages[$mastersUser->Usuario_id] = UserPackages::findFirstByUsuario_id($mastersUser->Usuario_id);
                }
                $this->view->users = $users;
                $this->view->usersSelect = $usersSelect;
                $this->view->userPackages = $userPackages;
            } else {
                $this->view->users = null;
                $this->view->usersSelect = array(0 => "Sem Clientes");
            }

//search for packages 
            $masterProducts = MastersProducts::find("Master_id = $id");
            $packages = Packages::find();
            if (!empty($masterProducts)) {
                foreach ($packages as $package) {
                    $idProduto = $package->Produto_id;
                    if (!empty(MastersProducts::findFirst("Produto_id = $idProduto And Master_id = $id"))) {
                        $packagesSelect[$package->Pacote_id] = $package->Pacote_nome;
                        $packagesByUser[$package->Pacote_id] = $package;
                    }
                }
                if (!empty($packages)) {
                    $this->view->packagesSelect = $packagesSelect;
                } else {
                    $this->view->packagesSelect = array(0 => "Sem Pacotes");
                }
            }
            if (!empty($packagesByUser)) {
                $this->view->packages = $packagesByUser;
            }
            $this->view->setVar('counter', 0);
            $userId = MastersUsers::findFirstByMaster_id($id)->Usuario_id;
            if (!empty($userId)) {
                $pacoteId = UserPackages::findFirstByUsuario_id($userId);
                if (!empty($pacoteId->Pacote_id)) {
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
            $usuario_id = $request->getPost('user');
            $pacote_id = $request->getPost('pacote');
            $status = $request->getPost('status');

            if ($status == 1) {
                $shoppingMovements = new ShoppingMovements();
                $shoppingMovements->Usuario_id = $usuario_id;
                $shoppingMovements->Pacote_id = $pacote_id;
                $shoppingMovements->Estado = 10;
                $shoppingMovements->save();
                $userPackages = new UserPackages();
                $userPackages->Usuario_id = $usuario_id;
                $userPackages->Pacote_id = $pacote_id;
                if ($userPackages->save()) {
                    $this->flash->success('O pacote foi associado com sucesso!');
                    return $this->response->redirect('users/packages');
                }
            } else if ($status == 0) {
                $foundedShop = ShoppingMovements::findFirst("Usuario_id = $usuario_id And Pacote_id = $pacote_id");
                if (!empty($foundedShop)) {
                    $foundedShop->delete();
                }
                $founded = UserPackages::findFirst("Usuario_id = $usuario_id And Pacote_id = $pacote_id");
                if ($founded->delete()) {
                    $this->flash->success('O pacote foi desassociado com sucesso!');
                    return $this->response->redirect('users/packages');
                }
            }
        }
    }

    public function newAction() {
        $this->tag->setTitle('Cadastro de Usuário');
        $auth = $this->session->get('auth');
        if ($auth['type'] == 3) {
            $this->flash->error("Permissão negada.");
            return $this->forward("users/index");
        }
    }

    public function statusAction($id, $status) {
        $usersLogin = UsersLogin::findFirstByUserLogin_Usuario_id($id);
        $usersLogin->UserLogin_active = $status;
        $usersLogin->save();
        $this->flash->success("Estado do Usuário alterado.");
        return $this->response->redirect("users/index");
    }

    public function registerAction() {
        global $boardLVM;
        global $mastersUsers;
        $request = $this->request;
        if ($request->isPost()) {

            $name = $request->getPost("Usuario_nome_contato");
            $email = $request->getPost("Usuario_email_contato");
            $telefone = $request->getPost("Usuario_telefone_contato");
            $morada = $request->getPost("Usuario_morada_contato");
            $username = $request->getPost("Usuario_login");
            $password = $request->getPost("Usuario_password");
            $repeatPassword = $request->getPost("Usuario_password_conf");
            $type = $request->getPost("type");
            $client = $request->getPost("client");
            $admin = $request->getPost("admin");
            $super = $request->getPost("super");
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
        if (empty($email)) {
            $this->flash->error('Tem de digitar o email!');
            return false;
        }

        $password = sha1($password);
        $last_userLogin_id = $boardLVM->insert("UsersLogin", [
            "username" => $username,
            "password" => $password,
            "user_active" => 0,
            "user_type" => $type
        ]);
        $last_user_id = $boardLVM->insert("Users", [
            "user_id" => $last_userLogin_id,
            "user_name" => $name,
            "user_email" => $email,
            "user_address" => Null,
            "user_phone" => $telefone,
            "user_created_at" => date('Y-m-d'),
            "user_cnpj" => Null,
            "user_razao_social" => Null,
            "user_nome_fantasia" => Null
        ]);

//Associações
        $auth = $this->session->get('auth');
        if ($auth['type'] == -1) {
            $last_user_id = $boardLVM->insert("MastersUsers", [
                "user_user_id" => $last_userLogin_id,
                "user_master_id" => $auth['id'],
            ]);
            $last_user_id = $boardLVM->insert("ClientsUsers", [
                "user_user_id" => $last_userLogin_id,
                "user_client_id" => $client,
            ]);

            if ($type == 1) {
                $last_user_id = $boardLVM->insert("UsersUsers", [
                    "user_admin_id" => $last_userLogin_id,
                    "user_super_id" => 0,
                    "user_user_id" => 0
                ]);
            }
            if ($type == 2) {
                $foundedAdmin = $boardLVM->query("Select top 1 user_admin_id From UsersUsers Where user_admin_id = " . $admin)->fetch();
                if (!empty($foundedAdmin)) {
                    if (empty($foundedAdmin['user_super_id'])) {
                        $last_user_id = $boardLVM->update("UsersUsers", [
                            "user_super_id" => $last_userLogin_id,
                            "user_user_id" => 0
                                ], [
                            "user_admin_id" => $foundedAdmin['user_admin_id']
                        ]);
                    } else {
                        $last_user_id = $boardLVM->insert("UsersUsers", [
                            "user_admin_id" => $admin,
                            "user_super_id" => $super,
                            "user_user_id" => 0
                        ]);
                    }
                }
            }
            if ($type == 3) {
                $foundedSuper = $boardLVM->query("Select top 1 user_super_id From UsersUsers Where user_super_id = " . $super)->fetch();
                if (!empty($foundedSuper)) {
                    if (empty($foundedSuper['user_user_ids'])) {
                        $last_user_id = $boardLVM->update("UsersUsers", [
                            "user_user_id" => $last_userLogin_id
                                ], [
                            "user_super_id" => $super
                        ]);
                    } else {
                        $last_user_id = $boardLVM->insert("UsersUsers", [
                            "user_admin_id" => $admin,
                            "user_super_id" => $super,
                            "user_user_id" => $last_userLogin_id
                        ]);
                    }
                }
            }
        }
        if ($auth['type'] == 0) {
            $usersClient['user_client_id'] = $auth['id'];
            $usersClient['user_user_id'] = $last_userLogin_id;
            if ($type == 1) {
                $last_user_id = $boardLVM->insert("UsersUsers", [
                    "user_admin_id" => $last_userLogin_id,
                    "user_super_id" => 0,
                    "user_user_id" => 0
                ]);
            }
            if ($type == 2) {
                $foundedAdmin = $boardLVM->query("Select top 1 user_admin_id From UsersUsers Where user_admin_id = " . $admin)->fetch();
                if (!empty($foundedAdmin)) {
                    if (empty($foundedAdmin['user_super_id'])) {
                        $last_user_id = $boardLVM->update("UsersUsers", [
                            "user_super_id" => $last_userLogin_id,
                            "user_user_id" => 0
                                ], [
                            "user_admin_id" => $foundedAdmin['user_admin_id']
                        ]);
                    } else {
                        $last_user_id = $boardLVM->insert("UsersUsers", [
                            "user_admin_id" => $admin,
                            "user_super_id" => $super,
                            "user_user_id" => 0
                        ]);
                    }
                }
            }
            if ($type == 3) {
                $foundedSuper = $boardLVM->query("Select top 1 user_super_id From UsersUsers Where user_super_id = " . $super)->fetch();
                if (!empty($foundedSuper)) {
                    if (empty($foundedSuper['user_user_id'])) {
                        $last_user_id = $boardLVM->update("UsersUsers", [
                            "user_user_id" => $last_userLogin_id
                                ], [
                            "user_super_id" => $super
                        ]);
                    } else {
                        $last_user_id = $boardLVM->insert("UsersUsers", [
                            "user_admin_id" => $admin,
                            "user_super_id" => $super,
                            "user_user_id" => $last_userLogin_id
                        ]);
                    }
                }
            }
        }
        if ($auth['type'] == 1) {
            $clienteId = $boardLVM->query("Select top 1 * From ClientsUsers Where user_client_id = " . $client)->fetch();
            $usersClient['user_client_id'] = $clienteId['user_client_id'];
            $usersClient['user_user_id'] = $auth['id'];
            if ($type == 2) {
                $foundedAdmin = $boardLVM->query("Select top 1 user_admin_id From UsersUsers Where user_admin_id = " . $admin)->fetch();
                if (!empty($foundedAdmin)) {
                    if (empty($foundedAdmin['user_super_id'])) {
                        $last_user_id = $boardLVM->update("UsersUsers", [
                            "user_super_id" => $last_userLogin_id,
                            "user_user_id" => 0
                                ], [
                            "user_admin_id" => $auth['id']
                        ]);
                    } else {
                        $last_user_id = $boardLVM->insert("UsersUsers", [
                            "user_admin_id" => $auth['id'],
                            "user_super_id" => $super,
                            "user_user_id" => 0
                        ]);
                    }
                }
            }
            if ($type == 3) {
                $foundedSuper = $boardLVM->query("Select top 1 user_super_id From UsersUsers Where user_super_id = " . $super)->fetch();
                if (!empty($foundedSuper)) {
                    if (empty($foundedSuper['user_user_id'])) {
                        $last_user_id = $boardLVM->update("UsersUsers", [
                            "user_user_id" => $last_userLogin_id
                                ], [
                            "user_super_id" => $super
                        ]);
                    } else {
                        $last_user_id = $boardLVM->insert("UsersUsers", [
                            "user_admin_id" => $auth['id'],
                            "user_super_id" => $super,
                            "user_user_id" => $last_userLogin_id
                        ]);
                    }
                }
            }
        }
        if ($auth['type'] == 2) {
            if ($type == 2) {
                $foundedAdmin = $boardLVM->query("Select top 1 user_admin_id From UsersUsers Where user_admin_id = " . $admin)->fetch();
                if (!empty($foundedAdmin)) {
                    if (empty($foundedAdmin['user_super_id'])) {
                        $last_user_id = $boardLVM->update("UsersUsers", [
                            "user_super_id" => $last_userLogin_id,
                            "user_user_id" => 0
                                ], [
                            "user_admin_id" => $auth['id']
                        ]);
                    } else {
                        $last_user_id = $boardLVM->insert("UsersUsers", [
                            "user_admin_id" => $admin,
                            "user_super_id" => $auth['id'],
                            "user_user_id" => 0
                        ]);
                    }
                }
            }
            if ($type == 3) {
                $foundedSuper = $boardLVM->query("Select top 1 user_super_id From UsersUsers Where user_super_id = " . $super)->fetch();
                if (!empty($foundedSuper)) {
                    if (empty($foundedSuper['user_user_id'])) {
                        $last_user_id = $boardLVM->update("UsersUsers", [
                            "user_user_id" => $last_userLogin_id
                                ], [
                            "user_super_id" => $auth['id']
                        ]);
                    } else {
                        $last_user_id = $boardLVM->insert("UsersUsers", [
                            "user_admin_id" => $admin,
                            "user_super_id" => $auth['id'],
                            "user_user_id" => $last_userLogin_id
                        ]);
                    }
                }
            }
        }
        if (!empty($usersClient)) {
            $last_user_id = $boardLVM->insert("ClientsUsers", [
                "user_client_id" => $usersClient['user_client_id'],
                "user_user_id" => $usersClient['user_user_id'],
            ]);
        } else {
            $last_user_id = $boardLVM->insert("ClientsUsers", [
                "user_client_id" => $client,
                "user_user_id" => $last_userLogin_id,
            ]);
        }
        $clientUserID = $boardLVM->query("Select top 1 user_client_id From ClientsUsers Where user_user_id = " . $last_userLogin_id)->fetch()['user_client_id'];
        $fiscalAddressID = $boardLVM->query("Select fiscal_address_id From UsersFiscalAddress Where user_id = " . $clientUserID)->fetch()['fiscal_address_id'];
        $deliverAddressID = $boardLVM->query("Select deliver_address_id From UsersDeliverAddress Where user_id = " . $clientUserID)->fetch()['deliver_address_id'];

        $last_user_fiscal_address_id = $boardLVM->insert("UsersFiscalAddress", [
            "user_id" => $last_userLogin_id,
            "fiscal_address_id" => $fiscalAddressID
        ]);

        $last_user_deliver_address_id = $boardLVM->insert("UsersDeliverAddress", [
            "user_id" => $last_userLogin_id,
            "deliver_address_id" => $deliverAddressID
        ]);

        if (empty($last_userLogin_id)) {
            $this->flash->error("Erro!! Ocorreu um erro ao criar usuário $name");
            Tag::setDefault('Cliente_email', '');
            Tag::setDefault('Cliente_password', '');
        } else {
            $this->flash->success("Usuario $name cadastrado com sucesso!");
            return $this->response->redirect('users/index');
        }
    }

    public function shoppingAction() {
        $user = Users::findFirstByUsuario_id($id);
        $shoppingMovements = ShoppingMovements::find("Usuario_id = $id");
        echo "<table class='table col-lg-5'><thead><tr><th>Id do Cliente</th><th>Nome do Cliente</th><th>Valor</th><th>Estado</th><th>Comprar?</th></tr></thead><tbody>";
        if (!empty($client)) {
            if (!empty($shoppingMovements)) {
                foreach ($shoppingMovements as $shoppingMovement) {
                    $pacoteId = $shoppingMovement->Pacote_id;
                    $package = Packages::findFirst("Pacote_id = $pacoteId");
                    if ($package->Pacote_status == 1) {
                        echo "<tr><td>" . $user->Usuario_id . "</td><td>" . $user->Usuario_nome . "</td><td>" . $package->Pacote_preco . "</td><td>";
                        if ($shoppingMovement->Estado == 10) {
                            echo "Em espera";
                        }
                        if ($shoppingMovement->Estado == 20) {
                            echo "Pendente";
                        }
                        if ($shoppingMovement->Estado == 30) {
                            echo "Liberado";
                        }
                        echo "</td><td>";
                        echo ($shoppingMovement->Estado == 10) ? Phalcon\Tag::linkTo(array('bilhetagem/buyPackage/' . $user->Usuario_id . '/' . $package->Pacote_id, 'Comprar')) : '';
                        echo "</td></tr>";
                    }
                }
            }
        }
        echo "</tbody></table>";
    }

}
