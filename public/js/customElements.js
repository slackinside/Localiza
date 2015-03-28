/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('div.alert').delay(1500).fadeOut(1500);
$('#generatedInfo').hide();

function getAdmins(cliente_id, userType)
{
    cliente_id = document.getElementById('client').value;
    $.get("http://localhost/Localiza/Board/users/getadmins/" + cliente_id + "/" + userType, function (data) {
        $('#selects').html(data);
    });
}

function getSupers(admin_id)
{
    $.get("http://localhost/Localiza/Board/users/getsupers/" + admin_id, function (data) {
        $('#supers').html(data);
    });

}

function showByClient(cliente_id)
{
    $.get("http://localhost/Localiza/Board/clients/products/" + cliente_id, function (data) {
        $('#body').html(data);
    });

}

function showByTypeUser(userType, usuario_id) {
    $.get("http://localhost/Localiza/Board/users/products/" + userType + "/" + usuario_id, function (data) {
        $('#body').html(data);
    });
}

function verifyAssoc(usuario_id, pacote_id) {
    $.get("http://localhost/Localiza/Board/clients/verifyassoc/" + usuario_id + "/" + pacote_id, function (data) {
        $('#assoc').html(data);
    });
}

function generateTable() {
    $.get("http://localhost/Localiza/Board/bilhetagem/generate", function (data) {
        $('#table').html(data);
    });
    $('#generatedInfo').show();
}

$(document).ready(function () {
    if (window.location.hash == "#hide") {
        $("#clientsBar").hide();
        $("#clientsHeader").html("Shopping<small> -- Comece a comprar aqui os pacotes disponibilizados</small>")
    }
});

function checkCPFCNPJ(cpf_cnpj) {
    if (cpf_cnpj.indexOf("0001") > -1 || cpf_cnpj.indexOf("0001") > -1) {
        $('#opcoesAvancadas').hide();
        $('#OpPessFis').hide();
        $('#OpPessJur').show();
        $('#menuPf_PJ').html('<li id="OpPessJur" class="OpPessJurAtv"><a href="javascript:void(0);" onClick="tipoPessoa(\'OpPessJur\')">Pessoa Jurídica</a></li>');
    } else {
        $('#opcoesAvancadas').show();
        $('#OpPessFis').show();
        $('#OpPessJur').hide();
        $('#menuPf_PJ').html('<li id="OpPessFis" class="OpPessFisAtv"><a href="javascript:void(0);" onClick="tipoPessoa(\'OpPessFis\')">Pessoa Física</a></li>');

    }
}

$(document).ready(function () {
    //$('#busca').donetyping(function(){
    var elem = $('#busca');
    // Save current value of element
    elem.data('oldVal', elem.val());

    // Look for changes in the value
    elem.bind("propertychange change click keyup input paste", function (event) {
        // If value has changed...
        if (elem.data('oldVal') != elem.val()) {
            // Updated stored value
            elem.data('oldVal', elem.val());

            // Do action
            checkCPFCNPJ(document.getElementById('busca').value);
        }
    });
});
