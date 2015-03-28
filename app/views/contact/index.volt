<div id="siteGeral">
	<!-- Topo -->
	<div id="siteTopo">
    	<header>
        	<div id="TopoConteudo">
                <div id="siteLogo">
                    <a href="#"><img src="../img/logo-topo.jpg" alt="Localiza"/></a>
                </div>
                <nav id="siteMenu">
                    <ul>
                        <li id="menuMais"><a href="../VendaMais/">Mais</a></li>
                        <li id="menuContato"><a href="#">Contato</a></li>
                        <li id="menuEntrar">
                            <a onclick="toggle_visibility('topLogin')" href="#">Entrar</a>
                            <div id="topLogin">
                                {{ form('session/start', 'class': 'form-inline') }}
                                    <div>{{ text_field('Usuario_login', 'class': "input-xlarge", 'value': 'Usuário') }}</div>
                                    <div>{{ password_field('Usuario_password', 'class': "input-xlarge", 'value': 'Senha') }}</div>
                                    <button>Fazer Login</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
    </div><!-- Fim Topo -->
    <div class="limpar"></div>
    <div id="siteDestaques">
	<ul id="slippry-demo">
	  <li>
      	<div class="textosBanner"><p>1 consulte e localize dados com <br /><strong>EFICIÊNCIA</strong></p></div>
		<a href="#slide1"><img src="../img/01.jpg"></a>
	  </li>
	  <li>
      	<div class="textosBanner"><p>2 consulte e localize dados com <br /><strong>EFICIÊNCIA</strong></p></div>
		<a href="#slide2"><img src="../img/02.jpg"></a>
	  </li>
	  <li>
      	<div class="textosBanner"><p>3 consulte e localize dados com <br /><strong>EFICIÊNCIA</strong></p></div>
		<a href="#slide3"><img src="../img/03.jpg"/></a>
	  </li>
	</ul>    
	</div>
    <div class="limpar"></div>
    <!--  PAGINA INTERNA -->
    <div id="internaContato" class="largura">
        <div class="tituloInternas">
            <h3>CONTATO</h3>
        </div>
        
        <div class="textosSansLight">
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip.</p></div>
    
    
    	<div id="formContato">
            <form action="#" name="contato" method="post" onsubmit="return validaFormulario(this);">
                <div id="contatoEsc">
                	<div id="divNome" class="inputNormal"><input type="text" name="nome" value="Nome" onblur="if(this.value=='') this.value='Nome';" onfocus="if(this.value=='Nome') this.value='';" /></div>
                	<div id="divEmail" class="inputNormal"><input type="text" name="email" value="E-mail" onblur="if(this.value=='') this.value='E-mail';" onfocus="if(this.value=='E-mail') this.value='';" /></div>
                </div>
                <div id="contatoDirr">
                    <div id="inputTel" class="inputNormal"><input type="text" name="telefone" value="Telefone" onblur="if(this.value=='') this.value='Telefone';" onfocus="if(this.value=='Telefone') this.value='';" /></div>
                    <div class="inputNormal">
                    	<select>
                        	<option>O que você deseja?</option>
                        </select>
                    </div>
                </div>
                
                <div class="limpar"></div>
				<div id="texAreaContato" class="texnormal">
                	<textarea onblur="if(this.value=='') this.value='Mensagem';" onfocus="if(this.value=='Mensagem') this.value='';" name="mensagem">Mensagem</textarea>
                </div>
                
                <button>Enviar</button>
            </form>
        </div>
        
<script>
	function validaFormulario(){
		var erro = false;
		var x = document.contato;
		var alerta = "Atenção! Preencha os campos destacados corretametne: \n"
		//Valida Nome
		if(x.nome.value < 4 || x.nome.value=='Nome'){
			erro = true;

			$('#divNome').removeClass('inputNormal').addClass('inputErro');
		}else{
			$('#divNome').removeClass('inputErro').addClass('inputNormal');
		}
		// Valida email
		if(!valida_email(x.email.value)){
			erro = true;
			$('#divEmail').removeClass('inputNormal').addClass('inputErro');
		}else{
			$('#divEmail').removeClass('inputErro').addClass('inputNormal');
		}
		
		// Valida telefone
		if(x.telefone.value < 4 || x.telefone.value=='Telefone'){
				erro = true;

			$('#inputTel').removeClass('inputNormal').addClass('inputErro');
		}else{
			$('#inputTel').removeClass('inputErro').addClass('inputNormal');
		}
		// Valida mensagem
		if(x.mensagem.value < 4 || x.mensagem.value=='Mensagem'){
				erro = true;

			$('#texAreaContato').removeClass('texnormal').addClass('texareaErro');
		}else{
			$('#texAreaContato').removeClass('texareaErro').addClass('texnormal');
		}
		

		if(erro){
			alert(alerta);
			return false;
		}
	
	}

</script>
        <div class="limpar"></div>
        
        
        
        
        
    </div><!-- FIM INTERNA -->
    
        <div id="contatoInfo">
        
        	<div class="largura">
            	<ul>
                	<li id="contatoEnd">
                    	<img src="../img/contatoendereco.gif" />
                        <strong>Endereço</strong>
                        <p class="textosSansLight">NONONONOONO</p>
                    </li>
                	<li id="contatoTel">
                    	<img src="../img/contatotelefone.gif" />
                        <strong>Telefones</strong>
                        <p class="textosSansLight">Fone: 99999999999</p>
                    </li>
                	<li id="contatoemail">
                    	<img src="../img/contatoemail.gif" />
                        <strong>E-mail</strong>
                        <p class="textosSansLight">atendimento@localiza.com.br</p>
                    </li>
                </ul>
            
            </div>
        
        </div>
    
    
    <div class="limpar"></div>
    <!-- Site Rodape -->
    <div id="SiteRodape" class="hideme">
    	<footer>
        	<div id="LogoRodape">
            	<a title="Localiza Marketing Solutions" href="#"><img src="../img/logo-rodape.gif" /></a>
            </div>
            <br />
        	<p>Copyright © 2014 - Localiza Marketing Solutions</p>
        </footer>
    </div>
</div>
 <!-- Banner Destaque -->
        <script>
            jQuery(document).ready(function() {
                jQuery('#slippry-demo').slippry()
            });
        </script>
        <!-- Fade In Scroll -->
        <script>
            $(document).ready(function() {
                /* Every time the window is scrolled ... */
                $(window).scroll(function() {
                    /* Check the location of each desired element */
                    $('.hideme').each(function(i) {
                        var bottom_of_object = $(this).position().top + $(this).outerHeight();
                        var bottom_of_window = $(window).scrollTop() + $(window).height();
                        /* If the object is completely visible in the window, fade it it */
                        if (bottom_of_window > bottom_of_object) {
                            $(this).animate({'opacity': '1'}, 500);
                        }
                    });
                });
            });
        </script>
        <script type="text/javascript">
            function toggle_visibility(id) {
                var e = document.getElementById(id);
                if (e.style.display == 'block')
                    e.style.display = 'none';
                else
                    e.style.display = 'block';
            }
        </script>