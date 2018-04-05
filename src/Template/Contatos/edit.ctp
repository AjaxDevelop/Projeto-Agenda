<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contato->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $contato->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Contatos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vendas'), ['controller' => 'Vendas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Venda'), ['controller' => 'Vendas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Pessoas'), ['controller' => 'Pessoas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Pessoa'), ['controller' => 'Pessoas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contatos form large-9 medium-8 columns content">
    <?= $this->Form->create($contato) ?>
    <fieldset>
        <legend><?= __('Edit Contato') ?></legend>
        <?php
            echo $this->Form->control('venda_id', ['options' => $vendas]);
            echo $this->Form->control('pessoa_id', ['options' => $pessoas, 'empty' => true]);
            echo $this->Form->control('contato');
            echo $this->Form->control('tipo');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
