<div id="body" class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="/Localiza/Board/" title="Dashboard"><i class="fa fa-fw fa-bar-chart-o"></i>Painel inicial</a>
        </li>
        <li>
            <a href="/Localiza/Board/products" title="Produtos"><i class="fa fa-fw fa-bar-chart-o"></i>Produtos</a>
        </li>
        <!--<li>-->
            <!--<a href="/Localiza/Board/packages" title="Pacotes"><i class="fa fa-fw fa-bar-chart-o"></i>Pacotes</a>-->
        <!--</li>-->
        <li>
            <a href="/Localiza/Board/users" title="Usuários"><i class="fa fa-fw fa-table"></i>Usuários</a>
        </li>
        <li class="active">
            <a href="/Localiza/Board/clients" title="Clientes"><i class="fa fa-fw fa-table"></i>Clientes</a>
        </li>
        <li>
            <a href="/Localiza/Board/bilhetagem" title="Bilhetagem"><i class="fa fa-fw fa-table"></i>Bilhetagem</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-fw fa-file"></i>Sobre</a>
        </li>
    </ul>
</div>
</nav>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 id="clientsHeader" class="page-header">
                    Clientes<small> -- Comece a gerir os seus Clientes</small>
                </h1>
            </div>
        </div>
        <div id="page-wrapper">
    <div class="container-fluid">
        <nav id="clientsBar" class="navbar navbar-inverse" role="navigation">

                <div class="nav navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand">Controlos</a>
                </div>
                <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                <input type="text" class="form-control col-sm-1" placeholder="CNPJ">
                </div>
                <div class="form-group">
                <input type="text" class="form-control col-sm-3" placeholder="Razão Social">
                </div>
                <div class="form-group">
                <input type="text" class="form-control col-sm-3" placeholder="Nome Fantasia">
                </div>
                <button type="submit" class="btn btn-default">Filtrar</button>
                </form>    
                <ul class="nav navbar-right top-nav">
                    <li>
                        {{ link_to('clients/new', ' Cliente', 'class': 'fa fa-plus') }}
                    </li>
                    <li>
                        {{ link_to('clients/products/-1', ' Produtos', 'class': 'fa fa-plug') }}
                    </li>
                    <!--<li>-->
                        <!--{{ link_to('clients/packages/', ' Pacotes', 'class': 'fa fa-cube') }}-->
                    <!--</li>-->
                    <li>
                        {{ link_to('clients/shopping/', ' Compras', 'class': 'fa fa-shopping-cart') }}
                    </li>
                </ul>
            </nav>
            <br>
        {{ content() }}
    </div>
</div>
</div>