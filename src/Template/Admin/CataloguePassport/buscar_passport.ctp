
<?php $this->assign('title', $mod_module); ?>

<section class="content-header">
    <h1>Módulo <?php echo $mod_module ?></h1>

    <?php
        $this->Html->addCrumb('Publicación Catálogo Virtual', ['controller' => 'GestionPublicacionCatalogo', 'action' => 'index']);
        $this->Html->addCrumb('Catálogos');

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

<style type="text/css">
    label{
        padding-right: 10px;
    }
</style>

<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab"><strong>Configurar Datos Pasaporte</strong></a></li>
                    <li><a href="#tab_2" data-toggle="tab"><strong>Configurar Caracterización</strong></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">

                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Mostrar Datos Pasaporte en el Catálogo</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <?php echo $this->Form->create(NULL, [
                                                'url' => ['controller' => 'CataloguePassport', 'action' => 'index'],
                                                'class' => 'form-inline','id'=>'form_publication'
                                        ]); ?>
                                            <?php echo $this->Form->control('tipo_catalogo', ['type' => 'hidden', 'value' => 1]) ?>
                                            <?php echo $this->Form->control('recurso', [
                                                    'label'   => 'Recurso',
                                                    'class'   => 'form-control',
                                                    'type'    => 'select',
                                                    'options' => $recursos,
                                                    'default' => $recurso_id,
                                            ]) ?>
                                            <?php echo $this->Form->button('BUSCAR',['class'=>'btn btn-success']) ?>
                                            <?php echo $this->Html->link('CANCELAR', ['controller' => 'GestionPublicacionCatalogo', 'action' => 'index'],['class'=>'btn btn-default', ]) ?>
                                        <?= $this->Form->end() ?>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <?php echo $this->Form->create(NULL, [
                                        'url' => ['controller' => 'CataloguePassport', 'action' => 'addPassport']
                                ]); ?>
                                <?php echo $this->Form->control('resource_id', ['type' => 'hidden', 'value' => $recurso_id]) ?>
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><strong><?php echo $titulo ?></strong></h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div class="callout callout-info">
                                                        <p>Debe seleccionar al menos una opción del Formulario.</p>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" id="checkAll" <?php echo $total_check_pass == count($model)? 'checked="checked"' : ''; ?>>
                                                                <span class="text">Seleccionar todos los campos</span>
                                                            </label>
                                                        </div>
                                                        <div id="catalogue_passport">
                                                        <?php foreach ($model as $key => $value): ?>
                                                            <div class="col-sm-4">
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input <?php echo ($value->availability == 1) ? 'checked="checked"' : ''; ?>
                                                                            type="checkbox" name="passport[]" class="colored-success" value="<?php echo $value->countryside ?>">
                                                                        <span class="text"><?php echo $lista_final[$value->countryside] ?></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <?php echo $this->Form->button('GRABAR',['class'=>'btn btn-success btnCatalogue']) ?>
                                    <?php echo $this->Html->link('CANCELAR', ['controller' => 'GestionPublicacionCatalogo', 'action' => 'index'],['class'=>'btn btn-default', ]) ?>
                                </div>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Mostrar Datos de Caracterización en el Catálogo</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <div class="box box-solid">
                                            <?php echo $this->Form->create(NULL, [
                                                    'url'   => ['controller' => 'CataloguePassport', 'action' => 'index'],
                                                    'id'    => "form_catalogo",
                                            ]); ?>
                                            <div class="box-header with-border">
                                                <?php echo $this->Form->control('tipo_catalogo', ['type' => 'hidden', 'value' => 2]) ?>
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-6 col-lg-3">
                                                        <?php echo $this->Form->control('recurso', [
                                                                'label'   => 'Recurso <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                                'class'   => 'form-control select2',
                                                                'type'    => 'select',
                                                                'options' => $recursos,
                                                                'id'      => 'catalogo_recurso',
                                                                'empty'   => '-- SELECCIONE --'
                                                        ]) ?>
                                                    </div>

                                                    <div class="col-xs-12 col-md-6 col-lg-3">
                                                        <?php echo $this->Form->control('coleccion', [
                                                                'label'   => 'Colección <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                                'class'   => 'form-control select2',
                                                                'type'    => 'select',
                                                                // 'options' => $colecciones,
                                                                'id'      => 'catalogo_coleccion',
                                                                'empty'   => '-- SELECCIONE --'
                                                        ]) ?>
                                                    </div>

                                                    <div class="col-xs-12 col-md-6 col-lg-3">
                                                        <?php echo $this->Form->control('especie', [
                                                                'label'   => 'Nombre Científico <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                                                'class'   => 'form-control select2',
                                                                'type'    => 'select',
                                                                // 'options' => $especies,
                                                                'id'      => 'catalogo_especie',
                                                                'empty'   => '-- SELECCIONE --'
                                                        ]) ?>
                                                    </div>

                                                    <div class="col-xs-12 col-md-6 col-lg-3">
                                                        <?php echo $this->Form->control('cropname', [
                                                                'label'    => 'Nombre Común',
                                                                'class'    => 'form-control',
                                                                'disabled' => true,
                                                                'id'       => 'cropname_catalogue',
                                                        ]) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="text-center">
                                                    <?php echo $this->Form->button('BUSCAR',['class'=>'btn btn-success' , 'id' => 'btnCatalogoCaracterizacion']) ?>
                                                    <?php echo $this->Html->link('CANCELAR', ['controller' => 'GestionPublicacionCatalogo', 'action' => 'index'],['class'=>'btn btn-default', ]) ?>
                                                </div>
                                            </div>
                                            <?= $this->Form->end() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><strong><?php echo $titulo_2 ?></strong></h3>
                                        </div>
                                        <div class="panel-body">
                                            <?php  if($descriptores->count() > 0){  ?>

                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" id="check_caract_all" <?php echo (count($descriptores) == count($list_catalagos))? 'checked="checked"' : ''; ?> >
                                                        <span class="text">Seleccionar todos los campos</span>
                                                    </label>
                                                </div>
                                                <?php echo $this->Form->create(NULL, [
                                                        'url' => ['controller' => 'CataloguePassport', 'action' => 'addCaracterizacion']
                                                ]); ?>

                                                <?php echo $this->Form->control('resource_id', ['type'   => 'hidden', 'value' => 1]) ?>
                                                <?php echo $this->Form->control('collection_id', ['type' => 'hidden', 'value' => 20]) ?>
                                                <?php echo $this->Form->control('specie_id', ['type'     => 'hidden', 'value' => 99]) ?>

                                                <div class="table-responsive" id="catalogue_caract">
                                                    <table id="tablaListado" class="table table-striped table-bordered table-hover">
                                                        <thead class="headTablaListado">
                                                            <tr class="text-uppercase text-center th-head-inputs">
                                                                <th class="text-center">#</th>
                                                                <th>Descriptor</th>
                                                                <th>Título</th>
                                                                <th>Seleccionar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $item = 1; ?>
                                                            <?php foreach ($descriptores as $descriptor): ?>
                                                            <tr>
                                                                <td class="text-center"><?php echo $item ?></td>
                                                                <td><?php echo h($descriptor->name) ?></td>
                                                                <td><?php echo h($descriptor->title) ?></td>
                                                                <td class="text-center">
                                                                <input
                                                                    <?php
                                                                        if(in_array($descriptor->id, $list_catalagos)){

                                                                            foreach ($list_catalagos as $key => $value) {

                                                                                if($descriptor->id == $value)
                                                                                    echo 'checked="checked"';
                                                                            }
                                                                        }
                                                                    ?>
                                                                    type="checkbox" name="caracterizacion[]" class="colored-success" value="<?php echo $descriptor->id ?>">
                                                                </td>
                                                            </tr>
                                                            <?php $item++; ?>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                    <?php echo $this->Form->button('GRABAR',['class'=>'btn btn-success btnCatalogue']) ?>
                                                    <?php echo $this->Html->link('CANCELAR', ['controller' => 'GestionPublicacionCatalogo', 'action' => 'index'],['class'=>'btn btn-default', ]) ?>
                                                </div>
                                                <?= $this->Form->end() ?>

                                            <?php } else { ?>

                                                <div class="callout callout-info">
                                                    <p>No se encontraron resultados para los filtros seleccionados.</p>
                                                </div>

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#catalogo_recurso, #catalogo_coleccion, #catalogo_especie').prop('selectedIndex',0);
        $('#cropname_catalogue').val("");

        $("#checkAll").click(function () {
            $('#catalogue_passport input:checkbox').not(this).prop('checked', this.checked);
        });

        $("#check_caract_all").click(function () {
            $('#catalogue_caract input:checkbox').not(this).prop('checked', this.checked);
        });
    });
</script>

<?php

$this->Html->css(['/assets/js/select2/select2.min.css'], ['block' => 'css']);
$this->Html->script(['/assets/js/select2/select2.js'], ['block' => 'script']);
$this->Html->scriptBlock('$("#catalogo_recurso, #catalogo_coleccion, #catalogo_especie").select2();', ['block' => 'script']);

?>