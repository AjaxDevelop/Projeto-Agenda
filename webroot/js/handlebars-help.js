//###### FORMAPA A DATA PARA O PADRÃO 'DD/MM/AAAA' ######//
Handlebars.registerHelper("formatDate", function(date){

    if (typeof(date) == "undefined" || date == null) {
        return "";
    } else {

        time = date.split('T');

        if(time[1] == "00:00:00+0000") {
            time = 1;
        } else {
            time = 0;
        }

        date = new Date(date);

        var day   = date.getDate() + time,
            month = date.getMonth() + 1,
            year  = date.getFullYear()

        if (day < 10)
            day = "0" + day;

        if (month < 10)
            month = "0" + month;

        return day + "/" + month + "/" + year;
    }
});

//###### FORMAPA A HORA PARA O PADRÃO 'HH:MM' ######//
Handlebars.registerHelper("formatHour", function(date){

    if (typeof(date) == "undefined" || date == null) {
        return "";
    } else {
        date = new Date(date);

        var hour   = date.getHours(),
            minute = date.getMinutes()

        if (hour < 10)
            hour = "0" + hour;

        if (minute < 10)
            minute = "0" + minute;

        return hour + ":" + minute;
    }
});

//###### COMPARA SE DOIS VALORES SÃO IGUAIS ######//
Handlebars.registerHelper("ifComp", function(valor1, valor2, options){

    if (Array.isArray(valor2)) { console.log("Teste01");

        var indice = valor2.indexOf(valor1);

        if(indice == -1) {
            return options.fn(this);
        }

        return options.inverse(this);

    } else { console.log("Teste02 : " + Array.isArray(valor2) + " / " + valor2);

        if(valor1 != valor2) {
            return options.fn(this);
        }

        return options.inverse(this);

    }

});
