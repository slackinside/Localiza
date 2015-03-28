<p>{{ flash.output() }}</p>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="login-or-signup">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header">
                        <h2>Log In</h2>
                    </div>
                    {{ form('session/start', 'class': 'form-inline') }}
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="email">Login de Usuário</label>
                                <div class="controls">
                                    {{ text_field('Usuario_login', 'size': "30", 'class': "input-xlarge") }}
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="password">Password</label>
                                <div class="controls">
                                    {{ password_field('Usuario_password', 'size': "30", 'class': "input-xlarge") }}
                                </div>
                            </div>
                            <br>
                            <div class="form-actions">
                                <p>
                                {{ submit_button('Login', 'class': 'btn btn-primary btn-large') }}
                                </p>
                            </div>
                        </fieldset>
                    </form>
                </div>

                <div class="span6">
                    <div class="page-header">
                        <h2>Ainda não está cadastrado?</h2>
                    </div>

                    <p>Ao criar uma conta você pode usufruir das seguintes vantagens:</p>
                    <ul>
                        <li>Criar/Alterar/Apagar Utilizadores de vário tipos;</li>
                        <li>Associar Produtos a estes utilizadores;</li>
                        <li>Localizar Produtos com base em vários filtros.</li>
                    </ul>

                    <div class="clearfix center">
                        {{ link_to('session/new', ' Cadastro', 'class': 'btn btn-primary btn-large btn-success fa fa-plus') }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

