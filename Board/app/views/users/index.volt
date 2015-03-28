{{ content() }}
{% set userType = {'Administrador', 'Supervisor', 'Usuario'} %}
            {{ flash.output() }}
            <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-gears"></i> Usuários</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-10">
                            <table class="table col-lg-5">
                            <thead>
                                <tr>
                                    <th>Usuário do Login</th>
                                    <th>Tipo</th>
                                    <th>Status</th>
                                    <th>Ativar/Desativar</th>
                                </tr>
                            </thead>
                            <tbody>
                                {% if usersLogin != null %}
                                {% for userLogin in usersLogin %}
                                    {% if userLogin['user_type'] > 0 %}
                                    <tr>
                                        <td>{{ userLogin['username'] }}</td>
                                        <td>{% if userLogin['user_type'] == 1 %} Administrador {% endif %}{% if userLogin['user_type'] == 2 %} Supervisor {% endif %}{% if userLogin['user_type'] == 3 %} Usuário {% endif %}</td>
                                        <td>{% if userLogin['user_active'] == 1 %} Ativo {% set status=0, showStatus='Desativar' %} {% else %} Desativo {% set status=1, showStatus='Ativar' %} {% endif %}</td>
                                        <td>{{ link_to("users/status/"~userLogin['userLogin_id']~"/"~status, showStatus) }}</td>
                                    </tr>
                                    {% endif %}
                                {% endfor %}
                                {% endif %}
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </div>
</div>