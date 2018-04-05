<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Projeto Agenda';

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>

    <!-- Materialize - Complementos -->
    <?= $this->Html->script('Agenda.jquery-2.1.1') ?>
    <?= $this->Html->css('Agenda.icons') ?>

    <!-- Materialize - Framework -->
    <?= $this->Html->script('Agenda.materialize') ?>
    <?= $this->Html->css('Agenda.materialize') ?>
    <?= $this->Html->css('Agenda.global') ?>

    <!-- Handlebars -->
    <?= $this->Html->script('Agenda.handlebars-v4.0.5') ?>
    <?= $this->Html->script('Agenda.handlebars-help') ?>

    <!-- Links -->
    <?= $this->Html->script('Agenda.links') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <?php
        //Global
        echo $this->Html->script('Agenda.global');

        //Loading
        echo $this->element('Layout/loading-full');
    ?>
    <div id="modal_exit" class="modal blue white-text">
        <div class="modal-content">
            <div class="row">
                <div>
                    <h4><small>Deseja Sair?</small></h4>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a id="close_app" href="<?php echo $this->Url->build(["plugin" => false, "controller" => "Usuarios", "action" => "logout"]); ?>" class="modal-action waves-effect waves-brown btn-flat">Sim</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Não</a>
        </div>
    </div>
    <nav class="theme">
        <div class="container">
            <div class="nav-wrapper">
                <a href="<?php echo $this->Url->build(['controller'=>'visitas','action'=>'index'],true) ?>" class="brand-logo"><i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="Visitas" style="font-size: 45px">today</i></a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <?php if (isset($menu_relatorio) && $menu_relatorio) { ?>
                        <li><a href="<?php echo $this->Url->build(["controller" => "Visitas", "action" => "relatorio"]); ?>"><i class="material-icons right tooltipped" data-position="bottom" data-delay="50" data-tooltip="Relatório">show_chart</i></a></li>
                        <li><a href="<?php echo $this->Url->build(["plugin" => false, "controller" => "Vendas", "action" => "index"]); ?>"><i class="material-icons right tooltipped" data-position="bottom" data-delay="50" data-tooltip="Acompanhar vendas">view_list</i></a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo $this->Url->build(["plugin" => false, "controller" => "Vendas", "action" => "acompanhamento"]); ?>"><i class="material-icons right tooltipped" data-position="bottom" data-delay="50" data-tooltip="Acompanhar vendas">view_list</i></a></li>
                    <?php } ?>
                    <li><a href="<?php echo $this->Url->build(["plugin" => false, "controller" => "Usuarios", "action" => "configuracoes"]); ?>"><i class="material-icons right tooltipped" data-position="bottom" data-delay="50" data-tooltip="Configurar conta">settings</i></a></li>
                    <li><a href="#"><i class="material-icons right tooltipped close_app" data-position="bottom" data-delay="50" data-tooltip="Sair do sistema">power_settings_new</i></a></li>
                </ul>
                <ul class="side-nav" id="mobile-demo">
                    <?php if (isset($menu_relatorio) && $menu_relatorio) { ?>
                        <li><a href="<?php echo $this->Url->build(["controller" => "Visitas", "action" => "relatorio"]); ?>"><i class="material-icons right tooltipped" data-position="bottom" data-delay="50" data-tooltip="Relatório">show_chart</i></a></li>
                        <li><a href="<?php echo $this->Url->build(["plugin" => false, "controller" => "Vendas", "action" => "index"]); ?>"><i class="material-icons center tooltipped" data-position="bottom" data-delay="50" data-tooltip="Acompanhar vendas">view_list</i></a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo $this->Url->build(["plugin" => false, "controller" => "Vendas", "action" => "acompanhamento"]); ?>"><i class="material-icons center tooltipped" data-position="bottom" data-delay="50" data-tooltip="Acompanhar vendas">view_list</i></a></li>
                    <?php } ?>
                    <li><a href="<?php echo $this->Url->build(["plugin" => false, "controller" => "Usuarios", "action" => "configuracoes"]); ?>"><i class="material-icons center tooltipped" data-position="bottom" data-delay="50" data-tooltip="Configurar conta">settings</i></a></li>
                    <li><a href="#"><i class="material-icons center tooltipped close_app" data-position="bottom" data-delay="50" data-tooltip="Sair do sistema">power_settings_new</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <main class="row container">
        <?= $this->fetch('content') ?>
    </main>
    <footer class="page-footer theme">
        <div class="footer-copyright">
            <div class="container">
                © 2017 Overneti - Beta distribution
            </div>
        </div>
    </footer>
</body>
</html>
