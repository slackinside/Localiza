/* Valida E-mail */
function valida_email(email) {
    var expressao = /^[\w-]+(\.[\w-]+)*@(([A-Za-z\d][A-Za-z\d-]{0,61}[A-Za-z\d]\.)+[A-Za-z]{2,6}|\[\d{1,3}(\.\d{1,3}){3}\])$/;
    return expressao.test(email);
}

function mostraConteudoRes(id) {
    $('.resultadosBuscaDir').addClass('esconde');
    $('#' + id + 'Cont').removeClass('esconde').addClass('mostra');
    $('#menuResulEsqMenu ul li').removeClass('menuResAtivo').addClass('mSimpRes');
    $('#' + id).removeClass('mSimpRes').addClass('menuResAtivo');
}
$(document).ready(function(){
if ( $( "#mResDadosCNPJ" ).length ){
    mostraConteudoRes('mResDadosCNPJ');
}else{
    mostraConteudoRes('mResLocal');
}
});
function mostraConteudo(id) {
    $('.conteudoMuda').addClass('esconde');
    $('#' + id + 'Cont').removeClass('esconde').addClass('mostra');
    $('#testeli li').removeClass('menuAtivo').addClass('menuSimples');
    $('#' + id).removeClass('menuSimples').addClass('menuAtivo');

    $('#mLocalizacao').removeClass('menuSimples').addClass('menuSimplesL');

    if (id == 'mLocalizacao') {
        $('#testeli li').removeClass('menuAtivo').addClass('menuSimples');
        $('#mLocalizacao').removeClass('menuSimples').addClass('menuSimplesL');
        $('#mLocalizacao').removeClass('menuSimplesL').addClass('menuAtivoL');
    }
}
mostraConteudo('mLocalizacao')

function toggle_Logado(id) {

    var e = document.getElementById(id);
    if (e.style.display == 'block') {
        e.style.display = 'none';

        $('#btMaior').removeClass('btMaiorAtivo').addClass('btMaiorNormal');
    } else {
        e.style.display = 'block';

        $('#btMaior').removeClass('btMaiorNormal').addClass('btMaiorAtivo');
    }

}

function toggle_Mop(id) {

    var e = document.getElementById(id);
    if (e.style.display == 'block') {
        e.style.display = 'none';

        $('#escolhaOp').removeClass('escolhaOpAtv').addClass('escolhaOpNorm');
    } else {
        e.style.display = 'block';

        $('#escolhaOp').removeClass('escolhaOpNorm').addClass('escolhaOpAtv');
    }

}

$('#opcoesAvancadas').click(function () {
    $('#buscaAvancada').show();
    $('#divbtFechaBusca').show();
    $('#opcoesAvancadas').hide();
});

$('#btFechaBusca').click(function () {
    $('#buscaAvancada').hide();
    $('#divbtFechaBusca').hide();
    $('#opcoesAvancadas').show();

});

function tipoPessoa(id) {
    if (id == 'OpPessJur') {
        $('.pessoaFisica').hide();
        $('#OpPessJur').removeClass('OpPessJur').addClass('OpPessJurAtv');
        $('#OpPessFis').removeClass('OpPessFisAtv').addClass('OpPessFis');
        $('#SitaPF_PJ').removeClass('SitaPF').addClass('SitaPJ');
    } else {
        $('.pessoaFisica').show();
        $('#OpPessJur').removeClass('OpPessJurAtv').addClass('OpPessJur');
        $('#OpPessFis').removeClass('OpPessFis').addClass('OpPessFisAtv');
        $('#SitaPF_PJ').removeClass('SitaPJ').addClass('SitaPF');
    }

}

tipoPessoa('OpPessFis');

function menuacancado(id) {
    //alert('Oi');

    if (id == 'porNome') {
        $('#porNome').removeClass('pornomeS').addClass('pornomeA');
        $('#porTelefone').removeClass('porteA').addClass('porteS');
        $('#porCep').removeClass('porCepA').addClass('porCepS');
        $('#porEnd').removeClass('porEndA').addClass('porEndS');
        $('#porInss').removeClass('porbeneA').addClass('porbeneS');

        $('.conteudosteste').removeClass('mostra').addClass('esconde');
        $('#buscaNomeCont').removeClass('esconde').addClass('mostra');

    }

    if (id == 'porTelefone') {
        $('#porNome').removeClass('pornomeA').addClass('pornomeS');
        $('#porTelefone').removeClass('porteS').addClass('porteA');
        $('#porCep').removeClass('porCepA').addClass('porCepS');
        $('#porEnd').removeClass('porEndA').addClass('porEndS');
        $('#porInss').removeClass('porbeneA').addClass('porbeneS');

        $('.conteudosteste').removeClass('mostra').addClass('esconde');
        $('#buscatelCont').removeClass('esconde').addClass('mostra');
    }

    if (id == 'porCep') {
        $('#porNome').removeClass('pornomeA').addClass('pornomeS');
        $('#porTelefone').removeClass('porteA').addClass('porteS');
        $('#porCep').removeClass('porCepS').addClass('porCepA');
        $('#porEnd').removeClass('porEndA').addClass('porEndS');
        $('#porInss').removeClass('porbeneA').addClass('porbeneS');

        $('.conteudosteste').removeClass('mostra').addClass('esconde');
        $('#buscacepCont').removeClass('esconde').addClass('mostra');
    }

    if (id == 'porEnd') {
        $('#porNome').removeClass('pornomeA').addClass('pornomeS');
        $('#porTelefone').removeClass('porteA').addClass('porteS');
        $('#porCep').removeClass('porCepA').addClass('porCepS');
        $('#porEnd').removeClass('porEndS').addClass('porEndA');
        $('#porInss').removeClass('porbeneA').addClass('porbeneS');

        $('.conteudosteste').removeClass('mostra').addClass('esconde');
        $('#buscaendCont').removeClass('esconde').addClass('mostra');
    }


    if (id == 'porInss') {
        $('#porNome').removeClass('pornomeA').addClass('pornomeS');
        $('#porTelefone').removeClass('porteA').addClass('porteS');
        $('#porCep').removeClass('porCepA').addClass('porCepS');
        $('#porEnd').removeClass('porEndA').addClass('porEndS');
        $('#porInss').removeClass('porbeneS').addClass('porbeneA');

        $('.conteudosteste').removeClass('mostra').addClass('esconde');
        $('#buscainssCont').removeClass('esconde').addClass('mostra');

    }

}
menuacancado('porNome');

function mostraConteudoRes(id){
			$('.resultadosBuscaDir').addClass('esconde');
			$('#'+id+'Cont').removeClass('esconde').addClass('mostra');
			$('#menuResulEsqMenu ul li').removeClass('menuResAtivo').addClass('mSimpRes');
			$('#'+id).removeClass('mSimpRes').addClass('menuResAtivo');
			
		}
mostraConteudoRes('mResLocal')