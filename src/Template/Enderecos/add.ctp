<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Enderecos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vendas'), ['controller' => 'Vendas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Venda'), ['controller' => 'Vendas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Pessoas'), ['controller' => 'Pessoas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Pessoa'), ['controller' => 'Pessoas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="enderecos form large-9 medium-8 columns content">
    <?= $this->Form->create($endereco) ?>
    <fieldset>
        <legend><?= __('Add Endereco') ?></legend>
        <?php
            echo $this->Form->control('venda_id', ['options' => $vendas]);
            echo $this->Form->control('pessoa_id');
            echo $this->Form->control('cep');
            echo $this->Form->control('endereco');
            echo $this->Form->control('numero');
            echo $this->Form->control('complemento');
            echo $this->Form->control('referencia');
            echo $this->Form->control('bairro');
            echo $this->Form->control('cidade');
            echo $this->Form->control('estado');
            echo $this->Form->control('cep_instalacao');
            echo $this->Form->control('endereco_instalacao');
            echo $this->Form->control('numero_instalacao');
            echo $this->Form->control('complemento_instalacao');
            echo $this->Form->control('referencia_instalacao');
            echo $this->Form->control('bairro_instalacao');
            echo $this->Form->control('cidade_instalacao');
            echo $this->Form->control('estado_instalacao');
            echo $this->Form->control('pessoas._ids', ['options' => $pessoas]);
            echo $this->Form->control('clientes._ids', ['options' => $clientes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
