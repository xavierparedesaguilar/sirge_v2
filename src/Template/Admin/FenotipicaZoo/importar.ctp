
<?php $this->assign('title', $mod_parent); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $mod_parent ?> - Importación de Descriptores y Estados</h1>

    <?php
        $this->Html->addCrumb('Recursos Zoogenéticos', '/admin/zoogenetico');
        $this->Html->addCrumb('Caracterización','/admin/zoogenetico/caracterizacion');
        $this->Html->addCrumb('Fenotípica', ['controller' => 'FenotipicaZoo', 'action' => 'index']);
        $this->Html->addCrumb('Importar');

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
                    <h3 class="box-title"><strong><?= __('Importación de Descriptores') ?></strong></h3>
                    <div class="box-tools pull-right">

                        <?php if($permiso['export']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-cloud-download"></i>', ['controller' => 'FenotipicaZoo',
                                                     'action' => 'exportardescriptores'], ['class' => 'btn btn-warning',
                                                     'data-toggle' => "tooltip",
                                                     'title' => "Descargar plantilla de estados de descriptores.",
                                                     'escape' => false] );
                        ?>
                        <?php } ?>

                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="box box-success">
                                <?php echo $this->Form->create($descriptor, [
                                    'url'         => ['controller' => 'FenotipicaZoo', 'action' => 'importar'],
                                    'autocomplete'=> "off",
                                    'id'          => "form_import_descriptor",
                                    'enctype'     => 'multipart/form-data',
                                ]); ?>
                                <?php echo $this->Form->control('form_tipo', [ 'type' => 'hidden', 'value' => '1' ]) ?>
                                <div class="box-body">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('coleccion_id',[
                                                        'type'    => 'select',
                                                        'options' => $colecciones,
                                                        'label'   => 'Colección <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                        'class'   => 'form-control select2',
                                                        'empty'   => '-- SELECCIONE --',
                                                        'id'      => 'coleccion',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('passport.specie_id', [
                                                        'type'    => 'select',
                                                        'options' => $especie_idx,
                                                        'value'   => $value_specie,
                                                        'id'      => 'especie_idx',
                                                        'label'   => __('Nombre Científico <b style="color:#dd4b39;">(*)</b>'),  'escape'=> false,
                                                        'class'   => 'form-control select2',
                                                        'empty'   => '-- SELECCIONE --',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('nombre_comun', [
                                                        'label'    => ['text' => 'Nombre Común '],
                                                        'value'=>$especie_nombre,
                                                        'class'    => 'form-control',
                                                        'disabled' => true,
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('tipo_agrupacion', [
                                                        'type'     => 'select',
                                                        'options'  => ['1' => 'Agrupar por Especie'],
                                                        'label'    => __('Seleccione la agrupación'),
                                                        'class'    => 'form-control select2',
                                                        'empty'    => '[ Agrupación por Especie ]',
                                                        'disabled' => true,
                                                ]); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('file_carga', [
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
                                        <button type="submit" class="btn btn-success" id="btnCargaDescriptor">SUBIR ARCHIVO</button>
                                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/zoogenetico/caracterizacion/Fenotipica', true) ?>"
                                           class="btn btn-default"> CANCELAR
                                        </a>
                                    </div>
                                </div>
                                <?= $this->Form->end() ?>

                                <div class="overlay" id="carga_descriptor" style="display: none;">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- VISTA PRELIMINAR DE LOS REGISTROS QUE SE VAN A CARGAR -->
                    <?php if(isset($temp_descriptor)){ ?>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>RESUMEN PRELIMINAR</strong></h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive"  style="height: 350px">
                                        <table class="table table-hover table-striped table-bordered">
                                            <thead class="bordered-blueberry">
                                                <tr>
                                                    <th>#</th>
                                                    <?php

                                                        $temp_map = $temp_descriptor[0];
                                                        $temp_map = $temp_map->toArray();

                                                        foreach ($temp_map as $key=> $value) {

                                                            if($key != 'id' && $key != 'recurso' && $key != 'user_id' && $key != 'tipo_carga' && $key != 'campo_4')
                                                            {
                                                                if($key == 'motivo_error'){

                                                                    echo "<th style='min-width: 300px; text-align: center;'>";

                                                                } else {

                                                                    echo "<th>";
                                                                }

                                                                if($key == 'coleccion')
                                                                    echo "COLECCIÓN";
                                                                else if ($key == 'campo_1')
                                                                    echo 'DESCRIPTOR';
                                                                else if($key == 'campo_2')
                                                                    echo 'TÍTULO';
                                                                else if($key == 'campo_3')
                                                                    echo 'DESCRIPCIÓN';
                                                                else
                                                                    echo mb_strtoupper($key, 'UTF-8');

                                                                echo "</th>";
                                                            }
                                                        }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    for ($i=0; $i < count($temp_descriptor); $i++) {

                                                        $temp_map = $temp_descriptor[$i];
                                                        $temp_map = $temp_map->toArray();

                                                        if($temp_descriptor[$i]['motivo_error'] != ''){

                                                            echo "<tr class='danger'>";

                                                        } else {

                                                            echo "<tr>";
                                                        }

                                                        echo "<td>".($i+1)."</td>";

                                                        foreach ($temp_map as $key=> $value) {

                                                            if($key != 'id' && $key != 'recurso' && $key != 'user_id' && $key != 'tipo_carga' && $key != 'campo_4')
                                                            {
                                                                echo "<td>";
                                                                echo mb_strtoupper($value, 'UTF-8');
                                                                echo "</td>";
                                                            }
                                                        }

                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="col-sm-12 text-center">
                                        <?php echo $this->Form->create($descriptor, [
                                              'url' => ['controller' => 'FenotipicaZoo', 'action' => 'uploadfile'],
                                              'autocomplete' => "off",
                                              'id' => "form_cargar_fenotipica",
                                        ]); ?>
                                        <?php echo $this->Form->control('form_tipo', [ 'type' => 'hidden', 'value' => '1' ]) ?>
                                        <?php echo $this->Form->control('especie_id', [ 'type' => 'hidden', 'value' => $model_specie->id ]); ?>
                                        <?php echo $this->Form->control('colection_id',[ 'type'=> 'hidden', 'value' => $model_specie->collection_id ]); ?>
                                        <?php echo $this->Form->control('tipo_agrupacion', [ 'type' => 'hidden', 'value' => $tipo_agrupacion ]) ?>
                                        <button type="submit" class="btn btn-success" id="btnCargaDescripFinal">GRABAR</button>
                                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/zoogenetico/caracterizacion/Fenotipica', true) ?>"
                                           class="btn btn-default"> CANCELAR
                                        </a>

                                        <?= $this->Form->end() ?>
                                    </div>
                                </div>

                                <div class="overlay" id="carga_descrip_final" style="display: none;">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('Importación de Estados de Descriptores') ?></strong></h3>
                    <div class="box-tools pull-right">

                    <?php if($permiso['export']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-cloud-download"></i>', ['controller' => 'FenotipicaZoo',
                                                     'action' => 'exportarestados'], ['class' => 'btn btn-warning',
                                                     'data-toggle' => "tooltip", 'title' => "Descargar plantilla de estados de descriptores.",
                                                     'escape' => false] );
                        ?>
                    <?php } ?>

                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="box box-success">

                                <?php echo $this->Form->create($descriptor, [
                                    'url'         => ['controller' => 'FenotipicaZoo', 'action' => 'importar'],
                                    'autocomplete'=> "off",
                                    'id'          => "form_import_estados",
                                    'enctype'     => 'multipart/form-data',
                                ]); ?>
                                <?php echo $this->Form->control('form_tipo', [ 'type' => 'hidden', 'value' => '2' ]) ?>
                                <div class="box-body">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('coleccion_id_',[
                                                        'type'    => 'select',
                                                        'options' => $colecciones,
                                                        'label'   => 'Colección <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                        'class'   => 'form-control select2',
                                                        'empty'   => '-- SELECCIONE --',
                                                        'id'      => 'coleccion_state',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('especie_id', [
                                                        'type'    => 'select',
                                                        'options' => $especie_idy ,
                                                        'value'=>$value_specie_idy,
                                                        'label'   => __('Nombre Científico <b style="color:#dd4b39;">(*)</b>'), 'escape'=> false,
                                                        'class'   => 'form-control select2',
                                                        'empty'   => '-- SELECCIONE --',
                                                ]); ?>
                                            </div>

                                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('nombre_comun', [
                                                        'label'    => ['text' => 'Nombre Común '],
                                                        'class'    => 'form-control',
                                                        'value'=>$especie_nombre_idy,
                                                        'id'       => 'cropname',
                                                        'disabled' => true,
                                                ]); ?>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <?php echo $this->Form->control('file_estado', [
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
                                        <button type="submit" class="btn btn-success" id="btnCargaEstados">SUBIR ARCHIVO</button>
                                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/zoogenetico/caracterizacion/Fenotipica', true) ?>"
                                           class="btn btn-default"> CANCELAR
                                        </a>
                                    </div>
                                </div>
                                <?= $this->Form->end() ?>

                                <div class="overlay" id="carga_state" style="display: none;">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- VISTA PRELIMINAR DE LOS REGISTROS QUE SE VAN A CARGAR -->
                    <?php if(isset($temp_state)){ ?>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>RESUMEN PRELIMINAR</strong></h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive"  style="height: 350px">
                                        <table class="table table-hover table-striped table-bordered">
                                            <thead class="bordered-blueberry">
                                                <tr>
                                                    <th>#</th>
                                                    <?php

                                                        $temp_map = $temp_state[0];
                                                        $temp_map = $temp_map->toArray();

                                                        foreach ($temp_map as $key=> $value) {

                                                            if($key != 'id' && $key != 'recurso' && $key != 'user_id' && $key != 'tipo_carga' && $key != 'campo_4')
                                                            {
                                                                if($key == 'motivo_error'){

                                                                    echo "<th style='min-width: 300px; text-align: center;'>";

                                                                } else {

                                                                    echo "<th>";
                                                                }

                                                                if($key == 'coleccion')
                                                                    echo "COLECCIÓN";
                                                                else if ($key == 'campo_1')
                                                                    echo 'DESCRIPTOR';
                                                                else if($key == 'campo_2')
                                                                    echo 'TÍTULO';
                                                                else if($key == 'campo_3')
                                                                    echo 'DESCRIPCIÓN';
                                                                else
                                                                    echo mb_strtoupper($key, 'UTF-8');

                                                                echo "</th>";
                                                            }
                                                        }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    for ($i=0; $i < count($temp_state); $i++) {

                                                        $temp_map = $temp_state[$i];
                                                        $temp_map = $temp_map->toArray();

                                                        if($temp_state[$i]['motivo_error'] != ''){

                                                            echo "<tr class='danger'>";

                                                        } else {

                                                            echo "<tr>";
                                                        }

                                                        echo "<td>".($i+1)."</td>";

                                                        foreach ($temp_map as $key=> $value) {

                                                            if($key != 'id' && $key != 'recurso' && $key != 'user_id' && $key != 'tipo_carga' && $key != 'campo_4')
                                                            {
                                                                echo "<td>";
                                                                echo mb_strtoupper($value, 'UTF-8');
                                                                echo "</td>";
                                                            }
                                                        }

                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="col-sm-12 text-center">
                                        <?php echo $this->Form->create($descriptor, [
                                              'url' => ['controller' => 'FenotipicaZoo', 'action' => 'uploadfile'],
                                              'autocomplete' => "off",
                                              'id' => "form_cargar_fenotipica",
                                        ]); ?>
                                        <?php echo $this->Form->control('form_tipo', [ 'type' => 'hidden', 'value' => '2' ]) ?>
                                        <?php echo $this->Form->control('especie_id', [ 'type' => 'hidden', 'value' => $model_specie->id ]); ?>
                                        <?php echo $this->Form->control('colection_id',[ 'type'=> 'hidden', 'value' => $model_specie->collection_id ]); ?>
                                        <?php echo $this->Form->control('tipo_agrupacion', [ 'type' => 'hidden', 'value' => $tipo_agrupacion ]) ?>
                                        <button type="submit" class="btn btn-success" id="btnCargaStateFinal">GRABAR</button>
                                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/´zoogenetico/caracterizacion/Fenotipica', true) ?>"
                                           class="btn btn-default"> CANCELAR
                                        </a>

                                        <?= $this->Form->end() ?>
                                    </div>
                                </div>

                                <div class="overlay" id="carga_state_final" style="display: none;">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$this->Html->css(['/assets/js/select2/select2.min.css'], ['block' => 'css']);
$this->Html->css(['/assets/js/fileinput/css/fileinput.min.css'], ['block' => 'css']);
$this->Html->script(['/assets/js/select2/select2.js'], ['block' => 'script']);
$this->Html->script(['/assets/js/fileinput/js/fileinput.min.js', '/assets/js/fileinput/js/locales/es.js'], ['block' => 'script']);
$this->Html->scriptBlock('$("select").select2();', ['block' => 'script']);
$this->Html->scriptBlock('$("#file-carga, #file-estado").fileinput({ showUpload: false, language: "es", allowedFileExtensions: ["xlsx", "xls"] });', ['block' => 'script']);

?>