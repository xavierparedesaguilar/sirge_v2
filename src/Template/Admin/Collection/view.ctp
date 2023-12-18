<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $titulo ?> - <?php echo $collection->colname ?></h1>

    <?php
        $this->Html->addCrumb('Utilitarios', ['controller'=> 'Administracion', 'action' => 'index']);
        $this->Html->addCrumb('Colección', ['controller'=> 'Collection', 'action' => 'index']);
        $this->Html->addCrumb($collection->colname, ['controller'=> 'Collection', 'action' => 'view', 'id' => $collection->id]);
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
                    <h3 class="box-title"> <i class="fa fa-search"></i> <?= __('DETALLE DE LA COLECCIÓN') ?>: <strong><?php echo $collection->colname ?></strong></h3>
                    <div class="pull-right box-tools">

                       <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                ['controller' => 'Collection', 'action' => 'index'],
                                ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false])
                        ?>

                        <?php if($permiso['edit']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                        ['controller' => 'Collection', 'action' => 'edit', $collection->id], ['class' => 'btn btn-primary','data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] ); ?>

                        <?php } ?>

                        <?php if($permiso['delete']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",
                        ['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$collection->id])?>

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
                                            <h4 class="box-title"><i class="fa fa-server" aria-hidden="true"></i> Información de la Colección</h4>
                                        </div>
                                        <div class="table-responsive"> 
                                             <table class="table table-striped table-bordered table-hover">
                                               <tr>
                                                 <td scope="row" width=50%"><strong><?= __('Nombre de la Colección') ?></strong></td>
                                                 <td><strong><?=  h($collection->colname)  ?></strong></td>
                                               </tr>
                                               <tr>
                                                 <td scope="row" width="50%"><strong><?= __('Tipo de Recurso') ?></strong></td>
                                                 <td><?php echo ($collection->resource == NULL || $collection->resource == '')? '' : $collection->resource->name ?></td>
                                               </tr>
                                               <tr>
                                                 <td scope="row" width="50%"><strong><?= __('Grupo de la Colección') ?></strong></td>
                                                 <td><?php echo h($collection->colgroup) ?></td>
                                               </tr>
                                               <tr>
                                                 <td scope="row" width="50%"><strong><?= __('Estación Experimental') ?></strong></td>
                                                 <td><?php echo ($collection->station == NULL || $collection->station == '')? '' : $collection->station->eea ?></td>
                                               </tr>
                                               <tr>
                                                 <td scope="row" width="50%"><strong><?= __('Disponibilidad de la Colección') ?></strong></td>
                                                 <td><?php echo ($this->Number->format($collection->availability) == 1)? 'SI' : 'NO' ?></td>
                                               </tr>
                                            </table>
                                        </div>
                                  </div>
                                  <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="box-header with-border">
                                            <h4 class="box-title"><i class="fa fa-university" aria-hidden="true"></i> Lugares de Almacenamiento donde se encuentra la Colección</h4>
                                        </div>
                                        <div class="table-responsive">  
                                             <table class="table table-striped table-bordered table-hover">
                                             <tr>
                                                 <td scope="row" width=50%"><strong><?php echo __('Banco de Campo') ?></strong></td>
                                                 <td><?php echo ($this->Number->format($collection->bfield) == 1)? 'SI' : 'NO' ?></td>
                                               </tr>
                                               <tr>
                                                 <td scope="row" width="50%"><strong><?= __('Banco de Semilla') ?></strong></td>
                                                 <td><?php echo ($this->Number->format($collection->bseed) == 1)? 'SI' : 'NO' ?></td>
                                               </tr>
                                               <tr>
                                                 <td scope="row" width="50%"><strong><?php echo __('Banco de Invitro') ?></strong></td>
                                                 <td><?php echo ($this->Number->format($collection->invitro) == 1)? 'SI' : 'NO' ?></td>
                                               </tr>
                                               <tr>
                                                 <td scope="row" width="50%"><strong><?php echo __('Banco de ADN') ?></strong></td>
                                                 <td><?php echo ($this->Number->format($collection->bdna) == 1)? 'SI' : 'NO' ?></td>
                                               </tr>
                                               <tr>
                                                 <td scope="row" width="50%"><strong><?php echo __('Conservación Insitu') ?></strong></td>
                                                 <td><?php echo ($this->Number->format($collection->insitu) == 1)? 'SI' : 'NO' ?></td>
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
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/utilitarios/coleccion', true) ?>"
                           class="btn btn-default"> <i class="fa fa-arrow-left" ></i> REGRESAR
                        </a>
  
                        <?php if($permiso['edit']){ ?>

                        <?php echo $this->Html->link('<i class="fa fa-edit" ></i> EDITAR REGISTRO',
                                ['controller' => 'Collection', 'action' => 'edit', 'id' => $collection->id],
                                ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",'escape'=>false])
                         ?>

             

                        <?php } ?>

                        <?php if($permiso['delete']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash"></i> ELIMINAR REGISTRO', "#",['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$collection->id])?>

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
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/admin/utilitarios/coleccion/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();
    });
</script>

