<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Observaco'), ['action' => 'edit', $observaco->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Observaco'), ['action' => 'delete', $observaco->id], ['confirm' => __('Are you sure you want to delete # {0}?', $observaco->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Observacoes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Observaco'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendas'), ['controller' => 'Vendas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Venda'), ['controller' => 'Vendas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Visitas'), ['controller' => 'Visitas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Visita'), ['controller' => 'Visitas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="observacoes view large-9 medium-8 columns content">
    <h3><?= h($observaco->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Venda') ?></th>
            <td><?= $observaco->has('venda') ? $this->Html->link($observaco->venda->id, ['controller' => 'Vendas', 'action' => 'view', $observaco->venda->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Visita') ?></th>
            <td><?= $observaco->has('visita') ? $this->Html->link($observaco->visita->id, ['controller' => 'Visitas', 'action' => 'view', $observaco->visita->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= $observaco->has('usuario') ? $this->Html->link($observaco->usuario->id, ['controller' => 'Usuarios', 'action' => 'view', $observaco->usuario->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($observaco->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($observaco->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($observaco->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Observacao') ?></h4>
        <?= $this->Text->autoParagraph(h($observaco->observacao)); ?>
    </div>
</div>
