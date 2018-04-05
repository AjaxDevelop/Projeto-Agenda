/**
 * Created by CTPM on 05/04/2017.
 */

//var basePath = "http://localhost/agenda/agenda";

if(window.location.hostname == 'overmin.overneti.com.br' && location.port != '')
{

    var basePath = "http://overmin.overneti.com.br:9091/agenda";

}
else if(window.location.hostname == 'overmin.overneti.com.br')
{

    var basePath = "http://overmin.overneti.com.br/agenda";

}
else if(window.location.hostname == 'dev2.overneti.com.br')
{

    var basePath = "http://dev2.overneti.com.br/overmin/agenda";

}
else if(window.location.hostname == 'localhost')
{

    var basePath = "http://localhost/overmin/agenda";

}

console.log(basePath);