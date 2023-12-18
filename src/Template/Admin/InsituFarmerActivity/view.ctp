
<?php $this->assign('title', $mod_title); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $mod_modulo ?> - <?php echo $mod_title ?></h1>

    <?php
        $this->Html->addCrumb('Conservación In Situ', ['controller' => 'Insitu', 'action' => 'index']);
        $this->Html->addCrumb($insitu->code_insitu, ['controller' => 'InsituFarmerActivity', 'action' => 'index', 'idx' => $insitu->id]);
        $this->Html->addCrumb('Prácticas Agrícolas', ['controller' => 'InsituFarmerActivity', 'action' => 'index', 'idx' => $insitu->id]);
        $this->Html->addCrumb($insituFarmerActivity->id, ['controller' => 'InsituFarmerActivity', 'action' => 'view', 'idx' => $insitu->id, 'id' => $insituFarmerActivity->id]);
        $this->Html->addCrumb('Ver');

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


<!-- Page Body -->
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                    <div class="pull-right box-tools">

                    <?php if ($permiso['edit']) { ?>
                        <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                                    ['controller' => 'InsituFarmerActivity', 'action' => 'edit', 'idx' => $insituFarmerActivity->insitu_id, 'id' => $insituFarmerActivity->id],
                                    ['class' => 'btn btn-primary','data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] );?>
                    <?php } ?>
                    <?php if ($permiso['delete']) { ?>
                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",'escape' => false, "data-id"=>$insituFarmerActivity->id])?>
                    <?php } ?>
                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                ['controller' => 'InsituFarmerActivity', 'action' => 'index', 'idx' => $insituFarmerActivity->insitu_id],
                                ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false])
                        ?>

                    </div>
                    <br>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <th scope="row"><?= __('Finalidad') ?></th>
                                <td><?= h($insituFarmerActivity->purpose) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Comunidades') ?></th>
                                <td><?= h($insituFarmerActivity->comunities) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Nombre Común') ?></th>
                                <td><?= h($insituFarmerActivity->common_name) ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Código In Situ') ?></th>
                                <td><?= $insituFarmerActivity->insitu->code_insitu ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Insumo / Herramienta') ?></th>
                                <td><?= $insituFarmerActivity->insumoHerramienta->name ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Origen') ?></th>
                                <td><?= $insituFarmerActivity->origen->name ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Práctica / Saber') ?></th>
                                <td><?= $insituFarmerActivity->practicaSaber->name ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Técnica / Categoría') ?></th>
                                <td><?= $insituFarmerActivity->tecnicaCategoria->name ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?= __('Descripción') ?></th>
                                <td><?= h($insituFarmerActivity->description) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                    <?php if ($permiso['edit']) { ?>
                        <?php echo $this->Html->link('EDITAR', ['controller' => 'InsituFarmerActivity', 'action' => 'edit', 'idx' => $insituFarmerActivity->insitu_id, 'id' => $insituFarmerActivity->id], ['class' => 'btn btn-primary'] ); ?>
                    <?php } ?>
                    <?php if ($permiso['delete']) { ?>
                        <?php echo $this->Html->link('ELIMINAR', "#",['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$insituFarmerActivity->id])?>
                    <?php } ?>

                        <?php echo $this->Html->link('REGRESAR',['controller' => 'InsituFarmerActivity', 'action' => 'index', 'idx' => $insituFarmerActivity->insitu_id], ['class' => 'btn  btn-default']) ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal  -->
<a data-target="#ConfirmDelete" role="button" data-toggle="modal" id="trigger"></a>
<div class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="myModalLabel"><strong>MENSAJE</strong></h4>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el registro actual?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancelar</button>
                <div id="ajax_button"></div>
            </div>
        </div>
    </div>
</div>

<?php $url = $this->Html->link('Confirmar', ['controller' => 'InsituFarmerActivity', 'action' => 'delete', 'idx' => $insituFarmerActivity->insitu_id,'id' => $insituFarmerActivity->id], ['class' => 'btn btn-success btn-flat btnEliminar' ]) ?>

<script>
    $(".delete-btn").click(function(){
        $("#ajax_button").html('<?php echo $url ?>');
        $("#trigger").click();
    });
</script>


