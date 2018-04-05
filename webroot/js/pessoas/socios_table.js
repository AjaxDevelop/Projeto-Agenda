/**
 * Created by CTPM on 12/05/2017.
 */

//Listas globais
$(document).ready(function(){

//#### TABELA ####//

    //Variáveis Globais;
    num_socio = $('#socios_count').val();
    socio_temp = [];
    cpfs = [];


    if (num_socio > 0) {
        for (var i = 0; i < num_socio; i++) {
            cpfs.push($('#list_cpf_'+i).val());
        }
    }

    //Valida os dados do Sócio.
    $('body').on('click', '#adicionar', function(){

        //Recebe os dados do sócio.
        var nome  = $('#socio_nome').val(),
            cpf  = $('#socio_cpf').val(),
            telefone  = $('#socio_telefone').val();

        if ($('#socio_nome').valid() && $('#socio_cpf').valid() && $('#socio_telefone').valid() && cpfs.indexOf(cpf) == -1) {
            //Exibe a tela de loading.
            loading(true);

            //Prepara os dados para a requisição.
            var dados = {
                requisicao: 'socio',
                nome: nome,
                cpf_cnpj: cpf,
                telefone: telefone
            };

            //Chama a função 'Pesquisa Sócio'.
            pesquisarSocio(dados);

        }

    });

    //Verifica se o sócio esta cadastrado na base de dados.
    var pesquisarSocio = function(dados) {



        //Realiza a requisição Ajax na base.
        $.ajax({
            method: 'PUT',
            dataType: 'json',
            url: basePath + '/pessoas/pesquisa/.json',
            data: dados,
            success: function(resposta) { console.log(resposta);

                var pessoas = resposta.pessoas;

                if (pessoas.length > 0) {

                    if (pessoas[0].contatos.length > 0) {
                        var contato_id = pessoas[0].contatos[0].id;
                    } else {
                        var contato_id = '';
                    }

                    var socio = {
                        id_table: num_socio,
                        id_socio: pessoas[0].id,
                        nome: dados.nome,
                        cpf: dados.cpf_cnpj,
                        telefone: dados.telefone,
                        contato_id: contato_id
                    };

                    socio_temp = socio;

                    socioExistente(dados.cpf_cnpj);

                } else {

                    var socio = {
                        id_table: num_socio,
                        id_socio: '',
                        nome: dados.nome,
                        cpf: dados.cpf_cnpj,
                        telefone: dados.telefone,
                        contato_id: ''
                    };

                    //Adiconar novo sócio a tabela.
                    addSocio(socio);
                }

                //Exibe a tela de loading.
                loading(false);

            },
            error: function(resposta) {

                console.log('Error object:');
                console.log(resposta);
                console.log('------------');

                //Exibe a tela de loading.
                loading(false);

            }
        });

    };

    //Adiciona um novo sócio a tabela.
    var addSocio = function(socio) {
        var listarSocios = $("#listarSocios").html();
        var compilado = Handlebars.compile(listarSocios);
        var resultado = compilado(socio);
        $('#liSocios').append(resultado);

        //Chama a função Resize Tab.
        resizeTab();

        num_socio = num_socio + 1;
        cpfs.push(socio.cpf);

        //Limpa o formulário
        $('#socio_nome').val("");
        $('#socio_cpf').val("");
        $('#socio_telefone').val("");
    };

    //Remover um sócio da lista
    $('body').on('click', '.remove_socio', function(){
        //Recebe os dados do sócio na tabela.
        var id = $(this).attr('data-id');
        var cpf = $(this).attr('data-cpf');
        var index = cpfs.indexOf(cpf);

        //Remove o socio da lista
        cpfs.pop(index);

        //Remove p sócio da tabela
        $('#socio_' + id).remove();
    });

    //Notifica a existencia de um sócio.
    var socioExistente = function(cpf){
        $('#mensagem_cpf').html(cpf);

        $('#modal_socioExistente').modal('open');
    };

    //Prossegue adicionando um cliente existente.
    $('body').on('click', '#prosseguir', function() {
        //Adiconar novo sócio a tabela.
        addSocio(socio_temp);

        $('#modal_socioExistente').modal('close');
    });
////

});