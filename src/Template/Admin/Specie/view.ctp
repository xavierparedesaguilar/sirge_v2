<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
<h1>Módulo <?php echo $titulo ?> - <em><?php echo $specie->genus.' '.$specie->species ?></em>  <?php echo $specie->autor;?></h1>

    <?php
        $this->Html->addCrumb('Utilitarios', ['controller'=> 'Administracion', 'action' => 'index']);
        $this->Html->addCrumb('Especie', ['controller'=> 'Specie', 'action' => 'index']);
        $this->Html->addCrumb($specie->species, ['controller'=> 'Specie', 'action' => 'view', 'id' => $specie->id]);
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
                <h3 class="box-title"> <i class="fa fa-search"></i> <?= __('DETALLE DE LA ESPECIE') ?>: <strong><em><?php echo $specie->genus.' '.$specie->species ?></em>  <?php echo $specie->autor;?></strong></h3>
                    <div class="pull-right box-tools">

                       <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                ['controller' => 'Specie', 'action' => 'index'],
                                ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false])
                        ?>

                        <?php if($permiso['edit']){ ?>

                        <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                        ['controller' => 'Specie', 'action' => 'edit', $specie->id], ['class' => 'btn btn-primary','data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] ); ?>

                        <?php } ?>

                        <?php if($permiso['delete']){ ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$specie->id])?>

                        <?php } ?>

                        
                    </div>
                </div>
                <div class="box-body">
                   <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success box-solid">                            
                            <div class="box-body">
                              <div class="row">
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="box-header with-border">
                                       <h4 class="box-title"><i class="fa fa-server" aria-hidden="true"></i> Información General</h4>
                                    </div>
                                    <div class="table-responsive"> 
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <td scope="row" width=50%"><strong><?= __('Nombre Cientifico') ?></strong></td>
                                                <td><strong><em><?php echo $specie->genus.' '.$specie->species ?></em>  <?php echo $specie->autor;?></strong></td>
                                            </tr>

                                            <tr>
                                                <td scope="row" width="50%"><strong><?= __('Genero de la Especie') ?></strong></td>
                                                <td><?php echo h($specie->genus) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width="50%"><strong><?= __('Nombre de la Especie') ?></strong></td>
                                                <td><?php echo h($specie->species) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width="50%"><strong><?= __('Nombre Común') ?></strong></td>
                                                <td><?php echo h($specie->cropname) ?></td>
                                            </tr>                                            
                                            <tr>
                                                <td scope="row" width="50%"><strong><?= __('Autoría de la Especie') ?></strong></td>
                                                <td><?php echo h($specie->autor) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width="50%"><strong><?= __('Familia que pertenece la Especie') ?></strong></td>
                                                <td><?php echo h($specie->family) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="box-header with-border">
                                       <h4 class="box-title">:: Colección y Disponibilidad de la Especie</h4>
                                    </div>
                                    <div class="table-responsive"> 
                                        <table class="table table-striped table-bordered table-hover">                                            
                                            <tr>
                                                <td scope="row" width="50%"><strong><?= __('Colección de la Especie') ?></strong></td>
                                                <td><?php echo $specie->collection->colname ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" width="50%"><strong><?= __('Disponibilidad') ?></strong></td>
                                                <td><?php echo ($this->Number->format($specie->availability) == 1) ? 'SI' : 'NO' ?></td>
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
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/utilitarios/especie', true) ?>"
                           class="btn btn-default"> <i class="fa fa-arrow-left" ></i> REGRESAR
                        </a>

                        <?php if($permiso['edit']){ ?>

                        <?php 
                            echo $this->Html->link('<i class="fa fa-edit"></i> EDITAR', ['controller' => 'Specie', 'action' => 'edit', $specie->id], ['class' => 'btn btn-primary ', 'escape' => false, ""])
                        ?>
                       
                        <?php } ?>

                        <?php if($permiso['delete']){ ?>

                        <?php 
                            echo $this->Html->link('<i class="fa fa-trash"></i> ELIMINAR', "#",['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$specie->id])
                        ?>

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
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/admin/utilitarios/especie/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();
    });
</script>
