/**
 * Created by CTPM on 26/04/2017.
 */

loading(true);

$(window).load(function() {
    loading(false);
});

$(document).ready(function () {

//#########################################################################################//
    //#### RECURSOS ####//
//#########################################################################################//

//#### RECURSOS DO FRAMEWORK MATERIALIZE CSS ####//

    //Inicializar o(s) campo(s) do tipo 'select'.
    $('select').material_select();

    //Inicializar o acesso aos modais.
    $('.modal').modal({
        dismissible: false
    });

////

});

//#########################################################################################//
//#### FUNÇÕES ADICIONAIS ####//
//#########################################################################################//

// ###### Converte a data para do padrão 'dd/mm/aaaa' para 'yyyy/dd/mm' ou do padrão 'yyyy/dd/mm' para 'dd/mm/aaaa' #############################
function inverteData(data) {

    if(data.search("-") == 4) { //Verifica se a data esta no padrão americano (0000-00-00).
        var varDate = data.split('-');
        //Reconstroi a data no padrão brasileiro.
        data = varDate[2]+"/"+varDate[1]+"/"+varDate[0];
        //Responde a requisição.
        return data;
    } else { //Realiza a operação considerendo que a data esta no padrão brasileiro (00/00/0000).
        //Separa o dia mes e ano em um vetor.
        var varDate = data.split('/');
        //Reconstroi a data no padrão americano.
        data = varDate[2]+"-"+varDate[1]+"-"+varDate[0];
        //Responde a requisição.
        return data;
    }

}

//Compara dois horarios (HH:MM).
function compararHora(hora1, hora2, callback) { console.log(hora1.length + " | " + hora2.length);
    //Variável que contém a resposta para a requisição.
    var resposta = true;

    //Verifica o comprimento das variáveis dos horários.
    if (hora1.length == 5 && hora2.length == 5) {

        //Separa a hora dos minutos dos horários recebidos.
        hora1 = hora1.split(":");
        hora2 = hora2.split(":");

        //Converte os horários recebidos em um objeto.
        var d = new Date();
        var data1 = new Date(d.getFullYear(), d.getMonth(), d.getDate(), hora1[0], hora1[1]);
        var data2 = new Date(d.getFullYear(), d.getMonth(), d.getDate(), hora2[0], hora2[1]);

        //Compara os horarios
        if ((data1.getTime() > data2.getTime()) || (data1.getTime() == data2.getTime())) {
            resposta = false;
        }

    } else {
        resposta = false;

    }

    //Verifica se uma função de CallBack foi passada por parâmetro.
    if (callback != undefined) {
        //Chama a função de CallBack.
        callback(resposta);
    } else {
        //Retorna a variável 'resposta' para a requisição.
        return resposta;

    }

}