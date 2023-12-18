
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1> <?php echo $modulo ?></h1>

       <?php

        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Reporte Microorganismo', ['controller' => 'ReporteMicro', 'action' => 'index']);
        echo $this->Html->getCrumbList(
            [
                'firstClass' => false,
                'lastClass'  => 'active',
                'class'      => 'breadcrumb',
                'escape'     => false
            ],
            '<i class="fa fa-home"></i> Inicio'
        );

        ?>
</section>


<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                     <h4 class="box-title" ><strong><?= __('Recursos Microorganismos') ?></strong></h4>


                </div>
                    <?php echo $this->Form->create(NULL, [
                        //'novalidate',
                        'url' => ['controller' => 'ReporteMicro', 'action' => 'index'],
                        'class' => 'row p-10',
                        'autocomplete' => "off",
                        'id'=>'idForm_Reporte'
                    ]); ?>
                <div class="box-body with-border">

                    <div class="col-xs-12 col-md-12 col-lg-12">

                        <div  class="tab-pane in active">

                                    <div class="row">

                                        <div class="col-lg-3 col-sm-12 col-xs-12 col-lg-offset-2">
                                                <?php echo $this->Form->control('opc_repor',
                                                        ['type' => 'select',
                                                         'options' => $lista_opcion_reporte,
                                                         'label' => 'Opción de Reporte <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                         'class' => 'form-control',
                                                         'id'=>'lst_opcion_reporte',
                                                         'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>


                                        <div class="col-lg-4 col-sm-12 col-xs-12">

                                                <?php echo $this->Form->control('tip_repor',
                                                        ['type' => 'select',
                                                         'options' => $lista_reporte,
                                                         'label' => 'Filtro de Reporte <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                         'class' => 'form-control',
                                                         'id'=>'lst_reporte',
                                                         'empty' => '-- SELECCIONE --' ]);
                                                ?>

                                        </div>

                                        <br>

                                        <div class="col-lg-2 col-sm-12 col-xs-12">

                                             <button type="submit" class="btn btn-primary" id="btnReporte" >Generar Reporte</button>

                                        </div>

                                    </div>

                                    <hr>

                            </div>
                    </div>

                </div>

                <?php if(isset($lista_columns) && count($lista_columns)>0) { ?>

                 <div class="col-lg-12 col-sm-12 col-xs-12 text-center">

                    <h4 class="box-title" style="text-decoration: underline;font-weight: bold"><?php echo $titulo ?></h4>

                </div>

                <?php if($permiso['export']) { ?>

                <div class="col-lg-5 col-sm-12 col-xs-12 col-lg-offset-9 ">

                    <?php if(count($lista_rows)>0) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-fw fa-file-excel-o" ></i> Exportar',
                                                ['controller' => 'ReporteMicro', 'action' => 'export','id'=>$this->request->data['tip_repor']],
                                                ['class' => 'btn btn-success', 'escape' => false, 'data-toggle' => "tooltip"])
                        ?>

                    <?php } ?>


                </div>

                <?php } ?>

                <div class="col-lg-10 col-sm-12 col-xs-12 col-lg-offset-1">
                        <br>
                        <div class="table-responsive">

                                <table id="tablaListado" class="table table-striped table-bordered table-hover">

                                    <thead class="headTablaListado">

                                        <tr class="text-uppercase text-center th-head-inputs" >


                                                <?php foreach ($lista_columns as $key => $value) {

                                                    echo '<th>'.$value.'</th>';
                                                } ?>

                                        </tr>

                                    </thead>
                                    <tfoot class="footTablaListado">
                                            <tr class="text-uppercase">
                                                <?php foreach ($lista_columns as $key => $value) {

                                                    echo '<th></th>';
                                                } ?>
                                            </tr>
                                    </tfoot>


                                    <?php if(isset($lista_rows) && $lista_rows!=null) { ?>


                                    <tbody class="text-center">

                                            <?php if(isset($lista_rows)) { ?>

                                                <?php  $item = 1;

                                                    foreach ($lista_rows as $key => $value) {

                                                    echo '<tr>';

                                                    echo '<td>'.$item.'</td>';

                                                        foreach ($value as $key => $value1) {

                                                              echo '<td>'.$value1.'</td>';

                                                        }
                                                    $item++;


                                                    echo "</tr>";


                                                } ?>

                                            <?php } ?>


                                    </tbody>

                                    <?php } ?>


                                </table>


                        </div>
                </div>
                <?php } ?>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<?php

$this->Html->css('/assets/js/datetime/bootstrap-datepicker3.min.css', ['block' => true]);
$this->Html->script(['/assets/js/datetime/bootstrap-datepicker.min.js', '/assets/js/datetime/bootstrap-datepicker.es.min.js'], ['block' => true]);
$this->Html->scriptBlock('
    $("#fecha-entrada").datepicker({autoclose: true,todayHighlight: true, language: "es", format: "dd-mm-yyyy"});
', ['block' => true]);

?>

<script>
    $(function () {
        tablaListadoDataTable();
    });

    $(".delete-btn").click(function(){
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/'.$this->request->url.'/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat'>Confirmar</a>");
        $("#trigger").click();
    });
</script>