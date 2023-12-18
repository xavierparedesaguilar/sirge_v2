
<?php $this->assign('title', $mod_modulo); ?>

<section class="content-header">
    <h1>Módulo <?php echo $mod_modulo ?></h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión de Mapas');

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
                <?php echo $this->Form->create(NULL, [
                            'url' => ['controller' => 'GestionMapasFito', 'action' => 'index'],
                            'id'  => 'form_gestion_mapas',
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('coleccion',[
                                        'type'    => 'select',
                                        'options' => $collection_lista,
                                        'label'   => 'Colección <b style="color:#dd4b39;">(*)</b>',
                                        'escape'  => false ,
                                        'class'   => 'form-control select2',
                                        'empty'   => '-- SELECCIONE --',
                                        // 'id'      => 'mapa_coleccion',
                                ]); ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('especie', [
                                        'type'    => 'select',
                                        'label'   => 'Nombre Científico',
                                        'escape'  => false,
                                        'class'   => 'form-control select2',
                                        'empty'   => '-- SELECCIONE --',
                                        'id'      => 'especie_idx',
                                ]); ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('nombre_comun', [
                                            'label'    => ['text' => 'Nombre Común '],
                                            'class'    => 'form-control',
                                            'disabled' => true,
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success" id="btnGestionMapas">BUSCAR</button>
                        <?php echo $this->Html->link('CANCELAR','/admin/fitogenetico', ['class' => 'btn btn-default']) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<?php

$this->Html->css(['/assets/js/select2/select2.min.css'], ['block' => 'css']);
$this->Html->script(['/assets/js/select2/select2.js'], ['block' => 'script']);
$this->Html->scriptBlock('$("select").select2();', ['block' => 'script']);

?>

<script type="text/javascript">
    $("#coleccion").val("");
    $("#especie_idx").val("");
    $("#nombre-comun").val("");
</script>

