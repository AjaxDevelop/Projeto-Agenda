/**
 * Created by CTPM on 06/04/2017.
 */
loading(true);

$(window).load(function() {
    loading(false);
});

$(document).ready(function () {

    $('.modal').modal({
        dismissible: false
    });

    $('ul.tabs').tabs();

    //Chama a função Resize Tab.
    resizeTab();

//#### LOADING ####//

    //Personaliza o tamanho do loading padrão.
    var leng = $('main').height(),
        display = $(window).height();

    $('#loading-full').css('height', leng + 'px');
    $('#loading-full').css('min-height', display + 'px');

////

//#### NAVEGAR ENTRE ABAS ####//

    //Simula um clique em uma das abas.
    $('body').on('click', '.touch_tab', function(){
        //Recebe o indicador de navegação.
        var tab = $(this).attr('data-tab');

        //Simula um clique na aba correspondente
        $('#' + tab + '').trigger("click");

        //Volta ao topo da página.
        window.parent.scrollTo(0, 0);

        //Chama a função Resize Tab.
        resizeTab();
    });

    //Ações referentes ao clique nas Tab.
    $('body').on('click', '.tab', function(){
        //Chama a função Resize Tab.
        resizeTab();
    });

    //Habilita as teclas 'ENTER' e 'SPACE'.
    $('body').on('keypress', '.touch_tab', function(e){
        if(e.which == 13 || 32) {
            $(this).trigger("click");
        }
    });

    //Verifica se o diaplay da página foi redimensionado.
    $(window).resize(function(){
        //Chama a função Resize Tab.
        resizeTab();
    });

    //Verifica se o conteúdo da página foi redimensionado.
    $('main').resize(function(){
        //Chama a função Resize Tab.
        resizeTab();
    });
////

//#### VIEW CLIENTE ####//
    $('body').on('click', '.pessoa_selecionada', function(){
        //Prepara os dados da requisição
        var pessoa_id = $(this).attr('data-id');

        var dados = {
            id: pessoa_id
        };

        //Realiza a requisição Ajax
        $.ajax({
            method: 'put',
            dataType: 'json',
            url: basePath + "/pessoas/view/.json",
            data: dados,
            success: function (resposta) { console.log(resposta);

                inputPessoa(resposta.pessoas);

            },
            error: function () {

            }
        });

    });

    //Atualizar lista
    var inputPessoa = function(dados){ console.log(dados);
        var pessoas = $("#listarPessoa").html();
        var compilado = Handlebars.compile(pessoas);
        var resultado = compilado(dados);
        $('#modal_pessoa').html(resultado); console.log(resultado);

        $('#modal_pessoa').modal('open');
    };

////

//#### VERIFICAR O TIPO (PF/PJ) DO CLIENTE ####//

    $('body').on('focusout', '#cpf_cnpj', function() {
        //Recebe o valor do input
        var tamanho  = $(this).val().length;

        switch(tamanho) {
            case 14:
                $('#tipo').val("PF");
                break;
            case 18:
                $('#tipo').val("PJ");
                break;
            default:
                $('#tipo').val("PF");
        }
    });

////

//#### VERIFICAR SE O CLIENTE ESTA CADASTRADO ####//

    $('body').on('focusout', '.verificarCliente', function() {
        //Recebe os dados dos inputs.
        var nome          = $('#nome').val(),
            empresa       = $('#nome_empresa').val(),
            cpf_cnpj      = $('#cnpj').val();

        //Variável de sinalização para a verificação.
        var verificar = false;

        //Verifica o preenchimento do CPF/CNPJ.
        if (cpf_cnpj.length != 14 && cpf_cnpj.length != 18) {
            cpf_cnpj = "";
        } else {
            verificar = true;
        }

        if (verificar) {
            //Prepara os dados para a requisição de verificação.
            var dados = {
                requisicao: 'empresa',
                cpf_cnpj: cpf_cnpj
            };

            //Chama a função que verifica o cadastro junto a Base de Dados.
            verificaPessoa(dados);
        } else {
            //Mantem o botão submit (Salvar) Bloqueado.
            bloquearSubmit();
        }

    });

    //Verificar se a Pessoa esta cadastrada na base de dados.
    var verificaPessoa = function(dados) {
        //Bloqueia o botão submit (Salvar).
        bloquearSubmit();

        //Realiza a requisição Ajax.
        $.ajax({
            method: 'put',
            dataType: 'json',
            url: basePath + '/pessoas/pesquisa/.json',
            data: dados,
            success: function (resposta) {

                var pessoas = resposta.pessoas;

                if (pessoas.length == 0) {

                    liberarSubmit();

                } else {

                    //Montar URL de edição do cadastro
                    var url = basePath + "/pessoas/edit/" + resposta.pessoas[0].id;
                    $("#editar_cadastro").attr('href', url);

                    //Abrir modal
                    $('#modal_cadastro').modal('open');
                }

            },
            error: function () {

            }
        });
    }

    //Bloquear o botão Submit (Salvar) do formulário.
    var bloquearSubmit = function() {
        $('#salvar').addClass('disabled');
    }

    //Liberar o botão Submit (Salvar) do formulário.
    var liberarSubmit = function() {
        $('#salvar').removeClass('disabled');
    }
////

//#### SALVAR FORMULÁRIO (ADD) ####//

    $('body').on('click', '#salvar', function(){

        var form = $('#form_empresa');

        //Bloquei os campos de insersão dos dados de sócios.
        formSocio(true);

        if (form.valid()) {
            //Exibe a tela de loading.
            loading(true);

            //realiza o submit.
            form.submit();

        } else {

            //Exibe o alerta de campos inválidos.
            $('#modal_validacao').modal('open');

            //Libera os campos de insersão dos dados de sócios.
            formSocio(false);

        }
    });

    //Bloquia ou libera os campos referentes aos dados dos sócios.
    var formSocio = function(status) {
        $('#socio_nome').attr('disabled', status);
        $('#socio_cpf').attr('disabled', status);
        $('#socio_telefone').attr('disabled', status);
    };

////

});

//Fixa o conteúdo de navegação no fim da página
function resizeTab() {
    //Recebo o tamanho do display e do conteúdo da página.
    var display = $(window).height();
    var conteudo = $('main').height() + 120;

    if (display > conteudo) {
        $('.navegacao').addClass('navegacao-win');
    } else {
        $('.navegacao').removeClass('navegacao-win');
    }
};
