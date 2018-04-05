<?php
/* Componente Loading Full. - Criado em 15/05/2017
 *
 * Objetivo: Desabilitar (visualmente) todos os componentes da tela
 * e exibir um ícone de 'carregamento' para o usuário enquanto uma
 * ação (Event Loop) ocorre.
 *
 * Agregar Elemento: Para agregar este componente em seu front-end
 * basta usar o seguinte código em sua View: '$this->element('Layouts/default_loading-full')'.
 *
 * Modo de Uso: Para disparar o evento do componente é necessário
 * utilizar o comando '$('#loading-full').show()' ou utilizar o
 * comando '$('#loading-full').hide()' para para-lo.
 */


    //Insere o CSS de loading.
    echo $this->Html->css('Agenda.loading');
?>

<!-- LOADING -->
<div id="loading-full" style="display: none;">
    <div id="cssload" class="cssload-thecube">
        <div class="cssload-cube cssload-c1"></div>
        <div class="cssload-cube cssload-c2"></div>
        <div class="cssload-cube cssload-c4"></div>
        <div class="cssload-cube cssload-c3"></div>
    </div>
</div>