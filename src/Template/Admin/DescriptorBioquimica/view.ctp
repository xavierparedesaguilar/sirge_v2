
<?php $this->assign('title', $mod_padre); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Descriptor <?php echo $descriptor->name ?></h1>

    <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Caracterización','/admin/microorganismo/caracterizacion');
        $this->Html->addCrumb('Bioquímica', ['controller' => 'BioquimicaMicro', 'action' => 'index']);
        $this->Html->addCrumb('Descriptor', ['controller' => 'DescriptorBioquimica', 'action' => 'index', 'id' => $especie->id ]);
        $this->Html->addCrumb($descriptor->name, ['controller' => 'DescriptorBioquimica', 'action' => 'view', 'idx' => $especie->id, 'id' => $descriptor->id ]);
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

<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                    <div class="pull-right box-tools">

                        <?php if($permiso['edit']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
                                ['controller' => 'DescriptorBioquimica', 'action' => 'edit', 'idx' => $descriptor->specie->id, 'id' => $descriptor->id],
                                ['class' => 'btn btn-primary', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Editar el Descriptor."])
                        ?>

                        <?php } ?>

                        <?php if($permiso['delete']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash"></i>', "#",
                                ['class' => 'btn btn-danger delete-btn', 'escape' => false, 'data-toggle' => "tooltip", 'title' => "Eliminar el Descriptor.", "data-id"=>$descriptor->id])
                        ?>

                        <?php } ?>

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left"></i>',
                                ['controller' => 'DescriptorBioquimica', 'action' => 'index', 'id' => $descriptor->specie->id], ['class' => 'btn btn-default', 'data-toggle' => "tooltip", 'title' => "Retornar al anterior.", 'escape' => false])
                        ?>
                    </div>
                    <br>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                        <!--DATOS PRINCIPALES-->
                                            <tr>
                                                <th scope="row"><?= __('Descriptor') ?></th>
                                                <td><?= h($descriptor->name) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Título') ?></th>
                                                <td><?= h($descriptor->title) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Especie') ?></th>
                                                <td><?= $descriptor->specie->species  ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Recurso') ?></th>
                                                <td><?= $descriptor->resource->name  ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                        <!-- DATOS PRINCIPALES -->
                                            <tr>
                                                <th scope="row"><?= __('Tipo') ?></th>
                                                <td><?= ($descriptor->value_type == 1)? 'CUALITATIVO' : 'CUANTITATIVO' ?></td>
                                            </tr>

                                            <tr>
                                                <th scope="row"><?= __('Catálogo') ?></th>
                                                <td><?= ($descriptor->flg_catalogue == '1')? 'SI' : 'NO' ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Descripción') ?></th>
                                                <td><?= ($descriptor->description) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Estado') ?></th>
                                                <td><?= ($descriptor->status == 1)? 'ACTIVO' : 'INACTIVO' ?></td>
                                            </tr>
                                            <!--FIN DEL MODULO 1-->
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">

                        <?php if($permiso['edit']) { ?>

                        <?php echo $this->Html->link('EDITAR', ['controller' => 'DescriptorBioquimica', 'action' => 'edit', 'id' => $descriptor->id, 'idx' => $descriptor->specie->id], ['class' => 'btn btn-primary'] ); ?>

                        <?php } ?>

                        <?php if($permiso['delete']) { ?>

                        <?php echo $this->Html->link('ELIMINAR', "#",['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$descriptor->id])?>

                        <?php } ?>

                        <?php echo $this->Html->link('REGRESAR', ['controller' => 'DescriptorBioquimica', 'action' => 'index', 'id' => $descriptor->specie->id], ['class' => 'btn btn-default']) ?>
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

<?php $url = $this->Html->link('Confirmar', ['controller' => 'DescriptorBioquimica', 'action' => 'delete', 'idx' => $descriptor->specie->id, 'id' => $descriptor->id], ['class' => 'btn btn-success btn-flat' ]) ?>

<script>
    $(".delete-btn").click(function(){
        $("#ajax_button").html('<?php echo $url ?>');
        $("#trigger").click();
    });
</script>
