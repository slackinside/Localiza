/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('div.alert').delay(1500).fadeOut(1500);
$('#generatedInfo').hide();
$('input[type="checkbox"]').checkbox();
$('#assocEditRem').hide();
$('#createAssoc').hide();
$('#finishEditAssoc').hide();


function showHideAssocEditRem(action){
    $('#assocEditRem').toggle();
    $('#assoc').toggle();
    $('#finishAssoc').toggle();
    $('#editAssoc').toggle();
    $('#createAssoc').toggle();
    $('#finishEditAssoc').toggle();
    $('#allUsers').toggle();
    $('#formUP').get(0).setAttribute('action', action);
}

function setBilhBol(title){
    $('#bilhBol').html(title);
}

function setDiscount(user_id, product_id, idQP, idD){
    var elemD = $('#'+idD);
    var elemQP = $('#'+idQP);
    // Save current value of element
    elemD.data('oldVal', elemD.val());
    elemQP.data('oldVal', elemQP.val());

    // Look for changes in the value
    elemD.bind("propertychange change click keyup input paste", function (event) {
        // If value has changed...
        if (elemD.data('oldVal') != elemD.val()) {
            // Updated stored value
            elemD.data('oldVal', elemD.val());

            // Do action
            $('#edit'+user_id+'-'+product_id).get(0).setAttribute('href', '/Localiza/Board/users/editAssoc/1/'+user_id+'/'+product_id+'/'+elemQP.val()+'/'+elemD.val());
        }
    });
    // Look for changes in the value
    elemQP.bind("propertychange change click keyup input paste", function (event) {
        // If value has changed...
        if (elemQP.data('oldVal') != elemQP.val()) {
            // Updated stored value
            elemQP.data('oldVal', elemQP.val());

            // Do action
            $('#edit'+user_id+'-'+product_id).get(0).setAttribute('href', '/Localiza/Board/users/editAssoc/1/'+user_id+'/'+product_id+'/'+elemQP.val()+'/'+elemD.val());
        }
    });
    
}

function setAction(action){
    $('#formUP').get(0).setAttribute('action', action);
}

function getAdmins(cliente_id, userType)
{
    cliente_id = document.getElementById('client').value;
    $.get("http://localhost/Localiza/Board/users/getadmins/" + cliente_id + "/" + userType, function(data) {
        $('#selects').html(data);
    });
}

function getSupers(admin_id)
{
    $.get("http://localhost/Localiza/Board/users/getsupers/" + admin_id, function(data) {
        $('#supers').html(data);
    });
    
}

function showByClient(cliente_id)
{
    $.get("http://localhost/Localiza/Board/clients/products/" + cliente_id, function(data) {
        $('#body').html(data);
    });
    
}

function showByTypeUser(userType,usuario_id){
    $.get("http://localhost/Localiza/Board/users/products/"+ userType +"/"+ usuario_id, function(data) {
        $('#body').html(data);
    });
}

function verifyAssoc(usuario_id, pacote_id){
    $.get("http://localhost/Localiza/Board/clients/verifyassoc/"+ usuario_id +"/"+ pacote_id, function(data) {
        $('#assoc').html(data);
    });
}

function generateTable(){
    $.get("http://localhost/Localiza/Board/bilhetagem/generate", function(data) {
        $('#table').html(data);
    });
    $('#generatedInfo').show();
}

$(document).ready( function(){
   if(window.location.hash == "#hide"){
       $("#clientsBar").hide();
       $("#clientsHeader").html("Shopping<small> -- Comece a comprar aqui os pacotes disponibilizados</small>")
   }
   
   });