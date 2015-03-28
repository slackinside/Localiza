{{content()}}
            <div id="siteGeral">
            <!-- Topo -->
            <div id="siteTopo">
                {{ flash.output() }}
                <header>
                    <div id="TopoConteudo">
                        <div id="siteLogo">
                            <a href="#"><img src="img/logo-topo.jpg" alt="Localiza"/></a>
                        </div>
                        <nav id="siteMenu">
                            <ul>
                                <li id="menuMais"><a onclick="toggle_visibility('topMais')" href="#">Mais</a></li>
                                <div id="topMais">
                                        <p><a class="btn btn-default" href="Board">Board</a></p>
                                        <p><a class="btn btn-default" href="../VendaMais">Venda Mais</a></p>
                                </div>
                                <li id="menuContato"><a href="contact/index">Contato</a></li>
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
                        <a href="#slide1"><img src="img/01.jpg"></a>
                    </li>
                    <li>
                        <div class="textosBanner"><p>2 consulte e localize dados com <br /><strong>EFICIÊNCIA</strong></p></div>
                        <a href="#slide2"><img src="img/02.jpg"></a>
                    </li>
                    <li>
                        <div class="textosBanner"><p>3 consulte e localize dados com <br /><strong>EFICIÊNCIA</strong></p></div>
                        <a href="#slide3"><img src="img/03.jpg"/></a>
                    </li>
                </ul>    
            </div>
            <div class="limpar"></div>
            <!--  Conteudo -->
            <div id="homeConteudo" >
                <div id="homeVideo" class="homeConteudos largura">
                    <div id="homeVideoTexto">
                        <div class="tituloHomes">
                            <h3>COMPLETA</h3>
                        </div>
                        <strong class="subtitulosHome">Não há nada melhor do que uma ferramenta de consulta de dados <br /> bem completa</strong>
                        <br />
                        <br />
                        <p class="textosSansLight">O Localiza é referencia em consulta online, dados e localização. Obtenha informações de pessoas físicas e jurídicas de maneira dinâmica, prática e rápida.</p>
                    </div>
                </div>
                <div class="limpar"></div>
                <div id="homeEncontre">
                    <div id="homeEncontreEsq">
                        <div id="homeEncontreEsqCont">
                            <div class="tituloHomes">
                                <h3>ENCONTRE</h3>
                            </div>
                            <strong class="subtitulosHome">Encontre todos os dados <br />que precisar sem desperdiçar tempo</strong>
                            <br />
                            <br />
                            <p class="textosSansLight">Encontre exatamente o que você procura sem pagar a mais pelo que não precisa. Tenha informaçõeses de telefone e endereço organizadas por ranking e informações de pessoas e endereços relacionados.</p>
                        </div>
                    </div>
                    <div id="homeEncontreDir">
                        <div id="homeEncontreImg"><img src="img/encontre-zoom.jpg" alt="Encontre os dados que você precisa."/></div>
                    </div>
                </div>
                <div class="limpar"></div>
                <div id="homeBusca" class="largura hideme">
                    <div id="homeBuscaNote">
                        <img src="img/home-busca-notebook.png" alt="Busca personalizada, resultados otmizados." />
                    </div>
                    <div id="homeBuscaDados">
                        <div class="tituloHomes">
                            <h3>BUSCA</h3>
                        </div>
                        <strong class="subtitulosHome">Busca personalizada,<br /> resultados otmizados.</strong><br ><br />
                        <p class="textosSansLight">Deixe sua busca automatizada para gerar exatamente os resultados que você mais busca. Ganhe tempo e praticidade com os recursos do InTouch.</p>
                    </div>
                </div>
                <div class="limpar"></div>
                <div id="homeAindaMais" class="largura hideme">
                    <div id="homeAindaMaisConteudo">
                        <div class="tituloHomes">
                            <h3>AINDA MAIS</h3>
                        </div>
                        <strong class="subtitulosHome">Faça ainda mais com as ferramentas<br /> localiza e venda mais</strong>
                        <br />
                        <br />
                        <p class="textosSansLight">Tenha mais opções e recursos com as soluções da Unitfour. Por exemplo, você pode obter o perfil completo de seus contatos utilizando o Datafour. Ou então, personalizar suas consultas com
                            o WSIntouch. Ou seja, um universo de possibilidades de acordo com as suas necessidades.</p>
                    </div>
                    <div id="homeAindaMaisImg"><img src="img/tablet-smart.png" alt="Faça ainda mais com as ferramentas localiza e venda mais" /></div>
                </div>
            </div><!-- Fim Conteudo -->
            <div class="limpar"></div>
            <!-- Site Rodape -->
            <div id="SiteRodape" class="hideme">
                <footer>
                    <div id="LogoRodape">
                        <a title="Localiza Marketing Solutions" href="#"><img src="img/logo-rodape.gif" /></a>
                    </div>
                    <br />
                    <p>Copyright 2014 - Localiza Marketing Solutions</p>
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