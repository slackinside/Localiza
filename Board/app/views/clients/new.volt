<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Cliente
                </h1>
            </div>
        </div>
        {{ form('clients/register', 'method': 'post') }}
            <p>{{ flash.output() }}</p>
            <p>
            <div class="input-group col-sm-3">
                <span class="input-group-addon">CNPJ/CPF</span>
                {{ text_field("Cliente_cnpj", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-6">
                <span class="input-group-addon">Razão Social</span>
                {{ text_field("Cliente_razao_social", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-5">
                <span class="input-group-addon">Nome Fantasia</span>
                {{ text_field("Cliente_nome_fantasia", "class": "form-control") }}
            </div>
            </p>
            <p>
            <h3><label class="label label-default">Endereço Fiscal</label></h3>
            <div class="input-group col-sm-8">
                <span class="input-group-addon">Rua/Av</span>
                {{ text_field("Cliente_fiscal_endereco_rua_av", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-2">
                <span class="input-group-addon">Número</span>
                {{ text_field("Cliente_fiscal_numero", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-4">
                <span class="input-group-addon">Complemento</span>
                {{ text_field("Cliente_fiscal_complemento", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-3">
                <span class="input-group-addon">CEP</span>
                {{ text_field("Cliente_fiscal_cep", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-3">
                <span class="input-group-addon">Bairro</span>
                {{ text_field("Cliente_fiscal_bairro", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-3">
                <span class="input-group-addon">Cidade</span>
                {{ text_field("Cliente_fiscal_cidade", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-3">
                <span class="input-group-addon">Estado</span>
                {{ text_field("Cliente_fiscal_estado", "class": "form-control") }}
            </div>
            </p>
            <h3><label class="label label-default">Endereço Correspondência</label></h3>
            <div class="input-group col-sm-8">
                <span class="input-group-addon">Rua/Av</span>
                {{ text_field("Cliente_correspondencia_endereco_rua_av", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-2">
                <span class="input-group-addon">Número</span>
                {{ text_field("Cliente_correspondencia_numero", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-4">
                <span class="input-group-addon">Complemento</span>
                {{ text_field("Cliente_correspondencia_complemento", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-2">
                <span class="input-group-addon">CEP</span>
                {{ text_field("Cliente_correspondencia_cep", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-3">
                <span class="input-group-addon">Bairro</span>
                {{ text_field("Cliente_correspondencia_bairro", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-3">
                <span class="input-group-addon">Cidade</span>
                {{ text_field("Cliente_correspondencia_cidade", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-3">
                <span class="input-group-addon">Estado</span>
                {{ text_field("Cliente_correspondencia_estado", "class": "form-control") }}
            </div>
            </p>
            <p>
            <h3><label class="label label-default">Informação de Contato</label></h3>
            </p>
            <p>
            <div class="input-group col-sm-3">
                <span class="input-group-addon">Nome de Contato</span>
                {{ text_field("Cliente_nome_contato", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-3">
                <span class="input-group-addon">Telefone de Contato</span>
                {{ text_field("Cliente_telefone_contato", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-4">
                <span class="input-group-addon">E-mail de Contato</span>
                {{ text_field("Cliente_email_contato", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-4">
                <span class="input-group-addon">Morada de Contato</span>
                {{ text_field("Cliente_morada_contato", "class": "form-control") }}
            </div>
            </p>
            <p>
            <h3><label class="label label-default">Informação de Login</label></h3>
            </p>
            <p>
            <div class="input-group col-sm-4">
                <span class="input-group-addon">Usuário de Login</span>
                {{ text_field("Cliente_login", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-5">
                <span class="input-group-addon">Digite a Password</span>
                {{ password_field("Cliente_password", "class": "form-control") }}
            </div>
            </p>
            <p>
            <div class="input-group col-sm-5">
                <span class="input-group-addon">Confirme a Password</span>
                {{ password_field("Cliente_password_conf", "class": "form-control") }}
            </div>
            </p>
            <p>
            {{ submit_button('Cadastrar', 'class': 'btn btn-primary', 'onclick': 'return SignUp.validate();') }}
            </p>
    </form>
    </div>
</div>
</div>