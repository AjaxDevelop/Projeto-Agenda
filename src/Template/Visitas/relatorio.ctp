<?php
    //Insere a biblioteca do Google Charts
    echo $this->Html->script('Agenda.chart');

    //Mascaras.
    echo $this->Html->script('Agenda.jquery.mask.min');
    echo $this->Html->script('Agenda.mascaras');

    //Tab Index
    $tabindex = 1;

?>

<style>
    .chart_div {
        width: 100%;
        height: 300px;
    }
</style>

<script type="text/javascript">

    loading(true);

    $(document).ready(function () {

        //Inicializar o(s) campo(s) do tipo 'select'.
        $('select').material_select();

        //Inicializar o acesso aos modais.
        $('.modal').modal({
            dismissible: false
        }); console.log('Teste');

        //Redimensionar Gráficos
        $(window).resize(function(){
            chartVisitas();
        });

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(chartVisitas);

        function chartVisitas() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows([
                <?php
                    if ($pacote["total"] > 0) {
                        foreach ($pacote["dados"] as $key => $value) {
                            if($value != 0) {
                                echo "['".$key."', ".$value."],";
                            }
                        }
                    }
                ?>
            ]);

            // Set chart options
            var options = {

            };

            if(data.getNumberOfRows() == 0){
                $("#chart_grafico .mensagem").html("Desculpe, não foi possível encontrar nenhum dado para o período informado :(");
                $("#chart_grafico .card").show();

                loading(false);
            } else {
                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById('chart_grafico'));

                function selectHandler() {

                    var selectedItem = chart.getSelection()[0];

                    if (selectedItem) {
                        var topping = data.getValue(selectedItem.row, 0);

                        getDadosModal(topping);

                        chart.setSelection();

                    }
                }

                google.visualization.events.addListener(chart, 'select', selectHandler);

                chart.draw(data, options);

                loading(false);
            }
        }

        //Resgata os dados de detalhamento dos agendamentos
        function getDadosModal(topping) { console.log(topping);

            loading(true);

            //Resgata o período solicitado
            var data_inicial = $('#dados').attr('data-inicial');
            var data_final = $('#dados').attr('data-final');
            var vendedor = $('#dados').attr('data-vendedor');

            //Dados da requisição
            var dados = {
                data_inicial: data_inicial,
                data_final: data_final,
                usuario_id: vendedor,
                topping: topping
            };

            //Requisição para solicitar os dados do modal.
            $.ajax({
                url: basePath + '/visitas/relatorio/.json',
                method: 'put',
                dataType: 'json',
                data: dados,
                success: function(resposta) {
                    if (resposta.pacote.count_visitas > 0) {
                        visitasTemplate(resposta.pacote);
                    } else {
                        //Encerra a tela de loading
                        loading(false);
                    }
                },
                error: function (resposta) {
                    console.log('//ERROR//');
                    console.log(resposta);
                    console.log('///');

                    loading(false);
                }
            });

            var visitasTemplate = function(dados){ console.log(dados);
                var historico = $("#listarHistorico").html();
                var compilado = Handlebars.compile(historico);
                var resultado = compilado(dados);
                $('#modal_historico').html(resultado);

                //Encerra a tela de loading
                loading(false);

                //Abrir modal.
                $('#modal_historico').modal('open');
            };
        }

    });

</script>

<script id="listarHistorico" type="text/x-handlebars-template">
    <div class="modal-content">
        <ul class="collection with-header">
            <div class="row page-header">
                <div class="col l12 m12 s12">
                    <span class="titulo">Relatório da Visitas</span>
                </div>
            </div>
            <div class="col l4 m6 s10 offset-l8 offset-m6 offset-s2 right-align">
                {{count_visitas}} registro(s) localizado(s).
            </div>
            <div class="row col l12 m12 s12">
                <table class="responsive-table striped">
                    <thead>
                    <tr>
                        <th>Vendedor</th>
                        <th>Data da Visita</th>
                        <th>Horário Inicial</th>
                        <th>Horário Final</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{#each visitas}}
                    <tr>
                        <td>{{usuario.display}}</td>
                        <td>{{data}}</td>
                        <td>{{hora_inicial}}</td>
                        <td>{{hora_final}}</td>
                        <td>{{status}}</td>
                    </tr>
                    {{/each}}
                    </tbody>
                </table>
            </div>
        </ul>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Fechar</a>
    </div>
</script>

<!-- Market Place -->
<div id="market-place">
    <div id="dados" data-inicial="<?php echo $data_inicial ?>" data-final="<?php echo $data_final ?>" data-vendedor="<?php echo $vendedor_id ?>"></div>
</div>


<!-- RELATÓRIO - TÍTULO -->
<div class="row">
    <div class="col l12 m12 s12">
        <div class="page-header">
            <h3 class="titulo">Relatório de Visitas</h3>
        </div>
    </div>
</div>

<div class="row">
    <?= $this->Form->create(null, ['id' => 'form_visita', 'url' => ['action' => 'relatorio']]) ?>
    <div class="input-field col l2 m6 s12">
        <?php
        echo $this->Form->input('data_inicial',[
            'label'=>['class'=>'','text'=>'Data Inicial*'],
            'templates'=>[
                'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
            ],
            'type' => 'text',
            'id' => 'data_inicial',
            'class'=>'data',
            'value' => $data_inicial,
            'required' => true,
            'tabindex'=>$tabindex
        ]);
        ++$tabindex;
        ?>
    </div>
    <div class="input-field col l2 m6 s12">
        <?php
        echo $this->Form->input('data_final',[
            'label'=>['class'=>'','text'=>'Data Final*'],
            'templates'=>[
                'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
            ],
            'type' => 'text',
            'id' => 'data_final',
            'class'=>'data',
            'value' => $data_final,
            'required' => true,
            'tabindex'=>$tabindex
        ]);
        ++$tabindex;
        ?>
    </div>
    <div class="input-field col l3 m6 s12">
        <i class="material-icons prefix">perm_identity</i>
        <select id="vendedor" name="usuario_id">
            <option value="">Todos</option>
            <?php foreach ($vendedores as $vendedor): ?>
                <option value="<?php echo $vendedor->id; ?>" <?php if ($vendedor->id == $vendedor_id) echo "selected" ?>><?php echo $vendedor->display; ?></option>
            <?php endforeach; ?>
        </select>
        <label>Usuário</label>
    </div>
    <div class="col l3 m4 s7">
        <?php
            echo $this->Form->button('<i class="material-icons center">search</i>', [
                'type' => 'submit',
                'id' => 'pesquisar',
                'class'=>'waves-effect waves-light btn',
                'style' => 'margin-top: 8%',
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
        ?>
    </div>
    <?= $this->Form->end() ?>
</div>

<div class="row">
    <div class="col l12 m12 s12">
        <div class="page-header">
        </div>
    </div>
</div>

<div id="relatorio_visitas">
    <div class="row">
        <div class="col l6 m6 s10 offset-l3 offset-m3 offset-s1">
            <!-- Gráfico -->
            <div class="row">
                <div class="col-md-12">
                    <div id="chart_grafico" class="chart_div">
                        <div class="card blue-grey darken-1 col l12 m12 s12" style="display: none;">
                            <div class="card-content white-text mensagem">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal_historico" class="modal modal-fixed-footer">

</div>