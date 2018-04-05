<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Visita'), ['action' => 'edit', $visita->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Visita'), ['action' => 'delete', $visita->id], ['confirm' => __('Are you sure you want to delete # {0}?', $visita->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Visitas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Visita'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Observacoes'), ['controller' => 'Observacoes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Observaco'), ['controller' => 'Observacoes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="visitas view large-9 medium-8 columns content">
    <h3><?= h($visita->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Hora Inicial') ?></th>
            <td><?= h($visita->hora_inicial) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hora Final') ?></th>
            <td><?= h($visita->hora_final) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($visita->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($visita->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pessoa Id') ?></th>
            <td><?= $this->Number->format($visita->pessoa_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data') ?></th>
            <td><?= h($visita->data) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($visita->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($visita->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Observacoes') ?></h4>
        <?php if (!empty($visita->observacoes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Venda Id') ?></th>
                <th scope="col"><?= __('Visita Id') ?></th>
                <th scope="col"><?= __('Usuario Id') ?></th>
                <th scope="col"><?= __('Observacao') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($visita->observacoes as $observacoes): ?>
            <tr>
                <td><?= h($observacoes->id) ?></td>
                <td><?= h($observacoes->venda_id) ?></td>
                <td><?= h($observacoes->visita_id) ?></td>
                <td><?= h($observacoes->usuario_id) ?></td>
                <td><?= h($observacoes->observacao) ?></td>
                <td><?= h($observacoes->created) ?></td>
                <td><?= h($observacoes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Observacoes', 'action' => 'view', $observacoes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Observacoes', 'action' => 'edit', $observacoes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Observacoes', 'action' => 'delete', $observacoes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $observacoes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
