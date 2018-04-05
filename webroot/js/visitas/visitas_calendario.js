/**
 * Created by CTPM on 26/04/2017.
 */

$(document).ready(function () {

//#########################################################################################//
    //#### RECURSOS DO CALENDÁRIO ####//
//#########################################################################################//

//#### CONFIGURAR CALENDÁRIO ####//

    //Iniciar calendário
    $("#my-calendar").zabuto_calendar({
        language: "pt",
        today: true,
        legend: [
            {type: "block", label: "Hoje", classname: "hoje"},
            {type: "block", label: "Clientes Visitados"},
        ],
        nav_icon: {
            prev: '<i class="material-icons prefix">fast_rewind</i>',
            next: '<i class="material-icons prefix">fast_forward</i>'
        },
        action: function() { console.log("Chamou");
            //Pega a data selecionada
            var data = this.getAttribute('data-action');
            var dados = {data: data};

            //Chama afunção que requisita a lista de visitas agendadas
            listarVisitas(dados);

            //Inverte o padrão da data.
            var data_br = inverteData(data);

            //Altera a data na sessão "Visitas".
            alterDate(data_br);

            //Reinicia o select do filtro.
            $('#filtro_vendedor').prop('selectedIndex', 0)
            $('select').material_select();
            $('#filtro-form').hide();

        },
        action_nav: function(){

        },
        ajax:{
            url: basePath + "/visitas/view/all.json"
        }
    });

////

//#########################################################################################//
    //#### VISITAS REALIZADAS ####//
//#########################################################################################//

//#### LISTAR VISITAS ####//

    //Função para alterar a data selecionada.
    function alterDate(data) {
        $('#dia_atual').text(data);
        $('#data').val(data);
    }

    //Inicializa a lista de agendamentos de acordo com a data atual.
    var dados = {data: inverteData($('#dia_atual').text())};
    listarVisitas(dados);

    //Função para requisitar uma lista de visitas realizadas na data selecionada.
    function listarVisitas(dados) {
        //Exibe o ícone de loading.
        loading(true);
        $('#listar_visitas').hide();
        $('#mensagem-lista').hide();
        $('#loading-lista').show();

        //Realiza a requisição.
        $.ajax({
            method: 'POST',
            url: basePath + '/visitas/view/all.json',
            'data': dados,
            dataType: 'json',
            success: function(resposta) { console.log(resposta);
                //Recebe a resposta da requisição
                var dados = resposta;

                if (dados.length > 0 || dados.visitas.length > 0) {
                    //Chama a função 'Input Lista' para exibir a lista de visitas encontrada.
                    inputLista(dados);

                    //Exibe o filtro de busca.
                    $('#filtro-form').show();
                } else {
                    $('#loading-lista').hide();
                    $('#mensagem-lista').show();
                    loading(false);
                }
            },
            error: function() {

            }
        });
    }

    //Atualizar lista
    var inputLista = function(dados){
        var visitas = $("#listarVisitas").html();
        var compilado = Handlebars.compile(visitas);
        var resultado = compilado(dados);
        $('#lista-table').html(resultado);

        $('#mensagem-lista').hide();
        $('#loading-lista').hide();
        $('#listar_visitas').show();
        loading(false);

        $('select').material_select();
    };
////

//#### EXIBIR VISITA ####//

    $('body').on('click', '.visita_selecionada', function(){
        //Prepara os dados da requisição
        var visita_id = $(this).attr('data-id');

        var dados = {
            id: visita_id
        };

        //Realiza a requisição Ajax
        $.ajax({
            method: 'put',
            dataType: 'json',
            url: basePath + "/visitas/view/.json",
            data: dados,
            success: function (resposta) {

                inputVisita(resposta);

            },
            error: function () {

            }
        });

    });

    //Atualizar view
    var inputVisita = function(dados){
        var visitas = $("#listarVisita").html();
        var compilado = Handlebars.compile(visitas);
        var resultado = compilado(dados);
        $('#modal_visita').html(resultado);

        $('#modal_visita').modal('open');
    };


////

//#### FILTRO DE VIVITAS ####//

    $('body').on('click', '#filtrar', function(){

        //Recebe os dados do filtro.
        var data = inverteData($("#data").val()),
            vendedor = $('#filtro_vendedor').val()

        //Prepara os dados para a requisição.
        var dados = {
            data: data,
            vendedor: vendedor
        };

        //Chama a função 'Listar Visitas' para reconstruir a lista de acordo com o filtro.
        listarVisitas(dados);

    });

////

//#### HISTÓRICO DE VIVITAS ####//

    $('body').on('click', '.visita_historico', function(){
        //Carrega a tela de loading
        loading(true);

        //Recebe o id da empresa.
        var empresa_id = $(this).attr('data-empresa'); console.log(empresa_id);

        //Prepara os dados para a requisição.
        var dados = {
            requisicao: 'empresa',
            id_empresa: empresa_id
        };

        //Realiza a requisição ajax para buscar o historico de visitas da empresa
        $.ajax({
            method: 'post',
            dataType: 'json',
            url: basePath + '/visitas/historico/.json',
            data: dados,
            success: function(resposta) { console.log(resposta);

                if (resposta.pacote.count_visitas > 0) {
                    inputHistorico(resposta.pacote);
                } else {
                    //Encerra a tela de loading
                    loading(false);
                }
            },
            error: function(resposta) {
                //Exibe o log de erro.
                console.log('//ERROR//');
                console.log(resposta);
                console.log('////');

                //Encerra a tela de loading
                loading(false);
            }
        });
    });

    //Exibir histórico
    var inputHistorico = function(dados){
        var historico = $("#listarHistorico").html();
        var compilado = Handlebars.compile(historico);
        var resultado = compilado(dados);
        $('#modal_historico').html(resultado);

        //Encerra a tela de loading
        loading(false);

        //Abrir modal.
        $('#modal_historico').modal('open');

    };

////
});