/**
 * Created by CTPM on 04/04/2017.
 */

//API de busca de cep
var apiBuscaCep = "http://viacep.com.br/ws/";

$(document).ready(function(){
    //Solicita os dados de acordo com o cep passado.
    $('body').on('click', '#buscar_cep', function(){
        //Resgata o CEP
        var cep = $('#cep').val();

        //Chama a função que exexuta a API.
        if (cep.length == 9) {
            buscaCep(cep);
        }
    });
});

//#### FUNÇÃO PARA BUSCAR O CEP JUNTO A API (VIACEP) ####//
function buscaCep(cep) {
    loading(true);
    $('#section-endereco').hide();
    $('#loading-endereco').show();

    //Realiza a requisição dos dados do CEP.
    $.ajax({
        method: 'GET',
        url: apiBuscaCep + cep + "/json",
        data: '',
        success: function(resposta) {
            //Recebe a resposta da requisição.
            var dados = resposta;

            //Verifica se foi encontrado alguma resposta para a requisição.
            if( dados.logradouro == undefined ) {

                $('#loading-endereco').hide();
                $('#section-endereco').show();
                loading(false);

                return;

            } else {
                setarDados(dados);
            }

        },
        error: function(jqXHR, exception) {
            //Reporta erros de conexão.
            console.log('------jqXHR');
            console.log(jqXHR);

            //Reporta erros de exceção.
            console.log('------Exception');
            console.log(exception);

            $('#loading-endereco').hide();
            $('#section-endereco').show();

            loading(false);
        }
    });
}
////

//#### SETAR OS DADOS DO CEP ####//
function setarDados(dados) {
    //Ativar Label
    $('#label-cep').addClass('active');
    $('#label-endereco').addClass('active');
    $('#label-bairro').addClass('active');
    $('#label-cidade').addClass('active');
    $('#label-estado').addClass('active');

    //Inputar dados
    $("#cep").val(dados.cep).valid();
    $("#endereco").val(dados.logradouro).valid();
    $("#bairro").val(dados.bairro).valid();
    $("#cidade").val(dados.localidade).valid();
    $("#estado").val(dados.uf).valid();

    //Fechar tela de loading
    $('#loading-endereco').hide();
    $('#section-endereco').show();
    loading(false);
}
////