/**
 * Created by CTPM on 15/05/2017.
 */

$(document).ready( function() {
    $("#form_empresa").validate({
        ignore: [],
        // Define as regras
        rules: {
            "nome": {
                required: true,
                minlength: 3
            },
            "cpf_cnpj": {
                required: true,
                minlength: 18
            },
            "endereco[cep]": {
                required: true,
                minlength: 9
            },
            "endereco[endereco]": {
                required: true,
                minlength: 2
            },
            "endereco[numero]": {
                required: true
            },
            "endereco[bairro]": {
                required: true
            },
            "endereco[cidade]": {
                required: true
            },
            "endereco[estado]": {
                required: true
            },
            "contatos[0][contato]": {
                required: true,
                minlength: 14
            },
            "representante": {
                required: true,
                minlength: 3
            },
            "funcao": {
                required: true,
                minlength: 3
            },
            "contatos[9][contato]": {
                required: true,
                minlength: 14
            },
            "socio_nome": {
                required: true,
                minlength: 3
            },
            "socio_cpf": {
                required: true,
                minlength: 14
            },
            "socio_telefone": {
                required: true,
                minlength: 14
            },
        },
        // Define as mensagens de erro para cada regra
        messages: {
            "nome": {
                required: "Digite o nome da empresa.",
                minlength: "O nome da empresa deve conter, no mínimo, 3 caracteres."
            },
            "cpf_cnpj": {
                required: "Digite um CNPJ válido.",
                minlength: "O CNPJ deve conter, no mínimo, 18 caracteres."
            },
            "endereco[cep]": {
                required: "Digite um CEP válido.",
                minlength: "O CEP deve conter, no mínimo, 9 caracteres."
            },
            "endereco[endereco]": {
                required: "Digite um logradouto válido.",
                minlength: "O logradouro deve conter, no mínimo, 2 caracteres."
            },
            "endereco[numero]": {
                required: "Digite um valor válido."
            },
            "endereco[bairro]": {
                required: "Digite um valor válido."
            },
            "endereco[cidade]": {
                required: "Digite um valor válido."
            },
            "endereco[estado]": {
                required: "Digite um valor válido."
            },
            "contatos[0][contato]": {
                required: "Digite o Telefone de contato",
                minlength: "O Telefone deve conter, no mínimo, 14 caracteres."
            },
            "representante": {
                required: "Digite o nome do representante.",
                minlength: "O nome do representante deve conter, no mínimo, 3 caracteres."
            },
            "funcao": {
                required: "Digite a Função do representante.",
                minlength: "A Função do representante deve conter, no mínimo, 3 caracteres."
            },
            "contatos[4][contato]": {
                required: "Digite o Telefone de contato",
                minlength: "O Telefone deve conter, no mínimo, 14 caracteres."
            },
            "socio_nome": {
                required: "Digite o nome do sócio.",
                minlength: "O nome do sócio deve conter, no mínimo, 3 caracteres."
            },
            "socio_cpf": {
                required: "Digite o CPF do sócio.",
                minlength: "O CPF do sócio deve conter, no mínimo, 14 caracteres."
            },
            "socio_telefone": {
                required: "Digite o Telefone do sócio.",
                minlength: "O Telefone do sócio deve conter, no mínimo, 14 caracteres."
            },
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
});