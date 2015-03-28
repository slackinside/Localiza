{{ content() }}
{{ flash.output() }}
            <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-gears"></i> Clientes</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-10">
                            <table class="table col-lg-5">
                            <thead>
                                <tr>
                                    <th>Nome do Cliente</th>
                                    <th>Status</th>
                                    <th>Ativar/Desativar</th>
                                </tr>
                            </thead>
                            <tbody>
                                {% set status=0 %} {% set showStatus=0 %}
                                {% if clients is not null %}
                                {% for client in clients %}
                                <tr>
                                    <td>{{ client['user_name'] }}</td>
                                    <td>{% for userLogin in usersLogins %}{% if userLogin['userLogin_id'] == client['user_id'] %} {% if userLogin['user_active'] == 1 %} Ativo {% set status=0, showStatus='Desativar' %} {% else %} Desativo {% set status=1, showStatus='Ativar' %} {% endif %} {% endif %}{% endfor %}</td>
                                    <td>{{ link_to("clients/status/"~client['user_id']~"/"~status, showStatus) }}</td>
                                </tr>
                                {% endfor %}
                                {% endif %}
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </div>
</div>        