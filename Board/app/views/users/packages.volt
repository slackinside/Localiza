{{ content() }}
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Usuário<small> -- Gestão de Pacotes</small>
                </h1>
            </div>
        </div>
        <div class="row">
            {{ form('users/assocPackage', 'method': 'post') }}
            <div class="col-lg-8">
                {{ flash.output() }}    
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-gears"></i> Grelha de Usuários</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-10">
                            <table class="table col-lg-5">
                                <thead>
                                    <tr>
                                        <th>ID Pacote</th>
                                        <th>Nome do Pacote</th>
                                        <th>Preço do Pacote</th>
                                        <th>Cliente Associado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {% if userPackages is defined %}
                                    {% for package in packages %}
                                    {% for userPackage in userPackages %}
                                    <tr>
                                        {% if userPackage.Pacote_id is defined %}<td>{{ package.Pacote_id }}</td><td>{{ package.Pacote_nome }}</td><td>{{ package.Pacote_preco }}</td>{% else %}{% break %}{% endif %}
                                        <td>{% for user in users if userPackage.Usuario_id is defined And userPackage.Usuario_id == user.Usuario_id %} {{ user.Usuario_nome }} {% set counter +=1 %} {% endfor %} {% if counter==0 %} Não {% endif %} </td>
                                    </tr>
                                    {% endfor %}
                                    {% endfor %}
                                    {% endif %}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="selects" class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-gears"></i> Associação Cliente - Pacote</h3>
                    </div>
                    <div class="panel-body">
                        <h4><span class="label label-default">Cliente</span></h4>
                        <div class="input-group col-sm-11">
                            {{ select("user", usersSelect, "id": "user", 'class': 'form-control', 'using': ['id', 'name'], 'onchange': 'verifyAssoc(this.value,document.getElementById("pacote").value)') }}
                        </div>
                        <h4><span class="label label-default">Pacote</span></h4>
                        <div id="users" class="input-group col-sm-11">
                            {{ select("pacote", packagesSelect, "id": "pacote", 'class': 'form-control', 'using': ['id', 'name'], 'onchange': 'verifyAssoc(document.getElementById("user").value, this.value)') }}
                        </div>
                        <br>
                        <p>
                            <div id="assoc">
                            {{ hidden_field('status', 'value': status) }}
                            {{ submit_button(showStatus, 'class': 'btn btn-primary') }}
                            </div>
                        </p>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
                               