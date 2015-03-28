{{ content() }}
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            {{ flash.output() }}
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-gears"></i> Pacotes</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-11">
                            <table class="table col-lg-11">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Data de Expiração</th>
                                    <th>Preço</th>
                                    <th>Estado</th>
                                    <th>Ativar/Desativar</th>
                                </tr>
                            </thead>
                            <tbody>
                                {% if packages %}
                                {% for package in packages %}
                                <tr>
                                    <td>{{ package['package_name'] }}</td>
                                    <td>{{ package['package_expire_date'] }}</td>
                                    <td>{{ package['package_price'] }}</td>
                                    <td>{% if package['package_active']==1 %} Ativo {% set status=0, showStatus='Desativar' %} {% else %} Desativo {% set status=1, showStatus='Ativar' %} {% endif %}</td>
                                    <td>{{ link_to("packages/status/"~package['package_id']~"/"~status, showStatus) }}</td>
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
                        <h3 class="panel-title"><i class="fa fa-gears"></i> Adicionar Pacote</h3>
                    </div>
                    <div class="panel-body">
                    {{ form('packages/create', 'method': 'post') }}
                    <p>{{ flash.output() }}</p>
                    {% if selectProducts is not null %}
                    <p>
                    <div class="input-group col-sm-10">
                        <span class="input-group-addon">Produto</span>
                        <select id="product[]" name="product[]" class="selectpicker" multiple>
                            {% for product in selectProducts %}
                                <option value="{{product['product_id']}}">{{ product['product_name'] }}</option>
                            {% endfor %}
                        </select>
                    </div>
                    </p>
                    <p>
                    <div class="input-group col-sm-10">
                        <span class="input-group-addon">Nome</span>
                        {{ text_field("Pacote_nome", "class": "form-control") }}
                    </div>
                    </p>
                    <p>
                    <div class="input-group col-sm-10">
                        <span class="input-group-addon">Data de Expiração</span>
                        {{ date_field("Pacote_dataExpiracao", "class": "form-control") }}
                    </div>
                    </p>
                    <p>
                    <div class="input-group col-sm-7">
                        <span class="input-group-addon">Preço</span>
                        {{ numeric_field("Pacote_preco", "class": "form-control") }}
                        <span class="input-group-addon">R$</span>
                    </div>
                    </p>
                    </p>
                    {{ submit_button('Criar Pacote', 'class': 'btn btn-primary') }}
                    {% else %}
                        <h2>Não pode adicionar pacotes sem produtos cadastrados!</h2>
                    {% endif %}
                </form>
            </div>
        </div>
    </div>
</div>




