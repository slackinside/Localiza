{{ content() }}

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Usuário<small> -- Cadastro</small>
                </h1>
            </div>
        </div>
        {{ form('users/register', 'method': 'post') }}
            <p>{{ flash.output() }}</p>
            <p>
            <h3><label class="label label-default">Informação de Contato</label></h3>
            </p>
            <p>
            <div class="input-group col-sm-3">
                <span class="input-group-addon">Nome de Contato</span>
                {{ text_field("Usuario_nome_contato", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-3">
                <span class="input-group-addon">Telefone de Contato</span>
                {{ text_field("Usuario_telefone_contato", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-4">
                <span class="input-group-addon">E-mail de Contato</span>
                {{ text_field("Usuario_email_contato", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-4">
                <span class="input-group-addon">Morada de Contato</span>
                {{ text_field("Usuario_morada_contato", "class": "form-control") }}
            </div>
            </p>
            <p>
            <h3><label class="label label-default">Informação de Login</label></h3>
            </p>
            <p>
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
            <p>
            <div class="input-group col-sm-1">
                <div id="selects">
                <h3><label class="label label-default">Usuário Tipo</label></h3>
                {{ select("type", userType, 'class': 'form-control', 'using': ['id', 'name'], "onchange": "getAdmins(document.getElementById('client').value,this.value)") }}
                <h3><label class="label label-default">Associação Cliente</label></h3>
                {{ select("client", clients, 'class': 'form-control', 'using': ['user_id', 'user_name'], "onchange": "getAdmins(this.value,document.getElementById('type').value)") }}
                </div>
            </div>
            </p>
            <br>
            <div id="cadatroBTN">
            <p>
            {{ submit_button('Cadastrar', 'class': 'btn btn-primary') }}
            </p>
            </div>
    </form>
    </div>
</div>
</div>