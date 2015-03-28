<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Phalcon\Tag;
use Phalcon\Mvc\Model\Criteria;

include __DIR__ . '/../../app/config/db_medoo.php';

require_once __DIR__ . '/../../app/config/PHPMailerAutoload.php';

class BilhetagemController extends ControllerBase {

    public function initialize() {
        $this->view->setTemplateAfter('base');
        $this->tag->setTitle('Bilhetagem');
        $auth = $this->session->get('auth');
        $this->view->setVar('name', $auth['name']);
        parent::initialize();
    }

    public function indexAction() {
        $auth = $this->session->get('auth');
        if ($auth['type'] != -1) {
            $this->flash->error("Erro!! Apenas o Master tem permissão.");
            return $this->forward("index/index");
        }
    }

    public function generateAction() {
        $auth = $this->session->get('auth');
        $id = $auth['id'];
        if ($auth['type'] == -1) {
            global $boardLVM;
            $mastersClients = $boardLVM->query("Select * From MastersClients Where user_master_id = " . $id)->fetchAll();
            $mastersUsers = $boardLVM->query("Select * From MastersUsers Where user_master_id = " . $id)->fetchAll();
            $counter = 0;
            echo "<table class='table col-lg-5'><thead><tr><th>Nome do Cliente/Usuario</th><th>Nome Produto</th><th>Valor</th><th>Estado</th><th>Liberar</th></tr></thead><tbody>";
            if (!empty($mastersClients)) {
                foreach ($mastersClients as $mastersClient) {
                    $idClient = $mastersClient['user_client_id'];
                    $shoppingMovementsClients = $boardLVM->query("Select * From UsersProducts Where user_id = " . $idClient)->fetchAll();
                    if (!empty($shoppingMovementsClients)) {
                        foreach ($shoppingMovementsClients as $shoppingMovementsClient) {
                            $users = $boardLVM->query("Select * From UsersLogin Where userLogin_id = " . $shoppingMovementsClient['user_id'])->fetch();
                            $products = $boardLVM->query("Select * From Products Where product_id =" . $shoppingMovementsClient['product_id'])->fetch();
                            echo "</td><td>" . $users['username'];
                            echo "</td><td>" . $products['product_name'];
                            echo "</td><td>" . $shoppingMovementsClient['product_price_with_discount'];
                            echo "</td><td>";
                            if ($shoppingMovementsClient['state'] == 10) {
                                echo "Aguardar Pedido";
                            } else if ($shoppingMovementsClient['state'] == 20) {
                                echo "Pendente";
                            } else {
                                echo "Liberado";
                            }
                            echo "</td><td>";
                            if ($shoppingMovementsClient['state'] == 10) {
                                echo "Aguardar Pedido";
                            } else if ($shoppingMovementsClient['state'] == 20) {
                                echo Phalcon\Tag::linkTo(array('bilhetagem/packageFree/' . $shoppingMovementsClient['user_id'] . '/' . $products['product_id'], 'Liberar'));
                            } else {
                                echo '--';
                            }
                            echo "</td></tr>";
                        }
                    }
                }
            }
            if (!empty($mastersUsers)) {
                foreach ($mastersUsers as $mastersUser) {
                    $idUser = $mastersUser['user_user_id'];
                    $shoppingMovementsUsers = $boardLVM->query("Select * From UsersProducts Where user_id = " . $idUser)->fetchAll();
                    if (!empty($shoppingMovementsUsers)) {
                        foreach ($shoppingMovementsUsers as $shoppingMovementsUser) {
                            $users = $boardLVM->query("Select * From UsersLogin Where userLogin_id = " . $shoppingMovementsUser['user_id'])->fetch();
                            $products = $boardLVM->query("Select * From Products Where product_id =" . $shoppingMovementsUser['product_id'])->fetch();
                            echo "</td><td>" . $users['username'];
                            echo "</td><td>" . $products['product_name'];
                            echo "</td><td>" . $shoppingMovementsUser['product_price_with_discount'];
                            echo "</td><td>";
                            if ($shoppingMovementsUser['state'] == 10) {
                                echo "Aguardar Pedido";
                            } else if ($shoppingMovementsUser['state'] == 20) {
                                echo "Pendente";
                            } else {
                                echo "Liberado";
                            }
                            echo "</td><td>";
                            if ($shoppingMovementsUser['state'] == 10) {
                                echo "Aguardar Pedido";
                            } else if ($shoppingMovementsUser['state'] == 20) {
                                echo Phalcon\Tag::linkTo(array('bilhetagem/packageFree/' . $userId . '/' . $products['product_id'], 'Liberar'));
                            } else {
                                echo '--';
                            }
                            echo "</td></tr>";
                        }
                    }
                }
            }
            echo "</tbody></table>";
        }
        $this->view->disable();
    }

    public function invoiceAction() {
        
    }

    public function buyPackageAction($usuario_id, $product_id) {
        if (!empty($usuario_id) && !empty($product_id)) {
            global $boardLVM;
            if ($boardLVM->query("Update UsersProducts set state = 20 Where user_id = " . $usuario_id . " And product_id = " . $product_id)->fetch()) {
                
            }

            function sendMail($product, $email, $attachment) {

                $mail = new PHPMailer;

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.azix.com.br';                     // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'suporte@azix.com.br';   // SMTP username
                $mail->Password = 'Az2014@suporte';                           // SMTP password
                //$mail->SMTPSecure = 'ssl';                            // Enable encryption, only 'tls' is accepted
                $mail->Port = 587;
                $mail->From = 'suporte@azix.com.br';
                $mail->FromName = 'Info Azix';
                $mail->addAddress($email);                 // Add a recipient
                
                $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
                $mail->AddAttachment($attachment);
                $mail->Subject = 'Boleto referente a ' . $product;
                $mail->Body = 'Segue em anexo o boleto referente ao pagamento do produto '. $product;
                
                if (!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                   return true;
                }
                return false;
            }

            //$this->flash->success('O seu pedido foi submetido com successo! Após pagamento o produto será liberado.');
            //return $this->response->redirect('index');
            $user = $boardLVM->query("Select * From Users Where user_id = " . $usuario_id)->fetch();
            $userFiscalAddress = $boardLVM->query("Select * From UsersFiscalAddress ufa Left Join FiscalAddress fa On fa.fiscal_address_id=ufa.fiscal_address_id And ufa.user_id = " . $usuario_id)->fetch();
            $userProduct = $boardLVM->query("Select * From UsersProducts Where user_id = " . $usuario_id . " And product_id = " . $product_id)->fetch();
            $product = $boardLVM->query("Select * From Products Where product_id = " . $product_id)->fetch();
            // DADOS DO BOLETO PARA O SEU CLIENTE
            $dias_de_prazo_para_pagamento = 5;
            $taxa_boleto = 2.95;
            $data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
            $valor_cobrado = $userProduct['product_price_with_discount']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
            $valor_cobrado = str_replace(",", ".", $valor_cobrado);
            $valor_boleto = number_format($valor_cobrado + $taxa_boleto, 2, ',', '');

            $dadosboleto["nosso_numero"] = '12345678';  // Nosso numero - REGRA: Mï¿½ximo de 8 caracteres!
            $dadosboleto["numero_documento"] = '0123'; // Num do pedido ou nosso numero
            $dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
            $dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissï¿½o do Boleto
            $dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
            $dadosboleto["valor_boleto"] = $valor_boleto;  // Valor do Boleto - REGRA: Com vï¿½rgula e sempre com duas casas depois da virgula
            // DADOS DO SEU CLIENTE
            $dadosboleto["sacado"] = $user['user_name'];
            $dadosboleto["endereco1"] = $userFiscalAddress['fiscal_address_av_rua'] . ", " . $userFiscalAddress['fiscal_address_num'];
            $dadosboleto["endereco2"] = $userFiscalAddress['fiscal_address_cidade'] . " - " . $userFiscalAddress['fiscal_address_bairro'] . " - " . $userFiscalAddress['fiscal_address_cep'];

            // INFORMACOES PARA O CLIENTE
            $dadosboleto["demonstrativo1"] = "Pagamento de Compra na loja online GRIPOM";
            $dadosboleto["demonstrativo2"] = "Compra referente a " . $product['product_name'] . "<br>Taxa bancária - R$ " . number_format($taxa_boleto, 2, ',', '');
            $dadosboleto["demonstrativo3"] = "GRIPOM TECNOLOGIA WEB LTDA ME - https://gripom.com.br/";
            $dadosboleto["instrucoes1"] = "- Sr. Caixa, cobrar multa de 2% após o vencimento";
            $dadosboleto["instrucoes2"] = "- Receber até 10 dias após o vencimento";
            $dadosboleto["instrucoes3"] = "- Em caso de dívidas entre em contato conosco: financeiro@gripom.com.br";
            $dadosboleto["instrucoes4"] = "&nbsp; Emitido pelo sistema de boletos GRIPOM";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
            $dadosboleto["quantidade"] = "1";
            $dadosboleto["valor_unitario"] = $product['product_price'];
            $dadosboleto["aceite"] = "";
            $dadosboleto["especie"] = "R$";
            $dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURAï¿½ï¿½O DO SEU BOLETO --------------- //
// DADOS DA SUA CONTA - ITAï¿½
            $dadosboleto["agencia"] = "2186"; // Num da agencia, sem digito
            $dadosboleto["conta"] = "0020934"; // Num da conta, sem digito
            $dadosboleto["conta_dv"] = "4";  // Digito do Num da conta
// DADOS PERSONALIZADOS - ITAï¿½
            $dadosboleto["carteira"] = "102";  // Cï¿½digo da Carteira: pode ser 175, 174, 104, 109, 178, ou 157
            // SEUS DADOS
            $dadosboleto["identificacao"] = "GRIPOM TECNOLOGIA WEB LTDA ME";
            $dadosboleto["cpf_cnpj"] = "104.841.60002-94";
            $dadosboleto["endereco"] = "Rua Laranjeiras, 655 â Centro - Aracaju";
            $dadosboleto["cidade_uf"] = "Aracaju / Sergipe";
            $dadosboleto["cedente"] = "466996";

            // Nï¿½O ALTERAR!
            include(__DIR__ . '/../../app/library/Boleto/include/funcoes_itau.php');
            include(__DIR__ . '/../../app/library/Boleto/include/layout_itau.php');

            $content = ob_get_clean();
            
            // convert
            require_once(__DIR__ . '/../../app/library/Html2Pdf/html2pdf.class.php');
            try {
                $html2pdf = new HTML2PDF('P', 'A4', 'pt', true, 'UTF-8', array(15, 5, 15, 5));
                /* Abre a tela de impressão */
                //$html2pdf->pdf->IncludeJS("print(true);");

                
                $html2pdf->pdf->SetDisplayMode('real');

                /* Parametro vuehtml = true desabilita o pdf para desenvolvimento do layout */
                $html2pdf->writeHTML($content, isset($_GET['vuehtml']));

                
                /* Abrir no navegador */
                //echo "<script type='text/javascript'>window.open( '".$html2pdf->writeHTML($content, isset($_GET['vuehtml']))."' )</script>";
                $html2pdf->Output('boleto - ' . $product['product_name'] . '.pdf', 'clients/products');

                /* Salva o PDF no servidor para enviar por email */
                $html2pdf->Output(__DIR__ . '/../../app/library/Boleto/Users/boleto-' . $product['product_name'] . '-' . $user['user_id'] . '-' . $product['product_id'] . '.pdf', 'F');
                sendMail($product['product_name'], $user['user_email'], __DIR__ . '/../../app/library/Boleto/Users/boleto-' . $product['product_name'] . '-' . $user['user_id'] . '-' . $product['product_id'] . '.pdf');
                /* Força o download no browser */
                $html2pdf->Output('boleto.pdf', 'D');
                
            } catch (HTML2PDF_exception $e) {
                echo $e;
                exit;
            }
            $this->flash->success('Sucesso! Terá de proceder ao pagamento para liberação do produto '.$product['product_name']);
            $this->response->redirect('clients/shopping');
        }
    }

    public function packageFreeAction($usuario_id, $product_id) {
        global $boardLVM;
        if ($auth['type'] != -1) {
            $this->flash->error("Erro!! Apenas o Master tem permissão.");
            return $this->forward("index/index");
        }
        if ($boardLVM->query("Update Invoices set state = 30 Where user_id = " . $usuario_id . " And product_id = " . $product_id)->fetch()) {
            $this->flash->success('A Liberação foi processada com sucesso!');
            return $this->response->redirect('bilhetagem/index');
        }
    }

}
