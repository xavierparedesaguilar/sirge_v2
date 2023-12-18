
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> - Detalle</h1>

    <?php
        $this->Html->addCrumb('Publicación Catálogo Virtual', ['controller' => 'GestionPublicacionCatalogo', 'action' => 'index']);
        $this->Html->addCrumb('Suscripción Clientes', ['controller' => 'Clients', 'action' => 'index']);
        $this->Html->addCrumb($client->name_client, ['controller' => 'Clients', 'action' => 'view', 'id' => $client->id]);
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
                    <?php if($permiso['edit']){ ?>
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'Clients', 'action' => 'edit', $client->id], ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] ); ?>
                    <?php } ?>
                    <?php if($permiso['delete']){ ?>
                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",'escape' => false, "data-id"=>$client->id])?>
                    <?php } ?>
                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>', ['controller'=>'Clients', 'action'=>'index'],['class'=>'btn btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false]) ?>
                    </div>
                    <br>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <th scope="row"><?= __('Cliente') ?></th>
                                                <td><?= mb_strtoupper($client->name_client, 'utf-8') ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Nombres') ?></th>
                                                <td><?= mb_strtoupper($client->names, 'utf-8') ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Apellidos') ?></th>
                                                <td><?= mb_strtoupper($client->surnames, 'utf-8') ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Código FAO') ?></th>
                                                <td><?= h($client->code_fao) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('E-mail') ?></th>
                                                <td><?= h($client->email) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Género') ?></th>
                                                <td><?= ($client->gender == 1)? 'MASCULINO' : 'FEMENINO' ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Fecha de Nacimiento') ?></th>
                                                <td><?= $client->date_nac ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Estado') ?></th>
                                                <td><?= $client->estadoCliente->name ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('País') ?></th>
                                                <td><?= $client->country->name ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Dirección') ?></th>
                                                <td><?= h($client->origin) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Centro de Estudios') ?></th>
                                                <td><?= h($client->study_center) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Institución') ?></th>
                                                <td><?= h($client->institution) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Comentario') ?></th>
                                                <td><?= $client->commentary ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                    <?php if($permiso['edit']){ ?>
                        <?php echo $this->Html->link('EDITAR', ['controller' => 'Clients', 'action' => 'edit', $client->id], ['class' => 'btn btn-primary'] ); ?>
                    <?php } ?>
                    <?php if($permiso['delete']){ ?>
                        <?php echo $this->Html->link('ELIMINAR', "#",['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$client->id])?>
                    <?php } ?>

                        <?php echo $this->Html->link('REGRESAR', ['controller'=>'Clients', 'action'=>'index'],['class'=>'btn btn-default']) ?>
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

<?php $url = $this->Html->link('Confirmar', ['controller' => 'Clients', 'action' => 'delete', 'id' => $client->id], ['class' => 'btn btn-success btn-flat btnEliminar' ]) ?>

<script>
    $(".delete-btn").click(function(){
        $("#ajax_button").html('<?php echo $url ?>');
        $("#trigger").click();
    });
</script>
