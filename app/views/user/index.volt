﻿<div>
	<div id="topoLocado">
    	<div class="largura">
        	<div id="logoLogado">
            	<a href="#"><img src="../img/logoLogado.gif" /></a>
            </div>
            <div id="logadoMenu">
                <nav>
                    <ul>
                        <li id="btAlertas"><a href="#">Alertas</a></li>
                        <li id="btCreditos"><a href="#">Créditos</a></li>
                        <li id="btRelatorios"><a href="#">Relatórios</a></li>
                    </ul>
                </nav>
            </div>
            
            <div>
            
            <div id="btLogado">
            	<a id="btMaior" class="btMaiorNormal" onClick="toggle_Logado('TopoSair')" href="javascript:void(0)"><span>{{ name }}</span></a>
                            <div id="TopoSair">
                            	<p>
                                	Cliente: AZIX
									<br />
                                    Perfil: Usuário Supervisão
									<br />
                                    IP: 189.30.2.6
                                    <br />
                                </p>
                                {{ link_to('session/end', ' Sair', 'id': 'btsairSair', 'class': 'fa fa-sign-out') }}
                                
                            </div>

            </div>
            </div>
        </div>
    </div>
    
    <div id="buscaSimples">
        {{ flash.output() }}
    	<div  class="largura">
        	<div id="btOpcoes">
            	<a id="escolhaOp" class="escolhaOpNorm">CPF/CNPJ</a>
           </div>

            <div id="formBuscaSimples">
            	{{ form('user/search', 'class': 'form-inline') }}
                	<input id="busca" name="busca" value="Digite o número do CNPJ ou CPF" onblur="if(this.value=='') this.value='Digite o número do CNPJ ou CPF';" onfocus="if(this.value=='Digite o número do CNPJ ou CPF') this.value='';" />
                    
                    <button>Buscar</button>
                
                </form>
            </div>
            
            <a id="opcoesAvancadas" href="#">+ Opções avançadas</a>
        </div>
    </div>
    
    
    
    <div class="limpar"></div>
    
    <div id="buscaAvancada" class="esconde">
    	<div class="largura">
        	<h3>Opções avançadas</h3>
            
            <div class="limpar"></div>
            
            <div id="menuBuscaAvancada">
            	<ul>
                	<li id="porNome" class="pornomeS"><a  href="javascript:void(0);"  onClick="menuacancado('porNome')">Por nome</a></li>
                	<li id="porTelefone" class="porteS"><a  href="javascript:void(0);"  onClick="menuacancado('porTelefone')">Por telefone</a></li>
                	<li id="porCep" class="porCepS"><a  href="javascript:void(0);"  onClick="menuacancado('porCep')">Por CEP</a></li>
                	<li id="porEnd" class="porEndS"><a  href="javascript:void(0);"  onClick="menuacancado('porEnd')">Por endereço</a></li>
                	<li id="porInss" class="porbeneS"><a  href="javascript:void(0);"  onClick="menuacancado('porInss')">Por benefício INSS</a></li>
                </ul>
            </div>
            <div class="limpar"></div>
            <div id="forBuscaAvancada">
				<div id="buscaNomeCont" class="conteudosteste esconde">
					<form>
                    	
                        <div id="buscaNomeContEsq">
                        	<div><label for="iptNome">Nome: </label><span class="busAvGrand" ><input id="iptNome" name="" type="text" /></span></div>
                        	<div><label for="iptCidade">Cidade:</label><span class="busAvGrand" ><input id="iptCidade" name="" type="text" /></span></div>
                        </div>
                        
                        <div id="buscaNomeContDir" >
                        	<div><label for="iptBairro">Bairro:</label><span class="busAvGrand" ><input id="iptBairro" class="busAvGrand" name="" type="text" /></span></div>
                        	<div><label for="iptUF">UF:</label><span class="busAvpeq" ><input id="iptUF"  name="" type="text" /></span> <button>Buscar</button></div>
                        </div>
                    
                    </form>
					<div class="limpar"></div>
                </div>

				<div id="buscatelCont" class="conteudosteste esconde">
					<form>
                    	<div id="buscatelContDDD"><label>DDD:</label><span><input name="" type="text"  /></span></div>
                        <div id="buscatelContTel"><label>Telefone:</label><span><input name="" type="text"  /></span> <button>Buscar</button></div>
                    </form>
                    
                    
                    <div class="limpar"></div>
                    
                </div>
				
                <div id="buscacepCont" class="conteudosteste esconde">
					<form>
                        <div id="buscacepContCep"><label>CEP:</label><span><input name="" type="text"  /></span> <button>Buscar</button></div>
                    </form>
                    
                    
                    <div class="limpar"></div>
                    
                </div>
                <div id="buscaendCont" class="conteudosteste esconde">
					<form>
                    	
                        <div id="buscaendContEsq">
                        	<div><label style="width:70px;" for="iptNome">Logradouro: </label><span class="busAvGrand" ><input id="iptNome" name="" type="text" /></span></div>
                        	<div><label style="width:70px;" for="iptCidade">Cidade:</label><span class="busAvGrand" ><input id="iptCidade" name="" type="text" /></span></div>
                        </div>
                        
                        <div id="buscaendContDir" >
                        	<div><label for="iptUF">N:</label><span class="busAvpeq" ><input id="iptUF"  name="" type="text" /></span><label style="margin-left:10px;" for="iptBairro">Bairro:</label><span class="busAvGrand"  ><input id="iptBairro" class="busAvGrand" name="" type="text" /></span></div>
                        	<div><label for="iptUF">UF:</label><span class="busAvpeq" ><input id="iptUF"  name="" type="text" /></span> <button>Buscar</button></div>
                        </div>
                    
                    </form>
					<div class="limpar"></div>
                </div>
                <div id="buscainssCont" class="conteudosteste esconde">
					<form>
                        <div id="buscacepContCep"><label>Número do Benefício:</label><span><input name="" type="text"  /></span> <button>Buscar</button></div>
                    </form>
                    
                </div>

            </div>
        </div>  
    </div>
    
    <div id="divbtFechaBusca" class="largura esconde" >
        <div class="limpar"></div>
        <a id="btFechaBusca" class="esconde" href="#">x Opções avançadas</a>
    </div>
    
    
    <div class="limpar"></div>
    
    
    <div id="BuscaCentro" class="largura">
    	<div id="menuPf_PJdiv">
            <ul id="menuPf_PJ">
                <li id="OpPessFis" class="OpPessFis">
                    <a href="javascript:void(0);" onClick="tipoPessoa('OpPessFis')">Pessoa Física</a>
                </li>
                <li id="OpPessJur" class="OpPessJur">
                    <a href="javascript:void(0);" onClick="tipoPessoa('OpPessJur')">Pessoa Jurídica</a>
                </li>
            </ul>
            
            <div id="SitaPF_PJ">&nbsp;</div>
            
        </div>
        <div class="limpar"></div>
        <div id="conteudoBusca">
        	<div id="buscaMnuOp">
            	<ul id="testeli">
                	<li id="mLocalizacao" class="menuAtivoL pessoaJur"><a href="javascript:void(0);"  onClick="mostraConteudo('mLocalizacao')">Localização</a></li>
                	<li id="mEmails" class="menuSimples"><a href="javascript:void(0);"  onClick="mostraConteudo('mEmails')">Emails</a></li>
                	<li id="mTelefones" class="menuSimples"><a href="javascript:void(0);"  onClick="mostraConteudo('mTelefones')">Telefones</a></li>
                	<li id="mObto" class="menuSimples pessoaFisica"><a onClick="mostraConteudo('mObto')" href="javascript:void(0);">Óbito</a></li>
                	<li id="mPerSoc" class="menuSimples"><a href="javascript:void(0);" onClick="mostraConteudo('mPerSoc')">Perfil Sociodemográfico</a></li>
                	<li id="mPerCons" class="menuSimples pessoaFisica"><a href="javascript:void(0);" onClick="mostraConteudo('mPerCons')">Perfil de consumo</a></li>
                	<li id="mCont" class="menuSimples"><a href="javascript:void(0);" onClick="mostraConteudo('mCont')">Contatos ruins</a></li>
                	<li id="mCcf" class="menuSimples"><a href="javascript:void(0);" onClick="mostraConteudo('mCcf')">CCF (Consulta de cheques)</a></li>
                	<li id="mPess" class="menuSimples pessoaFisica"><a href="javascript:void(0);" onClick="mostraConteudo('mPess')">Pessoas ou Empresas ligadas</a></li>
                </ul>
            </div>
            
            <div id="MostraConteudo">
                
                <div id="mLocalizacaoCont" class="conteudoMuda esconde">
                	
                    <div id="TituloConteudoLog">
                    	<h2>Localização</h2>
                	</div>
                	<p>Localização de clientes é o nosso DNA. Através de uma busca simples você pode obter dados assertivos. Iremos te ajudar à cobrar, analisar ou vender melhor.</p>
                
                	<ul>
                    	<li><a class="width140" href="#">CPF</a></li>
                    	<li><a class="width145 marginleft" href="#">NOME</a></li>
                    	<li><a class="width145 marginleft" href="#">SEXO</a></li>
                    	<li><a class="width145 marginleft" href="#">E-MAILS</a></li>
                    	<li><a class="width248" href="#">DATA DE NASCIMENTO</a></li>
                    	<li><a class="width168 marginleft" href="#">NOME DA MÃE</a></li>
                    	<li><a class="width168 marginleft" href="#">ENDEREÇO</a></li>
                    	<li><a class="width180" href="#">TELEFONES</a></li>
                    	<li><a class="width248 marginleft" href="#">PARTICIPAÇÃO SOCIETÁRIA</a></li>
                    </ul>
                </div>
                
                <div id="mEmailsCont" class="conteudoMuda esconde">
                	
                    <div id="TituloConteudoLog">
                    	<h2>Emails</h2>
                	</div>
                	<p >Clicando em Emails através de um algoritimo de parentesco, vamos buscar emails com chances de localizar o cpf consultado.</p>
                
                
                	<ul>
                    	<li><a class="width180" href="#">Emails</a></li>
                    </ul>
                </div>

        
                <div id="mTelefonesCont" class="conteudoMuda esconde">
                	
                    <div id="TituloConteudoLog">
                    	<h2>Telefones</h2>
                	</div>
                	<p >Clicando em telefones através de um algoritimo de parentesco, vamos buscar telefones com chances de localizar o cpf consultado.</p>
                
                
                	<ul>
                    	<li><a class="width180" href="#">TELEFONES</a></li>
                    </ul>
                </div>
                
                
                <div id="mObtoCont" class="conteudoMuda esconde">
                	
                    <div id="TituloConteudoLog">
                    	<h2>Óbito</h2>
                	</div>
                	<p >Saiba se foi identificado CPF com suspeita de óbito. Isso irá diminuir custos de sua operação ou alertar para que suas futuras buscas se baseiem em pessoas ligadas.</p>
                
                
                	<ul>
                    	<li><a class="width140" href="#">DATA ÓBITO</a></li>
                    	<li><a class="width145 marginleft" href="#">Nº LIVRO</a></li>
                    	<li><a class="width145 marginleft" href="#">Nº FOLHA</a></li>
                    	<li><a class="width145 marginleft" href="#">E-MAILS</a></li>
                    	<li><a class="width248" href="#">Nº TERMO</a></li>
                    	<li><a class="width168 marginleft" href="#">NOME CARTÓRIO</a></li>
                    	<li><a class="width228 " href="#">ENDEREÇO CARTÓRIO</a></li>
                    	<li><a class="width188 marginleft" href="#" style="margin-right:10px;">CIDADE CARTÓRIO</a></li>
                    	<li><a class="width180 " href="#">CEP CARTÓRIO</a></li>
                    </ul>
                </div>
                
                <div id="mPerSocCont" class="conteudoMuda esconde">
                	
                    <div id="TituloConteudoLog">
                    	<h2>Perfil Sociodemográfico</h2>
                	</div>
                	<p>Para ações de prospecção e validação, o perfil SócioDemográfico ajuda principalmente a traçar um perfil alvo.</p>
                
                
                	<ul>
                    	<li><a class="width140" href="#">CLUSTER</a></li>
                    	<li><a class="width145 marginleft" href="#">CLASSE SOCIAL</a></li>
                    	<li><a class="width228 marginleft" href="#">RENDA PRESUMIDAO</a></li>
                    	<li><a class="width168" href="#">ESTADO CIVIL</a></li>
                    	<li><a class="width188 marginleft" href="#">ESCOLARIDADE</a></li>
                    	<li><a class="width180 marginleft" href="#">OCUPAÇÃO</a></li>
                    </ul>
                </div>
                
                <div id="mPerConsCont" class="conteudoMuda esconde">
                	
                    <div id="TituloConteudoLog">
                    	<h2>Perfil de consumo</h2>
                	</div>
                	<p>Informações comportamentais tem forte apelo na tomada de decisão. Saiba exatamente para qual público você pode ofertar seus serviços.</p>
                
                
                	<ul>
                    	<li><a class="width140" href="#">TV A CABO</a></li>
                    	<li><a class="width228 marginleft" href="#">POSSUI VEÍCULO</a></li>
                    	<li><a class="width188 marginleft" href="#">CARTÃO DE CRÉDITO</a></li>
                    	<li><a class="width168" href="#">BANDA LARGA</a></li>
                    </ul>
                </div>
                
                
                
                <div id="mContCont" class="conteudoMuda esconde">
                	
                    <div id="TituloConteudoLog">
                    	<h2>Contatos ruins</h2>
                	</div>
                	<p >Com esta funcionalidade podemos dizer com propriedade que dados como telefone já foram invalidados por usuários do sistema ou desatualizado.</p>
                
                
                	<ul>
                    	<li><a class="width180" href="#">TELEFONES</a></li>
                    </ul>
                </div>
                
                
                <div id="mCcfCont" class="conteudoMuda esconde">
                	
                    <div id="TituloConteudoLog">
                    	<h2>CCF (Consulta de cheques)</h2>
                	</div>
                	<p>Consulta de inadimplência através de cheques devolvidos. Saiba se o CPF pesquisado possui algum tipo de pendência e os detalhes da ocorrência.</p>
                
                
                	<ul>
                    	<li><a class="width228" href="#">Nº CHEQUE</a></li>
                    	<li><a class="width140 marginleft" href="#">MOTIVO</a></li>
                    </ul>
                </div>
                
                <div id="mPessCont" class="conteudoMuda esconde">
                	
                    <div id="TituloConteudoLog">
                    	<h2>Pessoas ou Empresas ligadas</h2>
                	</div>
                	<p>Uma alternativa para conseguirmos uma localização é apontar pessoas ou empresas que estejam em contato direto ou indireto com o individuo consultado.</p>
                
                
                	<ul>
                    	<li><a class="width140" href="#">MAE</a></li>
                    	<li><a class="width145 marginleft" href="#">PAI</a></li>
                    	<li><a class="width228 marginleft" href="#">FILHO</a></li>
                    	<li><a class="width168 " href="#">IRMÃ</a></li>
                    	<li><a class="width188 marginleft" href="#">PARENTE</a></li>
                    	<li><a class="width180 marginleft" href="#">EMPRESA</a></li>
                    </ul>
                </div>
                
                
                <div class="limpar"></div>
                
                <div id="acessoAtri">
                	<strong>Deseja ter acesso a estes atributos?</strong> <a href="../contact/speak">Fale Conosco</a>
                </div>
            </div>
        
        </div>
    
    </div>
    
	<div class="limpar"></div>
    <!-- Site Rodape -->
    <div id="SiteRodape">
    	<footer>
        	<div id="LogoRodape">
            	<a title="Localiza Marketing Solutions" href="#"><img src="../img/logo-rodape.gif" /></a>
            </div>
            <br />
        	<p>Copyright © 2014 - Localiza Marketing Solutions</p>
        </footer>
    </div>
</div> 