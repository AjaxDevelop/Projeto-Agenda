/**
 * Created by CTPM on 16/05/2017.
 */

$(document).ready(function() {
    //Inicializa o recurso Modal.
    $('.modal').modal({
        dismissible: false
    });


    $('body').on('click', '.close_app', function(){
        //Abre o modal.
        $('#modal_exit').modal('open');
    });

    $('body').on('click', '#close_app', function(){
        //Fecha o modal.
        $('#modal_exit').modal('close');
        //Exibe a tela de loading.
        loading(true);
    });

});

$(function(){
    $(".button-collapse").sideNav();
});

//#### FUNÇÕES ####//
function loading(status) {

    var conteudo = $('main').height() + 120;

    $('#loading-full').css('height', '' + conteudo + 'px');

    if (status)
        $('#loading-full').show();
    else
        $('#loading-full').hide();
};
////