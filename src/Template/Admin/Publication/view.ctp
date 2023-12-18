
<?php $this->assign('title', $mod_modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $mod_modulo.' - '.$publication->title ?></h1>

    <?php
        $this->Html->addCrumb('Publicación Catálogo Virtual', ['controller' => 'GestionPublicacionCatalogo', 'action' => 'index']);
        $this->Html->addCrumb('Publicaciones', ['controller' => 'Publication', 'action' => 'index']);
        $this->Html->addCrumb($publication->id, ['controller' => 'Publication', 'action' => 'view', 'id' => $publication->id]);
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
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'Publication', 'action' => 'edit', $publication->id], ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] ); ?>
                    <?php } ?>
                    <?php if($permiso['delete']){ ?>
                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",'escape' => false, "data-id"=>$publication->id])?>
                    <?php } ?>

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>', ['controller'=>'Publication', 'action'=>'index'],['class'=>'btn btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false]) ?>
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
                                            <tr>
                                                <th scope="row"><?= __('Título') ?></th>
                                                <td><?= h($publication->title) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Autor') ?></th>
                                                <td><?= h($publication->author) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Editorial') ?></th>
                                                <td><?= h($publication->editorial) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Idioma') ?></th>
                                                <td><?= h($publication->languages) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('País') ?></th>
                                                <td><?= $publication->country->name ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Lugar de la Publicación') ?></th>
                                                <td><?= h($publication->public_place) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Institución') ?></th>
                                                <td><?= h($publication->institution) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Descriptores') ?></th>
                                                <td><?= h($publication->descriptors) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <th scope="row"><?= __('Año de Edición') ?></th>
                                                <td><?= $publication->fec_edit ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Mes de Edición') ?></th>
                                                <td><?= $this->Functions->nombreMes($publication->month_edit) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Nro. Edición') ?></th>
                                                <td><?= $this->Number->format($publication->edition) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Número de Páginas') ?></th>
                                                <td><?= $this->Number->format($publication->numpag) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Cantidad de Ejemplares') ?></th>
                                                <td><?= $this->Number->format($publication->copy) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Tipo Publicación') ?></th>
                                                <td><?= (!empty($publication->tipoPublicacion))? $publication->tipoPublicacion->name : '' ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Nro. de Volumen') ?></th>
                                                <td><?= $this->Number->format($publication->volume) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Categoría') ?></th>
                                                <td><?= (!empty($publication->tipoCategoria))? $publication->tipoCategoria->name : '' ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <th scope="row"><?= __('Nota') ?></th>
                                                <td><?= $this->Text->autoParagraph(h($publication->note)); ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?= __('Resumen') ?></th>
                                                <td><?= $this->Text->autoParagraph(h(strip_tags($publication->summary))); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-offset-2 col-xs-12 col-md-4 col-lg-4">
                                    <div class="box box-success">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Imagen Principal</h3>
                                        </div>
                                        <div class="box-body">
                                            <center>
                                                <?php if($publication->principal_image == NULL || $publication->principal_image == '' ){ ?>
                                                    <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                <?php } else {

                                                    echo $this->Html->link(
                                                         $this->Html->image('/'.$publication->principal_image, ['class' => "img-responsive", 'style' => "height: 307px"]),
                                                            '/'.$publication->principal_image, ['escapeTitle' => false, 'data-fancybox' => "images"] );
                                                 } ?>
                                            </center>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-xs-12 col-md-4 col-lg-4">
                                    <div class="box box-success">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Documento</h3>
                                        </div>
                                        <div class="box-body">
                                            <center>
                                                <?php if($publication->documents == NULL || $publication->documents == '' ){ ?>
                                                    <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                <?php } else {  ?>
                                                    <iframe src="/sirge/<?php echo $publication->documents ?>" style="height: 307px;"></iframe>
                                                <?php } ?>
                                            </center>
                                        </div>
                                        <div class="box-footer">
                                            <center>
                                               <?php if($publication->documents != NULL || $publication->documents != '' ){ ?>
                                                    <a href="/sirge/<?php echo $publication->documents ?>" data-fancybox="images">Ver Documento</a>
                                                <?php } ?>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                    <?php if($permiso['edit']){ ?>
                        <?php echo $this->Html->link('EDITAR', ['controller' => 'Publication', 'action' => 'edit', $publication->id], ['class' => 'btn btn-primary'] ); ?>
                    <?php } ?>
                    <?php if($permiso['delete']){ ?>
                        <?php echo $this->Html->link('ELIMINAR', "#",['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$publication->id])?>
                    <?php } ?>
                        <?php echo $this->Html->link('REGRESAR', ['controller'=>'Publication', 'action'=>'index'],['class'=>'btn btn-default']) ?>
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

<?php $url = $this->Html->link('Confirmar', ['controller' => 'Publication', 'action' => 'delete', 'id' => $publication->id], ['class' => 'btn btn-success btn-flat btnEliminar' ]) ?>

<script>
    $(".delete-btn").click(function(){
        $("#ajax_button").html('<?php echo $url ?>');
        $("#trigger").click();
    });
</script>

<?php

    $this->Html->css(['/assets/js/fancybox/dist/jquery.fancybox.min.css'], ['block' => 'css']);
    $this->Html->script(['/assets/js/fancybox/dist/jquery.fancybox.min.js'], ['block' => 'script']);

    $this->Html->scriptBlock('$("[data-fancybox]").fancybox();', ['block' => true]);

?>

