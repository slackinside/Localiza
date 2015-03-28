<div class="col-lg-12">
        <h1 class="page-header">
            Permissões -- <small> Cliente - Produto</small>
        </h1>

<div class="row">
    {{ form('clients/assoc', 'id': 'formUP', 'method': 'post') }}
    <div class="col-lg-9">
        {{ flash.output() }}
        <div id="assoc" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-gears"></i> Selecione os Produtos a Associar</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-9">
                   
                    <table class="table col-lg-9">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Preço Produto</th>
                            <th>Taxa Desconto %</th>
                            <th>Preço Unitário Consulta</th>
                            <th>Selecionar</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% if products is defined %}
                        {% set counterDiscount = 0 %}   
                        {% set counter=0 %}
                        {% for product in products %}
                        <tr>
                            <td>{{ product['product_name'] }}</td>
                            <td>{{ product['product_price'] }}</td>
                            <td class="col-sm-2">{{ numeric_field("product_discount["~product['product_id']~"]", "id": "product_discount"~product['product_id'], "class": "form-control") }}</td>
                            <td class="col-sm-2">{{ numeric_field("query_price["~product['product_id']~"]", "id": "query_price"~product['product_id'], "class": "form-control") }}</td>
                            <td>{{ check_field("list["~product['product_id']~"]", "value": product['product_id'], "class": "large") }}</td>
                        </tr>
                        {% set counter+=1 %}
                        {% endfor %}
                        {% endif %}
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="assocEditRem" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-gears"></i> Selecione os Produtos a Associar</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-11">
                    <table class="table col-lg-11">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Taxa Desconto %</th>
                            <th>Preço Unitário Consulta</th>
                            <th>Preço com Desconto</th>
                            <th>Usuário Associado</th>
                            <th>Editar/Remover</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% if clientsProducts is defined %}
                        {% set counterDiscount = 0 %}   
                        {% set counter=1 %}
                        {% for clientProduct in clientsProducts %}
                        <tr>
                            <td>{{ clientProduct['product_name'] }}</td>
                            <td class="col-sm-2">{{ numeric_field("product_discount["~clientProduct['product_id']~"-"~clientProduct['user_id']~"]", "id": "product_discount"~clientProduct['user_id']~clientProduct['product_id'], "onclick": "setDiscount("~clientProduct['user_id']~","~clientProduct['product_id']~", document.getElementById("query_price"~clientProduct['user_id']~clientProduct['product_id']).id, this.id)", "value": clientProduct['product_discount'], "class": "form-control") }}</td>
                            <td class="col-sm-2">{{ numeric_field("query_price["~clientProduct['product_id']~"-"~clientProduct['user_id']~"]", "id": "query_price"~clientProduct['user_id']~clientProduct['product_id'], "onclick": "setDiscount("~clientProduct['user_id']~","~clientProduct['product_id']~", this.id, document.getElementById("product_discount"~clientProduct['user_id']~clientProduct['product_id']).id)", "value": clientProduct['query_price'], "class": "form-control") }}</td>
                            <td>{{ clientProduct['product_price_with_discount'] }}</td>
                            <td>{{ clientProduct['user_name'] }} {{ hidden_field('user_id', 'id': 'user_id') }}</td>
                            <td><a href="/Localiza/Board/users/editAssoc/1/{{clientProduct['user_id']}}/{{clientProduct['product_id']}}/0/0" id="edit{{clientProduct['user_id']}}-{{clientProduct['product_id']}}" class="btn btn-warning" >Editar</a>  {{ check_field("listAssocEdit["~counter~"]", "value": clientProduct['product_id']~"-"~clientProduct['user_id'], "onclick": "setAction('/Localiza/Board/users/editAssoc/1/0/0')", "class": "large") }}  <a href="/Localiza/Board/users/remAssoc/1/{{clientProduct['product_id']}}/{{clientProduct['user_id']}}" class="btn btn-danger" >Remover</a>  {{ check_field("listAssocRem["~counter~"]", "value": clientProduct['product_id']~"-"~clientProduct['user_id'], "onclick": "setAction('/Localiza/Board/users/remAssoc/1/0/0')", "class": "large") }}</td>
                        </tr>
                        {% set counter+=1 %}
                        {% endfor %}
                        {% endif %}
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="selects" class="col-lg-3">
        <div id="allUsers" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-gears"></i> Escolha Cliente(s)</h3>
            </div>
            <div class="panel-body">
                <div id="users" class="input-group col-sm-11">
                    {{ select("clients[]", clientsOutAssoc, "id": "clients[]", 'class': 'selectpicker', 'using': ['user_id', 'user_name'], 'multiple' : 'multiple') }}
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-gears"></i> Controlos</h3>
            </div>
            <div class="panel-body">
                <div class="col-sm-3">
                    <p>{{ submit_button('Realizar Associações', 'id': 'finishAssoc', "class": "btn btn-success") }}
                    {{ submit_button('Realizar Alterações', 'id': 'finishEditAssoc', "class": "btn btn-success") }}
                    <p><a href="#" id="editAssoc" onclick="showHideAssocEditRem('/Localiza/Board/clients/editAssoc/1/0/0/0')" class="btn btn-warning" >Ver Associações</a>
                    <a href="#" id="createAssoc" onclick="showHideAssocEditRem('/Localiza/Board/clients/assoc')" class="btn btn-info" >Criar Associações</a></p>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
</div>