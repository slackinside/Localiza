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
    <div class="limpar"></div>
    <br />
    <!--  PAGINA INTERNA -->
    <div id="internaContato" class="largura">
        <div class="tituloInternas">
            <h3>Fale Connosco</h3>
        </div>
        
        <div class="textosSansLight">
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip.</p></div>
    
    
    	<div id="formContato">
            <form action="#" name="contato" method="post" onsubmit="return validaFormulario(this);">
                <div id="contatoDir">
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