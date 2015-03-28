<div>
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
    	<div  class="largura">
        	<div id="btOpcoes">
            	<a id="escolhaOp" class="escolhaOpNorm" onClick="toggle_Mop('abrindoMopcoes')" href="javascript:void(0)">Escolha uma opção</a>
           		<div id="abrindoMopcoes">
                	<ul>
                    	<li><a href="#">Dados Cadastrais</a></li>
                        <li><a href="#">Emails</a></li>
                    	<li><a href="#">Telefones</a></li>
                    	<li><a href="#">Óbito</a></li>
                    	<li><a href="#">CCF (Consulta de cheques)</a></li>
                    </ul>
                
                </div>     
           </div>

            <div id="formBuscaSimples">
            	{{ form('user/search', 'class': 'form-inline') }}
                	<input name="busca" value="Digite o número do CNPJ ou CPF" onblur="if(this.value=='') this.value='Digite o número do CNPJ ou CPF';" onfocus="if(this.value=='Digite o número do CNPJ ou CPF') this.value='';" />
                    
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
            {{ form('user/filter', 'class': 'form-inline') }}
            <div id="forBuscaAvancada">
				<div id="buscaNomeCont" class="conteudosteste esconde">
                    	
                        <div id="buscaNomeContEsq">
                        	<div><label for="iptNome">Nome: </label><span class="busAvGrand" ><input id="iptNome" name="" type="text" /></span></div>
                        	<div><label for="iptCidade">Cidade:</label><span class="busAvGrand" ><input id="iptCidade" name="" type="text" /></span></div>
                        </div>
                        
                        <div id="buscaNomeContDir" >
                        	<div><label for="iptBairro">Bairro:</label><span class="busAvGrand" ><input id="iptBairro" class="busAvGrand" name="" type="text" /></span></div>
                        	<div><label for="iptUF">UF:</label><span class="busAvpeq" ><input id="iptUF"  name="" type="text" /></span> <button>Buscar</button></div>
                        </div>
                    
					<div class="limpar"></div>
                </div>

				<div id="buscatelCont" class="conteudosteste esconde">
                    	<div id="buscatelContDDD"><label>DDD:</label><span><input name="" type="text"  /></span></div>
                        <div id="buscatelContTel"><label>Telefone:</label><span><input name="" type="text"  /></span> <button>Buscar</button></div>
                    
                    
                    <div class="limpar"></div>
                    
                </div>
				
                <div id="buscacepCont" class="conteudosteste esconde">
                        <div id="buscacepContCep"><label>CEP:</label><span><input name="" type="text"  /></span> <button>Buscar</button></div>
                    
                    <div class="limpar"></div>
                    
                </div>
                <div id="buscaendCont" class="conteudosteste esconde">
                    	
                        <div id="buscaendContEsq">
                        	<div><label style="width:70px;" for="iptNome">Logradouro: </label><span class="busAvGrand" ><input id="iptNome" name="" type="text" /></span></div>
                        	<div><label style="width:70px;" for="iptCidade">Cidade:</label><span class="busAvGrand" ><input id="iptCidade" name="" type="text" /></span></div>
                        </div>
                        
                        <div id="buscaendContDir" >
                        	<div><label for="iptUF">N:</label><span class="busAvpeq" ><input id="iptUF"  name="" type="text" /></span><label style="margin-left:10px;" for="iptBairro">Bairro:</label><span class="busAvGrand"  ><input id="iptBairro" class="busAvGrand" name="" type="text" /></span></div>
                        	<div><label for="iptUF">UF:</label><span class="busAvpeq" ><input id="iptUF"  name="" type="text" /></span> <button>Buscar</button></div>
                        </div>
                    
					<div class="limpar"></div>
                </div>
                <div id="buscainssCont" class="conteudosteste esconde">
                        <div id="buscacepContCep"><label>Número do Benefício:</label><span><input name="" type="text"  /></span> <button>Buscar</button></div>
                    
                </div>

            </div>
            </form>
        </div>  
    </div>
    
    <div id="divbtFechaBusca" class="largura esconde" >
        <div class="limpar"></div>
        <a id="btFechaBusca" class="esconde" href="#">x Opções avançadas</a>
    </div>
    
    <div class="limpar"></div>
    
    <div class="largura" id="buscaResultado">
    	<div id="menuResulEsq">
        	<div id="menuResulEsqMenu">
                <ul>
                    {% if cnpjSearch==1 %}<li id="mResDadosCNPJ" class="mSimpRes"><a href="javascript:void(0);" onClick="mostraConteudoRes('mResDadosCNPJ')">Dados Cadastrais</a></li>{% else %}
                    <li id="mResLocal" class="mSimpRes"><a href="javascript:void(0);" onClick="mostraConteudoRes('mResLocal')">Dados Cadastrais</a></li>{% endif %}
                    {% if cnpjSearch==1 %}<li id="mResEnd" class="mSimpRes"><a href="javascript:void(0);" onClick="mostraConteudoRes('mResEnd')">Endereços</a></li>{% endif %}
                    <li id="mResEmail" class="mSimpRes"><a href="javascript:void(0);" onClick="mostraConteudoRes('mResEmail')">{% if cnpjSearch==1 %}Emails{% else %}Email{% endif %}</a></li>
                    <li id="mResTel" class="mSimpRes"><a href="javascript:void(0);" onClick="mostraConteudoRes('mResTel')">{% if cnpjSearch==1 %}Telefones{% else %}Telefone{% endif %}</a></li>
                    {% if cnpjSearch==1 %}<li id="mResQSA" class="mSimpRes"><a href="javascript:void(0);" onClick="mostraConteudoRes('mResQSA')">Quadro de Sócios e Admins</a></li>{% else %}
                    <li id="mResobto" class="mSimpRes"><a href="javascript:void(0);" onClick="mostraConteudoRes('mResobto')">Óbito</a></li>{% endif %}
                    {% if cnpjSearch==0 %}<li id="mResPRel" class="mSimpRes"><a href="javascript:void(0);" onClick="mostraConteudoRes('mResPRel')">Pessoas Relacionadas</a></li>
                    <li id="mResERel" class="mSimpRes"><a href="javascript:void(0);" onClick="mostraConteudoRes('mResERel')">Empresas Relacionadas</a></li>{% endif %}
                </ul>
            </div>
            
            <div id="dadosCredito">
            
            	<ul>
                	<li>
                    	<strong>Consultas Pré-pagas</strong>
                        <span class="normal">R$ 0,00</span>
                    </li>
                	<li>
                    	<strong>Saldo Pré-Pago</strong>
                        <span class="normal">R$ 0,00</span>
                    </li>
                	<li id="consultasRecentes">
                    	<strong>Consultas Recentes</strong>
                        <span class="menor">{% if tronco is defined %}{{ tronco['NOME'] }}{% endif %}{% if empresaBR is defined %}{{ empresaBR['NOME_FANTASIA'] }}{% endif %}</span>
                    </li>
                </ul>
            </div>
        
        </div>
        
        <!-- -->
        <div id="mostraBuscResult">
        
            	<div id="mResLocalCont" class="resultadosBuscaDir esconde">
                	
                    <div class="resultHead1">
                    	<strong>Consulta realizada para:</strong>
                        <ul>
                        	<li><span>Este contato foi efetivo?</span></li>
                        	<li><a href="#">Sim</a></li>
                        	<li><a href="#">Não</a></li>
                        </ul>
                    </div>
                    
                    <div class="limpar"></div>
                    
                    <div class="resultHead2">
                    	<h2> <span>{% if cnpjSearch == 0 %}CPF: <strong>{% if tronco is defined %}0{{ tronco['CPF'] }}{% endif %}</strong>{% else %}CNPJ:<strong>{% if empresaBR is defined %}{{ empresaBR['CNPJ'] }}{% endif %}</strong>{% endif %}</span>  |  <span>Nome: </span><strong>{% if tronco is defined %}{{ tronco['NOME'] }}{% endif %}{% if empresaBR is defined %}{{ empresaBR['NOME_FANTASIA'] }}{% endif %}</strong></h2>
                    </div>
                    
                    <span class="linhaHead">&nbsp;</span>
                    
                    
                    <h3 class="tituloTabela">Visualize abaixo os dados cadastrais!</h3>
                    
                    
                    
                    <table class="tabelaResult">
                    	<tr class="tabelaHead">
                        	<th><span>Nome</span></th>
                        	<th><span>Nome da Mãe</span></th>
                        	<th><span>Data de Nascimento</span></th>
                        	<th><span>Sexo</span></th>
                        	<th><span>Signo</span></th>
                        </tr>
                        {% if cnpjSearch==1 %}
                        {% if enderecos is defined %}
                        {% set linstra = 'linstraEscura' %}
                        {% for endereco in enderecos %}
                        <tr class="{{ linstra }}">
                        	<td><span>{% if empresaBR is defined %}{{ empresaBR['NOME_FANTASIA'] }}{% else %}---{% endif %}</span></td>
                        	<td><span>{{ endereco['ENDERECO'] }}</span></td>
                        	<td><span>{{ endereco['BAIRRO'] }}</span></td>
                        	<td><span>{{ endereco['CIDADE'] }}</span></td>
                        	<td><span>{{ endereco['UF'] }}</span></td>
                        </tr>
                        {% if linstra is 'linstraEscura' %}{% set linstra = 'listraBranca' %}{% else %}{% set linstra = 'linstraEscura' %}{% endif %}
                        {% endfor %}
                        {% endif %}
                        {% else %}
                        {% if tronco is defined %}
                        {% set linstra = 'linstraEscura' %}
                        <tr class="{{ linstra }}">
                        	<td><span>{{ tronco['NOME'] }}</span></td>
                        	<td><span>{{ tronco['NOME_MAE'] }}</span></td>
                        	<td><span>{{ tronco['ANONASC']~'-'~tronco['MESNASC']~'-'~tronco['DIANASC'] }}</span></td>
                        	<td><span>{{ tronco['SEXO'] }}</span></td>
                        	<td><span>{{ signo }}</span></td>
                        </tr>
                        {% if linstra is 'linstraEscura' %}{% set linstra = 'listraBranca' %}{% else %}{% set linstra = 'linstraEscura' %}{% endif %}
                        {% endif %}
                        {% endif %}
                    </table>
                    
                </div>
                
                <div id="mResEndCont" class="resultadosBuscaDir esconde">
                	
                    <div class="resultHead1">
                    	<strong>Consulta realizada para:</strong>
                        <ul>
                        	<li><span>Este contato foi efetivo?</span></li>
                        	<li><a href="#">Sim</a></li>
                        	<li><a href="#">Não</a></li>
                        </ul>
                    </div>
                    
                    <div class="limpar"></div>
                    
                    <div class="resultHead2">
                        <h2> <span>{% if cnpjSearch == 0 %}CPF: <strong>{% if tronco is defined %}{{ tronco['CPF'] }}{% endif %}</strong>{% else %}CNPJ:<strong>{% if empresaBR is defined %}{{ empresaBR['CNPJ'] }}{% endif %}</strong>{% endif %}</span>  |  <span>Nome: </span><strong>{% if tronco is defined %}{{ tronco['NOME'] }}{% endif %}{% if empresaBR is defined %}{{ empresaBR['NOME_FANTASIA'] }}{% endif %}</strong></h2>
                    </div>
                    
                    <span class="linhaHead">&nbsp;</span>
                    
                    <h3 class="tituloTabela">Endereços</h3>
                    
                    <a class="bteditarregustro" href="#">editar</a>
                    <div class="limpar"></div>
                    
                    <table class="tabelaResult">
                    	<tr class="tabelaHead">
                        	<th><span>Endereço</span></th>
                        	<th><span>Número</span></th>
                        	<th><span>Complemento</span></th>
                        	<th><span>Bairro</span></th>
                                <th><span>CEP</span></th>
                                <th><span>Cidade</span></th>
                                <th><span>UF</span></th>
                                <th><span>Score</span></th>
                        </tr>
                        {% if enderecos is defined %}
                        {% set linstra = 'linstraEscura' %}
                        {% for endereco in enderecos %}
                        <tr class="{{ linstra }}">
                        	<td><span>{{ endereco['ENDERECO'] }}</span></td>
                        	<td><span>{{ endereco['NUMERO'] }}</span></td>
                        	<td><span>{{ endereco['COMPLEMENTO'] }}</span></td>
                        	<td><span>{{ endereco['BAIRRO'] }}</span></td>
                                <td><span>{{ endereco['CEP'] }}</span></td>
                                <td><span>{{ endereco['CIDADE'] }}</span></td>
                                <td><span>{{ endereco['UF'] }}</span></td>
                                <td><span>{{ endereco['PRIORIDADE'] }}</span></td>
                        </tr>
                        {% if linstra is 'linstraEscura' %}{% set linstra = 'listraBranca' %}{% else %}{% set linstra = 'linstraEscura' %}{% endif %}
                        {% endfor %}
                        {% endif %}
                    </table>
                    
                </div>

                <div id="mResPRelCont" class="resultadosBuscaDir esconde">
                	
                    <div class="resultHead1">
                    	<strong>Consulta realizada para:</strong>
                        <ul>
                        	<li><span>Este contato foi efetivo?</span></li>
                        	<li><a href="#">Sim</a></li>
                        	<li><a href="#">Não</a></li>
                        </ul>
                    </div>
                    
                    <div class="limpar"></div>
                    
                    <div class="resultHead2">
                        <h2> <span>{% if cnpjSearch == 0 %}CPF: <strong>{% if tronco is defined %}{{ tronco['CPF'] }}{% endif %}</strong>{% else %}CNPJ:<strong>{% if empresaBR is defined %}{{ empresaBR['CNPJ'] }}{% endif %}</strong>{% endif %}</span>  |  <span>Nome: </span><strong>{% if tronco is defined %}{{ tronco['NOME'] }}{% endif %}{% if empresaBR is defined %}{{ empresaBR['NOME_FANTASIA'] }}{% endif %}</strong></h2>
                    </div>
                    
                    <span class="linhaHead">&nbsp;</span>
                    
                    <h3 class="tituloTabela">Pessoas Relacionadas</h3>
                    
                    <a class="bteditarregustro" href="#">editar</a>
                    <div class="limpar"></div>
                    
                    <table class="tabelaResult">
                    	<tr class="tabelaHead">
                        	<th><span>CPF</span></th>
                        	<th><span>Nome</span></th>
                        	<th><span>Nome Mãe</span></th>
                        	<th><span>Data de Nascimento</span></th>
                                <th><span>Sexo</span></th>
                        </tr>
                        {% if troncoRels is defined %}
                        {% set linstra = 'linstraEscura' %}
                        {% for troncoRel in troncoRels %}
                        {% if troncoRel.CPF is not tronco.CPF %}
                        <tr class="{{ linstra }}">
                        	<td><span>{{ troncoRel['CPF'] }}</span></td>
                        	<td><span>{{ troncoRel['NOME'] }}</span></td>
                        	<td><span>{{ troncoRel['NOME_MAE'] }}</span></td>
                        	<td><span>{{ troncoRel['ANONASC']~'-'~troncoRel['MESNASC']~'-'~troncoRel['DIANASC'] }}</span></td>
                                <td><span>{{ troncoRel['SEXO'] }}</span></td>
                        </tr>
                        {% if linstra is 'linstraEscura' %}{% set linstra = 'listraBranca' %}{% else %}{% set linstra = 'linstraEscura' %}{% endif %}
                        {% endif %}
                        {% endfor %}
                        {% endif %}
                    </table>
                    
                </div>

                <div id="mResERelCont" class="resultadosBuscaDir esconde">
                	
                    <div class="resultHead1">
                    	<strong>Consulta realizada para:</strong>
                        <ul>
                        	<li><span>Este contato foi efetivo?</span></li>
                        	<li><a href="#">Sim</a></li>
                        	<li><a href="#">Não</a></li>
                        </ul>
                    </div>
                    
                    <div class="limpar"></div>
                    
                    <div class="resultHead2">
                        <h2> <span>{% if cnpjSearch == 0 %}CPF: <strong>{% if tronco is defined %}{{ tronco['CPF'] }}{% endif %}</strong>{% else %}CNPJ:<strong>{% if empresaBR is defined %}{{ empresaBR['CNPJ'] }}{% endif %}</strong>{% endif %}</span>  |  <span>Nome: </span><strong>{% if tronco is defined %}{{ tronco['NOME'] }}{% endif %}{% if empresaBR is defined %}{{ empresaBR['NOME_FANTASIA'] }}{% endif %}</strong></h2>
                    </div>
                    
                    <span class="linhaHead">&nbsp;</span>
                    
                    <h3 class="tituloTabela">Empresas Relacionadas</h3>
                    
                    <a class="bteditarregustro" href="#">editar</a>
                    <div class="limpar"></div>
                    
                    <table class="tabelaResult">
                    	<tr class="tabelaHead">
                        	<th><span>CNPJ</span></th>
                        	<th><span>Razão Social</span></th>
                        	<th><span>Nome Fantasia</span></th>
                        </tr>
                        {% if qsaCPFs is defined %}
                        {% set linstra = 'linstraEscura' %}
                        {% for qsaCPF in qsaCPFs %}
                        <tr class="{{ linstra }}">
                        	<td><span>{{ qsaCPF['CNPJ'] }}</span></td>
                        	<td><span>{{ qsaCPF['RAZAO_SOCIAL'] }}</span></td>
                        	<td><span>{{ qsaCPF['NOME_FANTASIA'] }}</span></td>
                        </tr>
                        {% if linstra is 'linstraEscura' %}{% set linstra = 'listraBranca' %}{% else %}{% set linstra = 'linstraEscura' %}{% endif %}
                        {% endfor %}
                        {% endif %}
                    </table>
                    
                </div>

                <div id="mResQSACont" class="resultadosBuscaDir esconde">
                	
                    <div class="resultHead1">
                    	<strong>Consulta realizada para:</strong>
                        <ul>
                        	<li><span>Este contato foi efetivo?</span></li>
                        	<li><a href="#">Sim</a></li>
                        	<li><a href="#">Não</a></li>
                        </ul>
                    </div>
                    
                    <div class="limpar"></div>
                    
                    <div class="resultHead2">
                        <h2> <span>{% if cnpjSearch == 0 %}CPF: <strong>{% if tronco is defined %}{{ tronco['CPF'] }}{% endif %}</strong>{% else %}CNPJ:<strong>{% if empresaBR is defined %}{{ empresaBR['CNPJ'] }}{% endif %}</strong>{% endif %}</span>  |  <span>Nome: </span><strong>{% if tronco is defined %}{{ tronco['NOME'] }}{% endif %}{% if empresaBR is defined %}{{ empresaBR['NOME_FANTASIA'] }}{% endif %}</strong></h2>
                    </div>
                    
                    <span class="linhaHead">&nbsp;</span>
                    
                    <h3 class="tituloTabela">Endereços</h3>
                    
                    <a class="bteditarregustro" href="#">editar</a>
                    <div class="limpar"></div>
                    
                    <table class="tabelaResult">
                    	<tr class="tabelaHead">
                        	<th class="col-lg-3"><span>Documento Sócio</span></th>
                        	<th class="col-lg-4"><span>Nome Do Sócio</span></th>
                        	<th class="col-lg-4"><span>Qualificação</span></th>
                        	<th class="col-lg-1"><span>Data Entrada Sociedade</span></th>
                                <th><span>Valor Da Participação</span></th>
                        </tr>
                        {% if qsas is defined %}
                        {% set linstra = 'linstraEscura' %}
                        {% for qsa in qsas %}
                        <tr class="{{ linstra }}">
                        	<td class="col-lg-2"><span>{{ qsa['DOCUMENTO_SOCIO'] }}</span></td>
                        	<td class="col-lg-4"><span>{{ qsa['NOME_SOCIO'] }}</span></td>
                        	<td class="col-lg-4"><span>{{ qsa['QUALIFICACAO'] }}</span></td>
                        	<td class="col-lg-1"><span>{{ qsa['DATA_ENTRADA_SOCIEDADE'] }}</span></td>
                                <td><span>{{ qsa['VALOR_PARTICIPACAO'] }}</span></td>
                        </tr>
                        {% if linstra is 'linstraEscura' %}{% set linstra = 'listraBranca' %}{% else %}{% set linstra = 'linstraEscura' %}{% endif %}
                        {% endfor %}
                        {% endif %}
                    </table>
                    
                </div>

                <div id="mResEmailCont" class="resultadosBuscaDir esconde">
                	
                    <div class="resultHead1">
                    	<strong>Consulta realizada para:</strong>
                        <ul>
                        	<li><span>Este contato foi efetivo?</span></li>
                        	<li><a href="#">Sim</a></li>
                        	<li><a href="#">Não</a></li>
                        </ul>
                    </div>
                    
                    <div class="limpar"></div>
                    
                    <div class="resultHead2">
                        <h2> <span>{% if cnpjSearch == 0 %}CPF: <strong>{% if tronco is defined %}{{ tronco['CPF'] }}{% endif %}</strong>{% else %}CNPJ:<strong>{% if empresaBR is defined %}{{ empresaBR['CNPJ'] }}{% endif %}</strong>{% endif %}</span>  |  <span>Nome: </span><strong>{% if tronco is defined %}{{ tronco['NOME'] }}{% endif %}{% if empresaBR is defined %}{{ empresaBR['NOME_FANTASIA'] }}{% endif %}</strong></h2>
                    </div>
                    
                    <span class="linhaHead">&nbsp;</span>
                    
                    <h3 class="tituloTabela">Emails</h3>
                    
                    <a class="bteditarregustro" href="#">editar</a>
                    <div class="limpar"></div>
                    
                    <table class="tabelaResult">
                    	<tr class="tabelaHead">
                        	<th><span>Email</span></th>
                        	<th><span>Data Criação</span></th>
                        	{% if cnpjSearch==1 %}<th><span>Origem</span></th>{% endif %}
                        	<th><span>Prioridade</span></th>
                        </tr>
                        {% if emails is defined %}
                        {% set linstra = 'linstraEscura' %}
                        {% for email in emails %}
                        <tr class="{{ linstra }}">
                        	<td><span>{{ email['EMAIL'] }}</span></td>
                        	<td><span>{{ email['DATA_ADD'] }}</span></td>
                        	{% if cnpjSearch==1 %}<td><span>{{ email['ORIGEM'] }}</span></td>{% endif %}
                        	<td><span>{{ email['PRIORIDADE'] }}</span></td>
                        </tr>
                        {% if linstra is 'linstraEscura' %}{% set linstra = 'listraBranca' %}{% else %}{% set linstra = 'linstraEscura' %}{% endif %}
                        {% endfor %}
                        {% endif %}
                    </table>
                    
                </div>

            	<div id="mResTelCont" class="resultadosBuscaDir esconde">
                	
                    <div class="resultHead1">
                    	<strong>Consulta realizada para:</strong>
                        <ul>
                        	<li><span>Este contato foi efetivo?</span></li>
                        	<li><a href="#">Sim</a></li>
                        	<li><a href="#">Não</a></li>
                        </ul>
                    </div>
                    
                    <div class="limpar"></div>
                    
                    <div class="resultHead2">
                        <h2> <span>{% if cnpjSearch == 0 %}CPF: <strong>{% if tronco is defined %}{{ tronco['CPF'] }}{% endif %}</strong>{% else %}CNPJ:<strong>{% if empresaBR is defined %}{{ empresaBR['CNPJ'] }}{% endif %}</strong>{% endif %}</span>  |  <span>Nome: </span><strong>{% if tronco is defined %}{{ tronco['NOME'] }}{% endif %}{% if empresaBR is defined %}{{ empresaBR['NOME_FANTASIA'] }}{% endif %}</strong></h2>
                    </div>
                    
                    <span class="linhaHead">&nbsp;</span>
                    
                    <h3 class="tituloTabela">Telefones</h3>
                    
                    <a class="bteditarregustro" href="#">editar</a>
                    <div class="limpar"></div>
                    
                    <table class="tabelaResult">
                    	<tr class="tabelaHead">
                        	<th><span>Tipo do Telefone</span></th>
                        	<th><span>Número do Telefone</span></th>
                        	<th><span>Score</span></th>
                        </tr>
                        {% if telefones is defined %}
                        {% set linstra = 'linstraEscura' %}
                        {% for telefone in telefones %}
                        <tr class="{{ linstra }}">
                        	<td><span>{{ telefone['TP_FONE'] }}</span></td>
                        	<td><span>{% if cnpjSearch==1 %}{{ telefone['TELEFONE'] }}{% else %}{{ telefone['telefone'] }}{% endif %}</span></td>
                        	<td><span>{{ telefone['PRIORIDADE'] }}</span></td>
                        </tr>
                        {% if linstra is 'linstraEscura' %}{% set linstra = 'listraBranca' %}{% else %}{% set linstra = 'linstraEscura' %}{% endif %}
                        {% endfor %}
                        {% endif %}
                    </table>
                    
                </div>
			
                <div id="mResDadosCNPJCont" class="resultadosBuscaDir esconde">
                	
                    <div class="resultHead1">
                    	<strong>Consulta realizada para:</strong>
                        <ul>
                        	<li><span>Este contato foi efetivo?</span></li>
                        	<li><a href="#">Sim</a></li>
                        	<li><a href="#">Não</a></li>
                        </ul>
                    </div>
                    
                    <div class="limpar"></div>
                    
                    <div class="resultHead2">
                    	<h2> <span>{% if cnpjSearch == 0 %}CPF: <strong>{% if tronco is defined %}{{ tronco['CPF'] }}{% endif %}</strong>{% else %}CNPJ:<strong>{% if empresaBR is defined %}{{ empresaBR['CNPJ'] }}{% endif %}</strong>{% endif %}</span>  |  <span>Nome: </span><strong>{% if tronco is defined %}{{ tronco['NOME'] }}{% endif %}{% if empresaBR is defined %}{{ empresaBR['NOME_FANTASIA'] }}{% endif %}</strong></h2>
                    </div>
                    
                    <span class="linhaHead">&nbsp;</span>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12" style="margin-top:2%"><div class="row"><div class"col-lg-12"><h3><span class="label label-default">Nome Empresarial</span></h3></div><div class"col-lg-7"><b>{{ empresaBR['NOME_FANTASIA'] }}</b></div></div></div>
                            <div class="col-lg-3" style="margin-top:2%"><div class="row"><div class"col-lg-3"><h3><span class="label label-default">Data de Abertura</span></h3></div><div class"col-lg-3"><b>{{ empresaBR['DATA_ABERTURA'] }}</b></div></div></div>
                            <div class="col-lg-12" style="margin-top:2%"><div class="row"><div class"col-lg-12"><h3><span class="label label-default">Título de Estabelecimento (Nome Fantasia)</span></h3></div><div class"col-lg-7"><b>{{ empresaBR['NOME_FANTASIA'] }}</b></div></div></div>
                            <div class="col-lg-12" style="margin-top:2%"><div class="row"><div class"col-lg-12"><h3><span class="label label-default">Código E Descrição Da Atividade Económica Principal</span></h3></div><div class"col-lg-7"><b>{{ empresaBR['ATIVIDADE_PRIMARIA'] }}</b></div></div></div>
                            <div class="col-lg-12" style="margin-top:2%"><div class="row"><div class"col-lg-12"><h3><span class="label label-default">Código E Descrição Das Atividades Económicas Secundárias</span></h3></div><div class"col-lg-7"><b>{{ empresaBR['ATIVIDADE_SECUNDARIA'] }}</b></div></div></div>
                            <div class="col-lg-12" style="margin-top:2%"><div class="row"><div class"col-lg-12"><h3><span class="label label-default">Código Descrição Da Natureza Jurídica</span></h3></div><div class"col-lg-12"><b>{{ empresaBR['NATUREZA_JURIDICA'] }}</b></div></div></div>
                        </div>    
                    </div>
                    <div class="col-lg-12" style="margin-top:2%">
                        <div class="row">
                            <div class="col-lg-4"><div class="row"><div class"col-lg-4"><h3><span class="label label-default">Logradouro</span></h3></div><div class"col-lg-4"><b>{{ empresaBR['LOGRADOURO'] }}</b></div></div></div>
                            <div class="col-lg-3"><div class="row"><div class"col-lg-3"><h3><span class="label label-default">Número</span></h3></div><div class"col-lg-3"><b>{{ empresaBR['NUMERO'] }}</b></div></div></div>
                            <div class="col-lg-4"><div class="row"><div class"col-lg-3"><h3><span class="label label-default">Complemento</span></h3></div><div class"col-lg-3"><b>{{ empresaBR['COMPLEMENTO'] }}</b></div></div></div>
                        </div>    
                    </div>
                    <div class="col-lg-12" style="margin-top:2%">
                        <div class="row">
                            <div class="col-lg-3"><div class="row"><div class"col-lg-3"><h3><span class="label label-default">CEP</span></h3></div><div class"col-lg-3"><b>{{ empresaBR['CEP'] }}</b></div></div></div>
                            <div class="col-lg-4"><div class="row"><div class"col-lg-4"><h3><span class="label label-default">Bairro/Distrito</span></h3></div><div class"col-lg-4"><b>{{ empresaBR['BAIRRO'] }}</b></div></div></div>
                            <div class="col-lg-4"><div class="row"><div class"col-lg-4"><h3><span class="label label-default">Munícipio</span></h3></div><div class"col-lg-4"><b>{{ empresaBR['MUNICIPIO'] }}</b></div></div></div>
                            <div class="col-lg-1"><div class="row"><div class"col-lg-1"><h3><span class="label label-default">UF</span></h3></div><div class"col-lg-1"><b>{{ empresaBR['UF'] }}</b></div></div></div>
                        </div>    
                    </div>
                    <div class="col-lg-12" style="margin-top:2%">
                        <div class="row">
                            <div class="col-lg-6"><div class="row"><div class"col-lg-6"><h3><span class="label label-default">Situação Cadastral</span></h3></div><div class="col-lg-6"><b>{{ empresaBR['SITUACAO_CADASTRAL'] }}</b></div></div></div>
                            <div class="col-lg-6"><div class="row"><div class"col-lg-6"><h3><span class="label label-default">Data de Situação Cadastral</span></h3></div><div class="col-lg-6"><b>{{ empresaBR['DATA_SITUACAO_CADASTRAL'] }}</b></div></div></div>
                        </div>    
                    </div>
                    <div class="col-lg-12" style="margin-top:2%">
                        <div class="row">
                            <div class="col-lg-10"><div class="row"><div class"col-lg-10"><h3><span class="label label-default">Motivo De Situação Cadastral</span></h3></div><div class="col-lg-10"><b>{{ empresaBR['MOTIVO_SITUACAO_CADASTRAL'] }}</b></div></div></div>
                        </div>    
                    </div>
                    <div class="col-lg-12" style="margin-top:2%">
                        <div class="row">
                            <div class="col-lg-6"><div class="row"><div class"col-lg-6"><h3><span class="label label-default">Situação Especial</span></h3></div><div class="col-lg-6"><b>{{ empresaBR['SITUACAO_ESPECIAL'] }}</b></div></div></div>
                            <div class="col-lg-6"><div class="row"><div class"col-lg-6"><h3><span class="label label-default">Data de Situação Especial</span></h3></div><div class="col-lg-6"><b>{{ empresaBR['DATA_SITUACAO_ESPECIAL'] }}</b></div></div></div>
                        </div>    
                    </div>
                </div>



            	<div id="mResobtoCont" class="resultadosBuscaDir esconde">
                	
                    <div class="resultHead1">
                    	<strong>Consulta realizada para:</strong>
                        <ul>
                        	<li><span>Este contato foi efetivo?</span></li>
                        	<li><a href="#">Sim</a></li>
                        	<li><a href="#">Não</a></li>
                        </ul>
                    </div>
                    
                    <div class="limpar"></div>
                    
                    <div class="resultHead2">
                    	<h2> <span>{% if cnpjSearch == 0 %}CPF: <strong>{% if tronco is defined %}{{ tronco['CPF'] }}{% endif %}</strong>{% else %}CNPJ:<strong>{% if empresaBR is defined %}{{ empresaBR['CNPJ'] }}{% endif %}</strong>{% endif %}</span>  |  <span>Nome: </span><strong>{% if tronco is defined %}{{ tronco['NOME'] }}{% endif %}{% if empresaBR is defined %}{{ empresaBR['NOME_FANTASIA'] }}{% endif %}</strong></h2>
                    </div>
                    
                    <span class="linhaHead">&nbsp;</span>
                    
                    
                    <h3 class="tituloTabela">Óbito</h3>
                    {% if obitos is defined %}
                        {% set linstra = 'linstraEscura' %}
                        <table class="tabelaResult">
                            <tr class="tabelaHead">
                                    <th><span>Nome</span></th>
                                    <th><span>Data do Óbito</span></th>
                            </tr>
                            {% for obito in obitos %}
                            <tr class="linstraEscura">
                                    <td><span>{{ obito['nome'] }}</span></td>
                                    <td><span>{{ obito['data_obt'] }}</span></td>
                            </tr>
                            {% endfor %}
                        </table>
                    {% else %}
                        <table class="tabelaResult">
                            <tr class="tabelaHead">
                        	<th><span>Nada Consta</span></th>
                            </tr>
                            <tr class="linstraEscura">
                                <td><span>---</span></td>
                            </tr>
                        </table>
                    {% endif %}
                </div>

            	<div id="mResCpfCont" class="resultadosBuscaDir esconde">
                	
                    <div class="resultHead1">
                    	<strong>Consulta realizada para:</strong>
                        <ul>
                        	<li><span>Este contato foi efetivo?</span></li>
                        	<li><a href="#">Sim</a></li>
                        	<li><a href="#">Não</a></li>
                        </ul>
                    </div>
                    
                    <div class="limpar"></div>
                    
                    <div class="resultHead2">
                    	<h2> <span>{% if cnpjSearch == 0 %}CPF: <strong>{% if tronco is defined %}{{ tronco['CPF'] }}{% endif %}</strong>{% else %}CNPJ:<strong>{% if empresaBR is defined %}{{ empresaBR['CNPJ'] }}{% endif %}</strong>{% endif %}</span>  |  <span>Nome: </span><strong>{% if tronco is defined %}{{ tronco['NOME'] }}{% endif %}{% if empresaBR is defined %}{{ empresaBR['NOME_FANTASIA'] }}{% endif %}</strong></h2>
                    </div>
                    
                    <span class="linhaHead">&nbsp;</span>
                    
                    
                    <h3 class="tituloTabela">CCF (Consulta de cheques)</h3>
                    
                    
                    
                    <table class="tabelaResult">
                    	<tr class="tabelaHead">
                        	<th><span>Nada consta</span></th>
                        </tr>
                        <tr class="linstraEscura">
                        	<td><span>0 cheques devolvidos</span></td>
                        </tr>
                    
                    
                    </table>
                    
                </div>



            	<div id="mResEmpresCont" class="resultadosBuscaDir esconde">
                	
                    <div class="resultHead1">
                    	<strong>Consulta realizada para:</strong>
                        <ul>
                        	<li><span>Este contato foi efetivo?</span></li>
                        	<li><a href="#">Sim</a></li>
                        	<li><a href="#">Não</a></li>
                        </ul>
                    </div>
                    
                    <div class="limpar"></div>
                    
                    <div class="resultHead2">
                    	<h2> <span>{% if cnpjSearch == 0 %}CPF: <strong>{% if tronco is defined %}{{ tronco['CPF'] }}{% endif %}</strong>{% else %}CNPJ:<strong>{% if empresaBR is defined %}{{ empresaBR['CNPJ'] }}{% endif %}</strong>{% endif %}</span>  |  <span>Nome: </span><strong>{% if tronco is defined %}{{ tronco['NOME'] }}{% endif %}{% if empresaBR is defined %}{{ empresaBR['NOME_FANTASIA'] }}{% endif %}</strong></h2>
                    </div>
                    
                    <span class="linhaHead">&nbsp;</span>
                    
                    
                    <h3 class="tituloTabela">CCF (Consulta de cheques)</h3>
                    
                    <a class="bteditarregustro" href="#">editar</a>
                    
                    <table class="tabelaResult">
                    	<tr class="tabelaHead">
                        	<th><span>Grau parentesco</span></th>
                        	<th><span>Nome</span></th>
                        	<th><span>Idade</span></th>
                        </tr>
                        <tr class="linstraEscura">
                        	<td><span>Mãe</span></td>
                        	<td><span>Luiza Regina Rodrigues</span></td>
                        	<td><span>67</span></td>
                        </tr>
                        <tr class="listraBranca">
                        	<td><span>Parente</span></td>
                        	<td><span>Pedro Romeu Rodrigues</span></td>
                        	<td><span>57</span></td>
                        </tr>
                    
                        <tr class="linstraEscura">
                        	<td><span>Empresa</span></td>
                        	<td><span>Brivia Gestao Digital e Tecnologia SA</span></td>
                        	<td><span>0</span></td>
                        </tr>
                    
                    
                    </table>
                    
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