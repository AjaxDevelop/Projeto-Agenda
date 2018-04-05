<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Usuarios'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Pessoas'), ['controller' => 'Pessoas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Pessoa'), ['controller' => 'Pessoas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Listas'), ['controller' => 'Listas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lista'), ['controller' => 'Listas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Observacoes'), ['controller' => 'Observacoes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Observaco'), ['controller' => 'Observacoes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reagendamentos'), ['controller' => 'Reagendamentos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reagendamento'), ['controller' => 'Reagendamentos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Userconfs'), ['controller' => 'Userconfs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Userconf'), ['controller' => 'Userconfs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Pdvs'), ['controller' => 'Pdvs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Pdv'), ['controller' => 'Pdvs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usuarios form large-9 medium-8 columns content">
    <?= $this->Form->create($usuario) ?>
    <fieldset>
        <legend><?= __('Add Usuario') ?></legend>
        <?php
            echo $this->Form->control('pessoa_id', ['options' => $pessoas]);
            echo $this->Form->control('display');
            echo $this->Form->control('email');
            echo $this->Form->control('senha');
            echo $this->Form->control('role');
            echo $this->Form->control('ativo');
            echo $this->Form->control('interno');
            echo $this->Form->control('pdvs._ids', ['options' => $pdvs]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
