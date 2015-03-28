{{ content() }}
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            {{ flash.output() }}
            <div class="col-lg-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-gears"></i> Produtos</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-10">
                            <table class="table col-lg-5">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Estado</th>
                                    <th>Preço</th>
                                    <th>Ativar/Desativar</th>
                                </tr>
                            </thead>
                            <tbody>
                                {% if products %}
                                {% for product in products %}
                                <tr>
                                    <td>{{ product['product_name'] }}</td>
                                    <td>{% if product['product_active']==1 %} Ativo {% set status=0, showStatus='Desativar' %} {% else %} Desativo {% set status=1, showStatus='Ativar' %} {% endif %}</td>
                                    <td>{{ product['product_price']}}</td>
                                    <td>{{ link_to("products/status/"~product['product_id']~"/"~status, showStatus) }}</td>
                                </tr>
                                {% endfor %}
                                {% endif %}
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-gears"></i> Adicionar Produto</h3>
                    </div>
                    <div class="panel-body">
                        {{ form('products/create', 'method': 'post') }}
                        <p>
                            <label for="name">Nome do Produto</label>
                            {{ text_field("Produto_nome", "size": 32) }}
                        </p>
                        <p>
                            <label for="name">Preço do Produto</label>
                            {{ numeric_field("Produto_preco", "size": 32) }}
                            <span>R$</span>
                        </p>
                        <p>
                            {{ submit_button('Adicionar','class': 'btn btn-primary') }}
                        </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




