<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Contato'), ['action' => 'edit', $contato->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Contato'), ['action' => 'delete', $contato->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contato->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Contatos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contato'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendas'), ['controller' => 'Vendas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Venda'), ['controller' => 'Vendas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Pessoas'), ['controller' => 'Pessoas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pessoa'), ['controller' => 'Pessoas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="contatos view large-9 medium-8 columns content">
    <h3><?= h($contato->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Venda') ?></th>
            <td><?= $contato->has('venda') ? $this->Html->link($contato->venda->id, ['controller' => 'Vendas', 'action' => 'view', $contato->venda->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pessoa') ?></th>
            <td><?= $contato->has('pessoa') ? $this->Html->link($contato->pessoa->id, ['controller' => 'Pessoas', 'action' => 'view', $contato->pessoa->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contato') ?></th>
            <td><?= h($contato->contato) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= h($contato->tipo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($contato->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($contato->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($contato->modified) ?></td>
        </tr>
    </table>
</div>
