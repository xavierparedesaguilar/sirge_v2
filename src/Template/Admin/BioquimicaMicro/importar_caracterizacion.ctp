
<?php $this->assign('title', $mod_parent); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $mod_parent ?> - Importación de Caracterización</h1>

    <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Caracterización','/admin/microorganismo/caracterizacion');
        $this->Html->addCrumb('Bioquímica', ['controller' => 'BioquimicaMicro', 'action' => 'index']);
        $this->Html->addCrumb('Importar Caracterización');

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
<!-- /Page Breadcrumb -->

<div class="content">
    <div class="row">

        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DESCRGAR FORMATO') ?></strong></h3>
                </div>


                <?php echo $this->Form->create($descriptor, [
                    'url'     => ['controller' => 'BioquimicaMicro', 'action' => 'exportarCaracterizacion'],
                    'id'      => 'form_formato_caracterizacion',
                ]); ?>


                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('coleccion_id',[
                                        'type'    => 'select',
                                        'options' => $colecciones,
                                        'default' => '',
                                        'label'   => 'Colección <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control select2',
                                        'empty'   => '-- SELECCIONE --',
                                        'id'      => 'coleccion_state',
                                ]); ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('especie_id', [
                                        'type'    => 'select',
                                        'options' => [],
                                        'label'   => __('Nombre Científico <b style="color:#dd4b39;">(*)</b>'), 'escape'=> false,
                                        'class'   => 'form-control select2',
                                        'empty'   => '-- SELECCIONE --',
                                ]); ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('nombre_comun', [
                                        'label'    => ['text' => 'Nombre Común '],
                                        'class'    => 'form-control',
                                        'disabled' => true,
                                        'id'       => 'cropname',
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <?php echo $this->Form->button('DESCARGAR FORMATO DE IMPORTACIÓN', ['class' => 'btn btn-warning', 'id' => 'btnFormatoCaracterizacion']) ?>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/microorganismo/caracterizacion/Fenotipica', true) ?>"
                           class="btn btn-default"> CANCELAR
                        </a>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>

        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('CARGA DE REGISTROS') ?></strong></h3>
                </div>
                <?php echo $this->Form->create($descriptor, [
                    'url'     => ['controller' => 'BioquimicaMicro', 'action' => 'importarCaracterizacion'],
                    'id'      => 'form_caracterizacion',
                    'enctype' => 'multipart/form-data',
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('coleccion_id',[
                                        'type'    => 'select',
                                        'options' => $colecciones,
                                        'default' => '',
                                        'label'   => 'Colección <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control select2',
                                        'empty'   => '-- SELECCIONE --',
                                        'id'      => 'coleccion_import',
                                ]); ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('especie_id', [
                                        'type'    => 'select',
                                        'options' => [],
                                        'label'   => __('Nombre Científico <b style="color:#dd4b39;">(*)</b>'), 'escape'=> false,
                                        'class'   => 'form-control select2',
                                        'empty'   => '-- SELECCIONE --',
                                        'id'      => 'especie_import',
                                ]); ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('nombre_comun', [
                                        'label'    => ['text' => 'Nombre Común '],
                                        'class'    => 'form-control',
                                        'disabled' => true,
                                        'id'       => 'cropname_import',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('file_caracterizacion', [
                                            'label' => ['text' => 'Subir Archivo de Excel <b style="color:#dd4b39;">(*)</b>', 'escape'=> false , 'escape' => false],
                                            'type'  => 'file',
                                            'class' => 'form-control file-input',
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <?php echo $this->Form->button('SUBIR ARCHIVO', ['class' => 'btn btn-success', 'name' => 'btn_1', 'id' => 'btnSubirCaracterizacion']) ?>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/microorganismo/caracterizacion/Fenotipica', true) ?>"
                           class="btn btn-default"> CANCELAR
                        </a>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <div class="overlay" id="carga" style="display: none;">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>
        </div>
    </div>


<?php

if(isset($resultado)){

?>
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('RESUMEN PRELIMINAR') ?></strong></h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="table-responsive"  style="height: 350px">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <?php

                                            $header = array_keys($resultado[0]);

                                            for($i=0; $i<count($header); $i++){
                                                if($i < 3)
                                                    echo "<th style='min-width: 160px'>";
                                                else
                                                    echo "<th>";

                                                echo $header[$i];
                                                echo "</th>";
                                            }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        for($i=0; $i < count($resultado); $i++){

                                            $content = array_values($resultado[$i]);

                                            echo "<tr>";
                                            echo "<td>".($i+1)."</td>";

                                            for($j = 0; $j<count($content); $j++){

                                                echo "<td>";

                                                if($j < 3) {

                                                    if($j == 2) {

                                                        if(substr($content[$j],0,2) == '1_')
                                                            echo "<span class='label label-danger'>".substr($content[$j],2,20)."</span>";
                                                        else
                                                            echo $content[$j];

                                                    } else {

                                                        echo $content[$j];

                                                    }
                                                } else {

                                                    if($content[$j] == '' || $content[$j] == 0){

                                                        echo $content[$j];

                                                    } else {

                                                        if(substr($content[$j],0,2) == '1_')
                                                            echo "<span class='label label-danger'>".round(substr($content[$j],2,20),2)."</span>";
                                                        else
                                                            echo round($content[$j], 2);
                                                    }

                                                }

                                                echo "</td>";
                                            }
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <?php echo $this->Form->create($descriptor, [
                        'url' => ['controller' => 'BioquimicaMicro', 'action' => 'cargarCaracterizacion'],
                        'id'  => "form_cargar_caract",
                    ]); ?>
                    <?php echo $this->Form->control('especie_id', ['type'=>'hidden', 'value'=>$x_especie]) ?>
                    <?php echo $this->Form->control('coleccion_id', ['type'=>'hidden', 'value'=>$x_coleccion]) ?>
                    <div class="col-sm-12 text-center">
                        <?php echo $this->Form->button('CARGAR ARCHIVO', ['class' => 'btn btn-success', 'name' => 'btn_2', 'id' => 'btnCargarCaracterizacion']) ?>
                        <?php echo $this->Html->link('CANCELAR',['controller'=>'BioquimicaMicro','action'=>'index'],['class'=>'btn btn-default']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>

                <div class="overlay" id="carga_caract" style="display: none;">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

</div>

<?php

$this->Html->css(['/assets/js/select2/select2.min.css'], ['block' => 'css']);
$this->Html->css(['/assets/js/fileinput/css/fileinput.min.css'], ['block' => 'css']);
$this->Html->script(['/assets/js/select2/select2.js'], ['block' => 'script']);
$this->Html->script(['/assets/js/fileinput/js/fileinput.min.js', '/assets/js/fileinput/js/locales/es.js'], ['block' => 'script']);
$this->Html->scriptBlock('$("select").select2();', ['block' => 'script']);
$this->Html->scriptBlock('$("#file-caracterizacion").fileinput({ showUpload: false, language: "es", allowedFileExtensions: ["xlsx", "xls"] });', ['block' => 'script']);

?>