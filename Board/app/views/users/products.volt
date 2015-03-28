       <div class="col-lg-12">
        <h1 class="page-header">
            Permissões -- <small> Usuário - Produto</small>
        </h1>

<div class="row">
    {{ form('users/assoc', 'id': 'formUP', 'method': 'post') }}
    <div class="col-lg-9">
        {{ flash.output() }}
        <div id="assoc" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-gears"></i> Associe Produtos</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-9">
                   
                    <table class="table col-lg-9">
                    <thead>
                        <tr>
                            <th>ID Produto</th>
                            <th>Descrição</th>
                            <th>Preço Produto</th>
                            <th>Taxa Desconto %</th>
                            <th>Selecionar</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% if products is defined %}
                        {% set counterDiscount = 0 %}   
                        {% set counter=0 %}
                        {% for product in products %}
                        <tr>
                            <td class="col-sm-2">{{ text_field("product_id["~product['product_id']~"]", "value": product['product_id'], "class": "form-control", "readonly": "true") }}</td>
                            <td>{{ product['product_name'] }}</td>
                            <td>{{ product['product_price'] }}</td>
                            <td class="col-sm-2">{{ numeric_field("product_discount["~product['product_id']~"]", "id": "product_discount"~product['product_id'], "class": "form-control") }}</td>
                            <td>{{ check_field("list["~product['product_id']~"]", "value": product['product_id'], "class": "large") }}</td>
                        </tr>
                        {% endfor %}
                        {% endif %}
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="assocEditRem" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-gears"></i> Edite ou Remova Associações</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-11">
                    <table class="table col-lg-11">
                    <thead>
                        <tr>
                            <th>ID Produto</th>
                            <th>Descrição</th>
                            <th>Taxa Desconto %</th>
                            <th>Preço com Desconto</th>
                            <th>Usuário Associado</th>
                            <th>Editar/Remover</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% if usersProducts is defined %}
                        {% set counterDiscount = 0 %}   
                        {% set counter=1 %}
                        {% for userProduct in usersProducts %}
                        <tr>
                            <td class="col-sm-2">{{ text_field("product_id["~userProduct['product_id']~"]", "value": userProduct['product_id'], "class": "form-control", "readonly": "true") }}</td>
                            <td>{{ userProduct['product_name'] }}</td>
                            <td class="col-sm-2">{{ numeric_field("product_discount["~userProduct['product_id']~"-"~userProduct['user_id']~"]", "id": "product_discount"~userProduct['user_id']~userProduct['product_id'], "onclick": "setDiscount("~userProduct['user_id']~","~userProduct['product_id']~", this.id)", "class": "form-control") }}</td>
                            <td>{{ userProduct['product_price_with_discount'] }}</td>
                            <td>{{ userProduct['user_name'] }} {{ hidden_field('user_id', 'id': 'user_id') }}</td>
                            <td><a href="/Localiza/Board/users/editAssoc/1/{{userProduct['user_id']}}/{{userProduct['product_id']}}/0" id="edit{{userProduct['user_id']}}-{{userProduct['product_id']}}" class="btn btn-warning" >Editar</a>  {{ check_field("listAssocEdit["~counter~"]", "value": userProduct['product_id']~"-"~userProduct['user_id'], "onclick": "setAction('/Localiza/Board/users/editAssoc/1/0/0')", "class": "large") }}  <a href="/Localiza/Board/users/remAssoc/1/{{userProduct['product_id']}}/{{userProduct['user_id']}}" class="btn btn-danger" >Remover</a>  {{ check_field("listAssocRem["~counter~"]", "value": userProduct['product_id']~"-"~userProduct['user_id'], "onclick": "setAction('/Localiza/Board/users/remAssoc/1/0/0')", "class": "large") }}</td>
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-gears"></i> Escolha o tipo de Usuário</h3>
            </div>
            <div class="panel-body">
                <div class="input-group col-sm-11">
                    {{ select("type", usersType, "id": "type", 'class': 'form-control', 'using': ['id', 'name'], "onchange": "showByTypeUser(this.value,0)") }}
                </div>
            </div>
        </div>
        <div id="allUsers" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-gears"></i> Escolha Usuário</h3>
            </div>
            <div class="panel-body">
                <div id="users" class="input-group col-sm-11">
                    {{ select("users[]", usersOutAssoc, "id": "users[]", 'class': 'selectpicker', 'using': ['user_id', 'user_name'], 'multiple' : 'multiple') }}
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
                    <p><a href="#" id="editAssoc" onclick="showHideAssocEditRem('/Localiza/Board/users/editAssoc/1/0/0/0')" class="btn btn-warning" >Ver Associações</a>
                    <a href="#" id="createAssoc" onclick="showHideAssocEditRem('/Localiza/Board/users/assoc')" class="btn btn-info" >Criar Associações</a></p>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
</div>