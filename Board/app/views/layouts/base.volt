        <div id="wrapper">

            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">LOCALIZA</a>
                </div>

                <ul class="nav navbar-right top-nav">
                    <li class="h7">
                        {% if !name %}{{ link_to('session/new', ' Cadastro', 'class': 'fa fa-plus') }}{% endif %}
                    </li>
                    <li class="h7">
                        {% if name %}{{ link_to('session/end', ' Logout', 'class': 'fa fa-sign-out') }}{% else %}{{ link_to('session', ' Login', 'class': 'fa fa-sign-in') }}{% endif %}
                    </li>
                    <li class="h7">
                        <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {% if name %}{{ name }}{% else %}Bem Vindo - Usuário{% endif %}</a>
                    </li>
                </ul>
                
                {{ content() }}

                