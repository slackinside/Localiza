{{ content() }}
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Master<small> -- Cadastro</small>
                </h1>
            </div>
        </div>
        {{ form('session/register', 'method': 'post') }}
            <p>{{ flash.output() }}</p>
            <p>
            <h3><label class="label label-default">Informação de Contato</label></h3>
            <div class="input-group col-sm-4">
                <span class="input-group-addon">Nome do Master</span>
                {{ text_field("Usuario_nome", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-6">
                <span class="input-group-addon">Email de Contato</span>
                {{ text_field("Usuario_email", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-3">
                <span class="input-group-addon">Telefone de Contato</span>
                {{ text_field("Usuario_telefone", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-10">
                <span class="input-group-addon">Morada de Contato</span>
                {{ text_field("Usuario_morada", "class": "form-control") }}
            </div>
            </p>
            <p>
            <h3><label class="label label-default">Informação de Login</label></h3>
            <div class="input-group col-sm-4">
                <span class="input-group-addon">Usuário de Login</span>
                {{ text_field("Usuario_login", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-5">
                <span class="input-group-addon">Digite a Password</span>
                {{ password_field("Usuario_password", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-5">
                <span class="input-group-addon">Confirme a Password</span>
                {{ password_field("Usuario_password_conf", "class": "form-control") }}
            </div>
            </p>
            {{ submit_button('Cadastrar', 'class': 'btn btn-primary', 'onclick': 'return SignUp.validate();') }}
    </form>
    </div>
</div>
</div>
    
                               