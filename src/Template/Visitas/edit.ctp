<?php
/**
  * @var \App\View\AppView $this
  */

    //Mascaras.
    echo $this->Html->script('Agenda.jquery.mask.min');
    echo $this->Html->script('Agenda.mascaras');

    //Controle JS.
    echo $this->Html->script('Agenda.visitas/visitas_controle');

    //Formulário JS.
    echo $this->Html->script('Agenda.visitas/visitas_formulario');

    //Controle CSS.
    echo $this->Html->css('Agenda.visitas/visitas_controle');

    //Tabindex
    $tabindex = 1;

?>

<!-- Market Place -->
<div id="market-place">
    <div id="pessoa_controle" data-controle="true"></div>
    <div id="data_controle" data-controle="true"></div>
    <div id="horario_controle" data-controle="true"></div>
    <div id="status_controle" data-controle="false"></div>
</div>

<div class="fixed-action-btn">
    <a class="btn-floating btn-large blue">
        <i class="large material-icons">business</i>
    </a>
    <ul>
        <li>
            <a href="<?php echo $this->Url->build(['controller'=>'pessoas', 'action'=>'add'],true) ?>" class="btn-floating blue">
                <i class="material-icons tooltipped" data-position="left" data-delay="50" data-tooltip="Cadastrar Empresa">queue</i>
            </a>
        </li>
        <li>
            <a href="<?php echo $this->Url->build(['controller'=>'pessoas', 'action'=>'index'],true) ?>" class="btn-floating blue">
                <i class="material-icons tooltipped" data-position="left" data-delay="50" data-tooltip="Empresas Cadastradas">visibility</i>
            </a>
        </li>
    </ul>
</div>

<?= $this->Form->create($visita, ['id' => 'form_visita']) ?>

<div class="row page-header">
    <div class="col l12 m12 s12">
        <h5><span>Editar Visita</span></h5>
    </div>
</div>

<div class="row">
    <div class="col l4 m4 s14 offset-l4 offset-m4 offset-s14">
        <p class="center">
            <?= $this->Flash->render('visitas'); ?>
        </p>
    </div>
</div>

<div class="visita-form">
    <div class="row">
        <div class="input-field col l2 m6 s12">
            <?php
            echo $this->Form->input('data',[
                'label'=>['class'=>'active','text'=>'Data*'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'data',
                'class'=>'data formulario',
                'required' => true,
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>
        </div>
        <div class="input-field col l2 m6 s12">
            <?php
            echo $this->Form->input('hora_inicial',[
                'label'=>['class'=>'active','text'=>'Horário Inicial*'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'horario_inicial',
                'class'=>'hora horario formulario',
                'required' => true,
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>
        </div>
        <div class="input-field col l2 m6 s12">
            <?php
            echo $this->Form->input('hora_final',[
                'label'=>['class'=>'active','text'=>'Horário Final*'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'horario_final',
                'class'=>'hora horario formulario',
                'required' => true,
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>
        </div>
    </div>

    <div class="row">
        <div class="input-field col l4 m6 s12">
            <i class="material-icons prefix">toc</i>
            <label class="active" for="status">Status da Visita*</label>
            <?php
            echo $this->Form->select('status',$statusOpt,[
                'templates'=>[
                    'inputContainer'=>' <div class="">{{content}}</div>'
                ],
                'id' => 'status_edit',
                'class'=>'formulario',
                'required' => true,
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>
        </div>
    </div>

    <div class="row">
        <div class="input-field col l7 m12 s12">
            <?php
            echo $this->Form->input('observacoe.observacao', [
                'label'=>['class'=>'active','text'=>'Oberservação'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix">description</i>{{content}}</div>'
                ],
                'type' => 'textarea',
                'id' => 'observacao_edit',
                'class'=>'materialize-textarea formulario',
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>

            <?php  echo $this->Form->hidden('observacoe.id'); ?>
        </div>
    </div>

    <div style="min-height: 50px;"></div>
    <div class="row">
        <div class="col l2 m3 s5 offset-l8 offset-m5">
            <?php
            echo $this->Form->button('Salvar<i class="material-icons right">cloud</i>', [
                'type' => 'button',
                'id' => 'salvar',
                'class'=>'waves-effect waves-light disabled btn',
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>
        </div>

        <div class="col l2 m4 s7">
            <a href="<?php echo $this->Url->build(["controller" => "visitas", "action" => "index"]); ?>" class="waves-effect waves-light btn btn-cancelar"><i class="material-icons right">cancel</i>Cancelar</a>
        </div>

        <div class="loading-submit col l4 m6 s16 offset-l4 offset-m3 offset-s3" style="display: none;">
            <div class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div>
</div>

<div class="loading-form col l2 m3 s6 offset-l10 offset-m9 offset-s6" style="display: none;">
    <div class="progress">
        <div class="indeterminate"></div>
    </div>
</div>

<?= $this->Form->end() ?>

<div id="modal_horario" class="modal blue-grey darken-1 white-text">
    <div class="modal-content">
        <div class="row">
            <div id="mensagem-horario" class="col l8 m8 s8 offset-l2 offset-m2 offset-s2">
                <h4><small>Horario Inválido!</small></h4>
                <p>
                    O horário da sua visita é inválido. Por favot, verifique o horário informado.
                </p>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Fechar</a>
    </div>
</div>

<div id="modal_data" class="modal blue-grey darken-1 white-text">
    <div class="modal-content">
        <div class="row">
            <div id="mensagem-data" class="col l8 m8 s8 offset-l2 offset-m2 offset-s2">
                <h4><small>Data Inválida!</small></h4>
                <p>
                    A data informada esta inválida. Por favor, verifique a data informada.
                </p>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Fechar</a>
    </div>
</div>