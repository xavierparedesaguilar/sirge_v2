<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
<h1>Módulo Estación Experimental Agraria : <?php echo h($station->eea) ?></h1>

    <?php
        $this->Html->addCrumb('Administración Base de Datos', ['controller'=> 'Administracion', 'action' => 'index']);
        $this->Html->addCrumb('Estación Experimental', ['controller'=> 'Station', 'action' => 'index']);
        $this->Html->addCrumb($station->eea, ['controller' => 'Station', 'action' => 'view', 'id' => $station->id]);
        $this->Html->addCrumb( 'Ver' );

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
                <h3 class="box-title"> <i class="fa fa-search"></i> <?= __('INFORMACIÓN DE LA ESTACIÓN EXPERIMENTAL AGRARIA') ?> </h3>

                    <div class="pull-right box-tools">
                        
                     <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                ['controller' => 'Station', 'action' => 'index'],
                                ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false])
                        ?>

                        <?php if($permiso['edit']){ ?>
                        <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                                    ['controller' => 'Station', 'action' => 'edit', $station->id],
                                    ['class' => 'btn btn-primary','data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] );?>
                        <?php } ?>

                        <?php if($permiso['delete']){ ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",'escape' => false, "data-id"=>$station->id])?>

                        <?php } ?>


                    </div>
                    <br>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success box-solid">   
                            <div class="box-body">
                                <div class="row">
                                  <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="box-header with-border">
                                       <h4 class="box-title"><i class="fa fa-home" aria-hidden="true"></i> Información de la EEA</h4>
                                    </div>
                                    <div class="table-responsive"> 
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <td scope="row" width=50%"><strong><?= __('Nombre de la EEA.') ?></strong></td>
                                                <td><strong><?php echo h($station->eea) ?></strong></td>
                                            </tr>                                           
                                        </table>
                                    </div>
                                    <div class="box-header with-border">
                                       <h4 class="box-title"><i class="fa fa-address-card-o" aria-hidden="true"></i> Información del Responsable de RRGG.</h4>
                                    </div>
                                    <div class="table-responsive"> 
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                               <th scope="row"><?php echo __('Nombre del Responsable') ?></th>
                                               <td><?php echo h($station->responsible) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo __('Celular') ?></th>
                                                <td><?php echo h($station->celphone) ?></td>
                                            </tr>
                                            <tr>
                                               <th scope="row"><?php echo __('Correo Electrónico') ?></th>
                                                <td><?php echo h($station->email) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width="50%"><strong><?= __('Teléfono') ?></strong></td>
                                                <td><?php echo h($station->telephone) ?></td>
                                            </tr>                                            
                                            
                                        </table>
                                    </div>
                                    
                                  </div>
                                  <div class="col-xs-12 col-md-6 col-lg-6">
                                  <div class="box-header with-border">
                                       <h4 class="box-title"><i class="fa fa-location-arrow"></i> Datos de Ubicación de la EEA</h4>
                                    </div>
                                    <div class="table-responsive"> 
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                               <th scope="row"><?php echo __('País') ?></th>
                                               <td><?php echo $station->country->name ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo __('Departamento') ?></th>
                                                <td><?php echo ($station->ubigeo_id == NULL || $station->ubigeo_id == '') ? '' : $station->ubigeo->departamento->nombre ?></td>
                                            </tr>
                                            <tr>
                                               <th scope="row"><?php echo __('Provincia') ?></th>
                                                <td><?php echo ($station->ubigeo_id == NULL || $station->ubigeo_id == '') ? '' : $station->ubigeo->provincia  ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width="50%"><strong><?= __('Distrito') ?></strong></td>
                                                <td><?php echo ($station->ubigeo_id == NULL || $station->ubigeo_id == '') ? '' : $station->ubigeo->distrito; ?></td>
                                            </tr> 
 
                                            <tr>
                                                <td scope="row" width="50%"><strong><?= __('Localidad') ?></strong></td>
                                                <td><?php echo h($station->localidad) ?></td>
                                            </tr> 
                                            <tr>
                                                <td scope="row" width="50%"><strong><?= __('Ubicación') ?></strong></td>
                                                <td><?php echo h($station->collsite) ?></td>
                                            </tr>                                           
                                            
                                        </table>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-right">

                      

                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/utilitarios/estacion-experimental', true) ?>"
                           class="btn btn-default"> <i class="fa fa-arrow-left" ></i> REGRESAR
                        </a>

                        <?php if($permiso['edit']){ ?>
                                                
                        <?php 
                            echo $this->Html->link('<i class="fa fa-edit"></i> EDITAR', ['controller' => 'Station', 'action' => 'edit', $station->id], ['class' => 'btn btn-primary ', 'escape' => false, ""])
                        ?>

                        <?php } ?>

                        <?php if($permiso['delete']){ ?>
                        <?php echo $this->Html->link('<i class="fa fa-trash"></i> ELIMINAR', "#",['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$station->id])?>
                        <?php } ?>
                        
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

<script>
    $(".delete-btn").click(function(){
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/admin/utilitarios/estacion-experimental/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();
    });
</script>
