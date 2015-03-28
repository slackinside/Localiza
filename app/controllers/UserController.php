<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require __DIR__ . '/../../app/config/db_medoo.php';

class UserController extends ControllerBase {

    public function initialize() {
        $this->view->setTemplateAfter('base');
        $this->tag->setTitle('Inicio');
        $auth = $this->session->get('authl');
        $this->view->setVar('name', $auth['name']);
        $this->view->setVar("enderecos", null);
        parent::initialize();
    }

    public function indexAction() {
        
    }

    public function searchAction() {
        global $repConsultaPf;
        global $repConsultaPj;
        $request = $this->request;
        if ($request->isPost()) {

            $cnpj_cpf = $request->getPost('busca');
            $this->view->cnpj_cpf = $cnpj_cpf;
            if (strpos($cnpj_cpf, '0001') !== false || strpos($cnpj_cpf, '0002' !== false)) {
                $this->view->cnpjSearch = 1;
                $empresaBR = $repConsultaPj->query("Select top 1 * From EMPRESAS_BR Where CNPJ = '" . $cnpj_cpf."'")->fetch();
                if (!empty($empresaBR)) {
                    $this->view->empresaBR = $empresaBR;
                } else {
                    $this->view->empresaBR = null;
                }
                $enderecos = $repConsultaPj->query("Select * From ENDERECOS Where CNPJ = '" . $cnpj_cpf."'")->fetchAll();
                if (!empty($enderecos)) {
                    $this->view->enderecos = $enderecos;
                } else {
                    $this->view->enderecos = null;
                }
                $emails = $repConsultaPj->query("Select * From EMAILS Where CNPJ = '" . $cnpj_cpf."'")->fetchAll();
                if (!empty($emails)) {
                    $this->view->emails = $emails;
                } else {
                    $this->view->emails = null;
                }
                $telefones = $repConsultaPj->query("Select * From TELEFONES Where CNPJ = '" . $cnpj_cpf."'")->fetchAll();
                if (!empty($telefones)) {
                    $this->view->telefones = $telefones;
                } else {
                    $this->view->telefones = null;
                }
                $qsa = $repConsultaPj->query("Select * From QSA Where cnpj = '" . $cnpj_cpf."'")->fetchAll();
                if (!empty($qsa)) {
                    $this->view->qsas = $qsa;
                } else {
                    $this->view->qsas = null;
                }
            } else {
                $this->view->cnpjSearch = 0;
                $tronco = $repConsultaPf->query("Select * From TRONCO Where CPF = '" . $cnpj_cpf."'")->fetch();
                $maeCPF = $tronco['NOME_MAE'];
                if (!empty($tronco)) {
                    $this->view->tronco = $tronco;
                    if ($tronco['MESNASC'] == 1 && $tronco['DIANASC'] > 20 || $tronco['MESNASC'] == 2 && $tronco['DIANASC'] < 19) {
                        $signo = "Aquario";
                    } else if ($tronco['MESNASC'] == 2 && $tronco['DIANASC'] > 18 || $tronco['MESNASC'] == 3 && $tronco['DIANASC'] < 20) {

                        $signo = "Peixes";
                    } else if ($tronco['MESNASC'] == 3 && $tronco['DIANASC'] > 19 || $tronco['MESNASC'] == 4 && $tronco['DIANASC'] < 21) {

                        $signo = "Áries";
                    } else if ($tronco['MESNASC'] == 4 && $tronco['DIANASC'] > 20 || $tronco['MESNASC'] == 5 && $tronco['DIANASC'] < 21) {

                        $signo = "Touro";
                    } else if ($tronco['MESNASC'] == 5 && $tronco['DIANASC'] > 20 || $tronco['MESNASC'] == 6 && $tronco['DIANASC'] < 21) {

                        $signo = "Gêmeos";
                    } else if ($tronco['MESNASC'] == 6 && $tronco['DIANASC'] > 20 || $tronco['MESNASC'] == 7 && $tronco['DIANASC'] < 22) {

                        $signo = "Câncer";
                    } else if ($tronco['MESNASC'] == 7 && $tronco['DIANASC'] > 21 || $tronco['MESNASC'] == 8 && $tronco['DIANASC'] < 23) {

                        $signo = "Leão";
                    } else if ($tronco['MESNASC'] == 8 && $tronco['DIANASC'] > 22 || $tronco['MESNASC'] == 9 && $tronco['DIANASC'] < 23) {

                        $signo = "Virgem";
                    } else if ($tronco['MESNASC'] == 9 && $tronco['DIANASC'] > 22 || $tronco['MESNASC'] == 10 && $tronco['DIANASC'] < 23) {

                        $signo = "Libra";
                    } else if ($tronco['MESNASC'] == 10 && $tronco['DIANASC'] > 22 || $tronco['MESNASC'] == 11 && $tronco['DIANASC'] < 22) {

                        $signo = "Escorpião";
                    } else if ($tronco['MESNASC'] == 11 && $tronco['DIANASC'] > 21 || $tronco['MESNASC'] == 12 && $tronco['DIANASC'] < 22) {

                        $signo = "Sagitário";
                    } else if ($tronco['MESNASC'] == 12 && $tronco['DIANASC'] > 21 || $tronco['MESNASC'] == 1 && $tronco['DIANASC'] < 22) {

                        $signo = "Capricórnio";
                    } else {

                        $signo = "Não existe";
                    }
                    $this->view->signo = $signo;
                } else {
                    $this->view->tronco = null;
                }
                $troncoRel = $repConsultaPf->query("Select * From TRONCO Where NOME_MAE = '" . $maeCPF . "'")->fetchAll();
                if (!empty($troncoRel)) {
                    $this->view->troncoRels = $troncoRel;
                } else {
                    $this->view->troncoRels = null;
                }
                //$qsaCPF = $repConsultaPf->query("Select * From QSA Where DOCUMENTO_SOCIO = '" . $cnpj_cpf."'")->fetchAll();
                if (!empty($qsaCPF)) {
                    $this->view->qsaCPFs = $qsaCPF;
                } else {
                    $this->view->qsaCPFs = null;
                }
                $emails = $repConsultaPf->query("Select * From EMAILS Where CPF = '" . $cnpj_cpf."'")->fetchAll();
                if (!empty($emails)) {
                    $this->view->emails = $emails;
                } else {
                    $this->view->emails = null;
                }
                $telefones = $repConsultaPf->query("Select * From TELEFONES Where CPF = '" . $cnpj_cpf."'")->fetchAll();
                if (!empty($telefones)) {
                    $this->view->telefones = $telefones;
                } else {
                    $this->view->telefones = null;
                }
                //$obitos = $repConsultaPf->query("Select * From Obito Where cpf = '" . $cnpj_cpf."'")->fetchAll();
                if (!empty($obitos)) {
                    $this->view->obitos = $obitos;
                } else {
                    $this->view->obitos = null;
                }
            }
        }
    }

}
