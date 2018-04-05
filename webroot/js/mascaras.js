/**
 * Created by CTPM on 04/04/2017.
 */


$('document').ready(function(){

    //Gera mascara para o CPF ou CNPJ no campo (CPF_CNPJ).
    $("#cpf_cnpj").keydown(function(){

        try {
            $("#cpf_cnpj").unmask();
        } catch (e) {}

        var tamanho = $("#cpf_cnpj").val().length;

        if(tamanho < 11){
            $("#cpf_cnpj").mask("999.999.999-99");
        } else {
            $("#cpf_cnpj").mask("99.999.999/9999-99");
        }

    });

    $("#cpf_cnpj").focusout(function(){

        if($("#cpf_cnpj").val().length == 14){
            $("#cpf_cnpj").unmask();
            $("#cpf_cnpj").mask("999.999.999-99");
        }

    });

    //Mascara TELEFONE/CELULAR
    $(".telefone_celular").keydown(function() {

        try {
            $(this).unmask();
        } catch (e) {}

        var tamanho = $(this).val().length;

        if(tamanho < 10){
            $(this).mask("(99) 9999-9999");
        } else if(tamanho >= 10){
            $(this).mask("(99) 99999-9999");
        }
    });

    $(".telefone_celular").focusout(function(){
        var tamanho = $(this).val().length;

        if(tamanho == 14) {
            $(this).unmask();
            $(this).mask("(99) 9999-9999");
        }

    });

    //Mascara DATA
    $('.data').mask('99/99/9999',{placeholder:"dd/mm/aaaa"});

    //Mascara DATA
    $('.hora').mask('99:99',{placeholder:"HH:MM"});

    //Mascara TELEFONE (FIXO)
    $('.telefone').mask('(99) 9999-9999');

    //Mascara TELEFONE (FIXO SEM DDD)
    $('.fixo').mask('9999-9999');

    //Mascara CELULAR
    $('.celular').mask('(99) 99999-9999');

    //Mascara CEP
    $('.cep').mask('99999-999');

    //Mascara CPF
    $('.cpf_mask').mask('999.999.999-99');

    //Mascara CNPJ
    $('.cnpj_mask').mask('99.999.999/9999-99');

});