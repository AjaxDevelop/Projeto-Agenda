/**
 * Created by CTPM on 05/04/2017.
 */

$(window).load(function() {

//#### VERIFICAR STATUS ####//
    verificarStatus();
////

});


$(document).ready(function () {

//#########################################################################################//
    //#### FORMULÁRIO DE VISITAS ####//
//#########################################################################################//

//#### PESQUISAR CLIENTE ####//

    //Busca um cliente quando clicar no botão de pesquisa.
    $('body').on('click', '#buscar', function(){
        //Chama a função 'Buscar Pessoa'.
        buscarPessoa();
    });

    //Pesquisa pelo cliente na base de dados.
    var buscarPessoa = function () {
        //Chama a função 'desabilitarNome'
        desabilitarNome();

        //Recebe o nome digitado.
        var nome = $('#nome').val();

        //Loading
        loading(true);
        $('.visita-form').hide();
        $('.loading-form').show();

        //Prepara os dados para a requisição.
        var dados = {
            nome: nome
        };

        //Realiza a requisição Ajax
        $.ajax({
            method: 'post',
            dataType: 'json',
            url: basePath + "/pessoas/pesquisa_empresa/.json",
            data: dados,
            success: function (resposta) {
                //Variáveis
                var size = resposta.pessoas.length;

                if (size > 0) {
                    inputClientes(resposta);
                } else {
                    $('#pessoa_id').val("");

                    $('.loading-form').hide();
                    $('.visita-form').show();
                    loading(false);

                    $('#modal_busca').modal('open');
                }

            },
            error: function () {

            }
        });
    }

    //Atualizar lista
    var inputClientes = function(dados){
        var visitas = $("#listarClientes").html();
        var compilado = Handlebars.compile(visitas);
        var resultado = compilado(dados);
        $('#modal_clientes').html(resultado);

        $('.loading-form').hide();
        $('.visita-form').show();
        loading(false);

        $('#modal_clientes').modal('open');
    };

    //Seleciona um cliente
    $('body').on('click', '.cliente_selecionado', function(){
        //Recebe a sinalização dos campos de horário
        var horario = $('#horario_controle').attr('data-controle');

        //Recebe os dados do cliente
        var cliente_id = $(this).attr('data-id');
        var cliente_nome = $(this).attr('data-nome');

        //Ativa o label do campo 'nome'.
        $('#nome').prev('label').addClass('active');

        //Preenche os respectivos campos
        $('#pessoa_controle').attr('data-controle', true);
        $('#pessoa_id').val(cliente_id);
        $('#nome').val(cliente_nome);
        $('#modal_clientes').modal('close');

        //Libera o submit do formulário
        if (horario == 'true') {
            liberarSubmit();
        }
    });

    //Monitora mudanças no campo nome.
    $('body').on('keyup', '#nome', function(){
        //Chama a função 'desabilitarNome'
        desabilitarNome();
    });

    //Desabilita o 'submit' em caso de mudança do nome.
    var desabilitarNome = function() {
        $('#pessoa_id').val("");
        $('#pessoa_controle').attr('data-controle', false);
        bloquearSubmit();
    }

////

//#### VERIFICAR DATA ####//

    $('body').on('change', '#data', function(){
        //Recebe o valor do campo 'data'.
        var data = $(this).val();

        //Variável de sinalização da data
        var sinalizacao = true;

        //Verifica se um status foi selecionado
        if (data.length != 10) {
            //Bloqueia a sinalização do status
            sinalizacao = false;

        }

        //Realiza a sinalização da data
        $('#data_controle').attr('data-controle', sinalizacao);

        //Verifica os status de sinalização.
        if (sinalizacao) {
            //Chama a função que libera o botão submit (Salvar).
            liberarSubmit();

        } else {
            //Bloqueia o botão submit (Salvar).
            bloquearSubmit();

            //Exibe a mensagem de alerta.
            $('#modal_data').modal('open');

        }

    });

////

//#### VERIFICAR HORÁRIO ####//

    //Verifica se o horario inicial não é maios que o horario final.
    $('body').on('focusout', '.horario', function(){ console.log('........');
        //Recebe os dados dos inputs.
        var horario_inicial = $('#horario_inicial').val(),
            horario_final   = $('#horario_final').val()

        if (horario_inicial != "" && horario_final != "") {
            compararHora(horario_inicial, horario_final, horarioControle);
        }
    });

    //Trata o formulário de acordo com os horarios informados.
    var horarioControle = function(resposta) { console.log(resposta);
        //Variável de sinalização.
        var sinalizacao = false;

        if (resposta) {
            //Sinaliza a liberação de horário
            sinalizacao = true;
        }

        //Insere a sinalização
        $('#horario_controle').attr('data-controle', sinalizacao);

        //Verifica a sinalização do horário.
        if (sinalizacao) {
            //Liberar o botão submit (Salvar).
            liberarSubmit();

        } else {
            //Bloqueia o botão submit (Salvar).
            bloquearSubmit();

            //Exibe a mensagem de alerta.
            $('#modal_horario').modal('open');

        }


    };

////

//#### VERIFICAR STATUS ####//

    $('body').on('change', '#status_edit', function() {
        verificarStatus();
    });

////

//#### VERIFICAR OBSERVAÇÃO ####//

    //Verifica se houve alguma alteração na observação da visita (Edit)
    $('body').on('change', '#observacao_edit', function() {
        liberarSubmit();
    });

////

//#### SALVAR VISITA ####//

    //Realiza o submit no formulário
    $('body').on('click', '#salvar', function(){
        loading(true);
        $(this).prop("disabled", true );

        //Realiza o submit no formulário.
        if (!$('#form_visita').submit()) {
            loading(false);
        };

        //Desabilita o botão de submit
        $(this).prop("disabled", true );

        //Desabilita o formulario
        $('#form_visita').prop("disabled", true );
    });

////

});

//#### FUNÇÕES #### //

function verificarStatus() { console.log("Verificar Status");
    //Variáveis
    var status      = $('#status_edit :selected').val(),
        sinalizacao = true;

    //Verifica se um status foi selecionado
    if (status == "") {
        //Bloqueia a sinalização do status
        sinalizacao = false;

    }

    //Realiza a sinalização do Status
    $('#status_controle').attr('data-controle', sinalizacao);

    //Verifica os status de sinalização.
    if (sinalizacao) {
        //Chama a função que libera o botão submit (Salvar).
        liberarSubmit();

    } else {
        //Bloqueia o botão submit (Salvar).
        bloquearSubmit();

    }
}

//Função para bloquear o acesso ao botão submit.
function bloquearSubmit() {
    //Desabilita o botão submit (Salvar).
    $('#salvar').addClass('disabled');
}

//Função que libera o acesso ao botão submit.
function liberarSubmit() {
    //Recebe os dados de controle.
    var pessoa      = $('#pessoa_controle').attr('data-controle'),
        data        = $('#data_controle').attr('data-controle'),
        hora        = $('#horario_controle').attr('data-controle'),
        status      = $('#status_controle').attr('data-controle')

    //Verifica os status de controle.
    if (pessoa == "true" && data == "true" && hora == "true" && status == "true") {
        //Habilita o botão submit (Salvar).
        $('#salvar').removeClass('disabled');
    } else {
        //Desabilita o botão submit (Salvar).
        bloquearSubmit();
    }
};


////