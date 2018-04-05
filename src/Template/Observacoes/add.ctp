<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Observacoes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vendas'), ['controller' => 'Vendas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Venda'), ['controller' => 'Vendas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Visitas'), ['controller' => 'Visitas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Visita'), ['controller' => 'Visitas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="observacoes form large-9 medium-8 columns content">
    <?= $this->Form->create($observaco) ?>
    <fieldset>
        <legend><?= __('Add Observaco') ?></legend>
        <?php
            echo $this->Form->control('venda_id', ['options' => $vendas]);
            echo $this->Form->control('visita_id', ['options' => $visitas, 'empty' => true]);
            echo $this->Form->control('usuario_id', ['options' => $usuarios]);
            echo $this->Form->control('observacao');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
