<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Observaco'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendas'), ['controller' => 'Vendas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Venda'), ['controller' => 'Vendas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Visitas'), ['controller' => 'Visitas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Visita'), ['controller' => 'Visitas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="observacoes index large-9 medium-8 columns content">
    <h3><?= __('Observacoes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('venda_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('visita_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('usuario_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($observacoes as $observaco): ?>
            <tr>
                <td><?= $this->Number->format($observaco->id) ?></td>
                <td><?= $observaco->has('venda') ? $this->Html->link($observaco->venda->id, ['controller' => 'Vendas', 'action' => 'view', $observaco->venda->id]) : '' ?></td>
                <td><?= $observaco->has('visita') ? $this->Html->link($observaco->visita->id, ['controller' => 'Visitas', 'action' => 'view', $observaco->visita->id]) : '' ?></td>
                <td><?= $observaco->has('usuario') ? $this->Html->link($observaco->usuario->id, ['controller' => 'Usuarios', 'action' => 'view', $observaco->usuario->id]) : '' ?></td>
                <td><?= h($observaco->created) ?></td>
                <td><?= h($observaco->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $observaco->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $observaco->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $observaco->id], ['confirm' => __('Are you sure you want to delete # {0}?', $observaco->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
