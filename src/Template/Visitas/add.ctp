<?php
/**
  * @var \App\View\AppView $this
  */
?>



    <?= $this->Form->create($visita) ?>
    <fieldset>
        <?php
            echo $this->Form->control('pessoa_id');
            echo $this->Form->control('data');
            echo $this->Form->control('hora_inicial');
            echo $this->Form->control('hora_final');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

