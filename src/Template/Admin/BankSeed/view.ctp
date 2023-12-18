<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">

    <h1>Módulo Recursos Fitogenéticos - Inventarios - Banco de Semillas</h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Gestión Inventario', '/admin/fitogenetico/gestion-inventario');
        $this->Html->addCrumb('Banco Semilla', ['controller' => 'BankSeed', 'action' => 'index']);
        $this->Html->addCrumb($bankSeed->id, ['controller' => 'BankSeed', 'action' => 'view','id'=>$bankSeed->id]);
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
<!-- /Page Header -->
<!-- Page Body -->

<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-search"></i> <?= __('DETALLE DEL REGISTRO ') ?>:<strong><?php echo$bankSeed->codaccesion->accenumb?> - LOTE <?php echo$bankSeed->lotnumb ?></strong></h3>
                    <div class="pull-right box-tools">

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                ['controller' => 'BankSeed', 'action' => 'index'],
                                ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false])
                        ?>

                        <?php if($permiso['edit'] && $validar) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-edit" ></i>',
                                    ['controller' => 'BankSeed', 'action' => 'edit', $bankSeed->id],
                                    ['class' => 'btn btn-primary', 'data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] );
                        ?>

                        <?php } ?>

                        <?php if($permiso['delete'] && $validar) { ?>


                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",
                                    ['class' => 'btn btn-danger delete-btn','data-toggle'=> "tooltip",  'title'=> "Eliminar",
                                    'escape' => false, "data-id"=>$bankSeed->id])
                        ?>

                        <?php } ?>
                    </div>
                    <br>
                </div>
   
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success box-solid">
                            <div class="box-body"> 
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <div class="box-header with-border">
                                             <h3 class="box-title"><strong><i class="fa fa-file-o"></i> DATOS GENERALES</strong></h3>
                                        </div>
                                    </div>
                                </div>                           
                                <div class="row">  
                                        <div class="col-xs-12 col-md-6 col-lg-6">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title"><i class="fa fa-toggle-on" aria-hidden="true"></i> Información Datos Pasaporte</h3>
                                                    </div>
                                                    <div class="table-responsive">  
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Código de Accesión (CODPER)') ?></strong></td>
                                                                <td scope="row"><strong><?= h($bankSeed->codaccesion->accenumb) ?></strong></td>
                                                            </tr> 
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Nombre de Accesión') ?></strong></td>
                                                                <td scope="row"><?= h($bankSeed->codaccesion->accname) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Otro Código de Accesión') ?></strong></td>
                                                                <td scope="row"><?= h($bankSeed->codaccesion->othenumb) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Colección') ?></strong></td>
                                                                <td scope="row"><?= h($bankSeed->codaccesion->collectionsemilla->colname) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Nombre Científico') ?></strong></td>
                                                                <td scope="row"><em><?php echo $bankSeed->codaccesion->especiesemilla->genus.' '.$bankSeed->codaccesion->especiesemilla->species; ?></em> <?php echo $bankSeed->codaccesion->especiesemilla->autor?></td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Nombre Común') ?></strong></td>
                                                                <td scope="row"><?= h($bankSeed->codaccesion->especiesemilla->cropname) ?></td>
                                                            </tr>                                              
                                                        </table>
                                                    </div>
                                                </div>                                        
                                            </div>
                                                                                                                       
                                        </div>
                                        <div class="col-xs-12 col-md-6 col-lg-6">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div class="box-header with-border">
                                                    <h3 class="box-title"><i class="fa fa-toggle-on" aria-hidden="true"></i>  Procedencia y Fecha de Cosecha de la Semilla</h3>
                                                    </div>
                                                    <div class="table-responsive">  
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Lugar de Procedencia del materia') ?></strong></td>
                                                                <td scope="row"><?php echo h($bankSeed->origin) ?></td>
                                                            </tr> 
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Fecha de Cosecha de la Semilla') ?></strong></td>
                                                                <td scope="row"><?php echo $bankSeed->harvestdate ?></td>
                                                            </tr>
                                                                                                      
                                                        </table>
                                                    </div>
                                                </div>
                                                                                        
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div class="box-header with-border">
                                                    <h3 class="box-title"><i class="fa fa-pagelines"></i> Informacion de la Semilla - Banco</h3>
                                                    </div>
                                                    <div class="table-responsive">  
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Fecha de Introducción al Banco') ?></strong></td>
                                                                <td scope="row"><?php echo $bankSeed->acqdate==NULL?'': date('d-m-Y', strtotime($bankSeed->acqdate)) ?></td>
                                                            </tr> 
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Nonbre del Responsable del material') ?></strong></td>
                                                                <td scope="row"><?php echo h($bankSeed->responsible) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Código Interno asignado por el Responsable') ?></strong></td>
                                                                <td scope="row"><?php echo h($bankSeed->detecnumb) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Disponibilidad del Lote de la Accesión') ?></strong></td>
                                                                <td scope="row"><?php echo $bankSeed->disponibilidad==NULL?'':$bankSeed->disponibilidad->name;?></td>
                                                            </tr>
                                                                                                      
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>      
                                        </div>
                                </div>                                
                            </div>                            
                        </div>
                        <div class="box box-success box-solid">
                            <div class="box-body"> 
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <div class="box-header with-border">
                                             <h3 class="box-title"><strong><i class="fa fa-pagelines"></i> DATOS DE LA SEMILLA</a></strong></h3>
                                        </div>
                                    </div>
                                </div>                           
                                <div class="row">       
                                        <div class="col-xs-12 col-md-6 col-lg-6">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title"><i class="fa fa-toggle-on" aria-hidden="true"></i> Información General</h3>
                                                    </div>
                                                    <div class="table-responsive">  
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Tipo de Colección que se Conserva la Semilla') ?></strong></td>
                                                                <td scope="row"><?php echo $bankSeed->material==NULL?'':$bankSeed->material->name ?></td>
                                                            </tr> 
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Tipo de Semilla') ?></strong></td>
                                                                <td scope="row"><?php echo $bankSeed->conservacion ==NULL?'':$bankSeed->conservacion->name ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Tipo de Reproducción') ?></strong></td>
                                                                <td scope="row"><?php echo $bankSeed->propagacion==NULL ?'':$bankSeed->propagacion->name; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Tipo de Refrescamiento') ?></strong></td>
                                                                <td scope="row"><?php echo $bankSeed->refrescamiento==NULL?'':$bankSeed->refrescamiento->name ?></td>
                                                            </tr>                                                                                                          
                                                        </table>
                                                    </div>
                                                </div>                                                                                  
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title"><i class="fa fa-pagelines"></i> Evaluación de la Semilla</h3>
                                                    </div>
                                                    <div class="table-responsive">  
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Porcentaje de Germinación (%)') ?></strong></td>
                                                                <td scope="row"><strong><?= h($bankSeed->germination)?></strong></td>
                                                            </tr> 
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Porcentaje de Humedad (%)') ?></strong></td>
                                                                <td scope="row"><?= h($bankSeed->seedhum) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Porcentaje de Viabilidad (%)') ?></strong></td>
                                                                <td scope="row"><?= h($bankSeed->viability) ?></td>
                                                            </tr>                                                                                                                                                                    
                                                        </table>
                                                    </div>
                                                </div>                                                                                  
                                            </div> 
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title"><i class="fa fa-thermometer-quarter" aria-hidden="true"></i> Medio de Conservación y Ubicación</h3>
                                                    </div>
                                                    <div class="table-responsive">  
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Lugar de Almacenamiento') ?></strong></td>
                                                                <td scope="row"><strong><?= $bankSeed->almacenamiento==NULL?'':$bankSeed->almacenamiento->name?></strong></td>
                                                            </tr> 
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Ubicación del material (estantería)') ?></strong></td>
                                                                <td scope="row"><?= h($bankSeed->shelving) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Temperatura (°C)') ?></strong></td>
                                                                <td scope="row"><?= h($bankSeed->temp) ?></td>
                                                            </tr>  
                                                            <tr>
                                                                <td scope="row" width="50%"><strong><?= __('Humedad del medio de conservación (%)') ?></strong></td>
                                                                <td scope="row"><?= h($bankSeed->humidity)?></td>
                                                            </tr>                                                                                                                                                                  
                                                        </table>
                                                    </div>
                                                </div>
                                                                                  
                                            </div>                                     
                                        </div>
                                        <div class="col-xs-12 col-md-6 col-lg-6">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div class="box-header with-border">
                                                      <h3 class="box-title"><i class="fa fa-balance-scale" aria-hidden="true"></i>  Peso y Cantidad por Semilla</h3>
                                                      <p></p><p>Información de los datos de peso y cantidad de Semillas</p>
                                                    </div>
                                                    <div class="table-responsive">  
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <tr>
                                                                <td scope="row" width="40%"><strong>Información de Peso y Cantidad totales</strong></td>
                                                                <td scope="row" width="15%"><strong><?= __('Peso Total') ?></strong></td>
                                                                <td scope="row" width="15%" class="success text-primary"><strong><?php echo h($bankSeed->seeweight)+h($bankSeed->p1)+h($bankSeed->p2)+h($bankSeed->p3)+h($bankSeed->p4)+h($bankSeed->p5)?> (g)</strong></td>
                                                                <td scope="row" width="15%"><strong><?= __('Cantidad Total') ?></strong></td>
                                                                <td scope="row" width="15%" class="success text-primary"><strong><?php echo h($bankSeed->seednumb)+h($bankSeed->n1)+h($bankSeed->n2)+h($bankSeed->n3)+h($bankSeed->n4)+h($bankSeed->n5)?> semillas</strong></td>
                                                            </tr>                                     
                                                        </table>
                                                    </div>
                                                    <div class="box-header with-border">
                                                      <h3 class="box-title"><strong><i class="fa fa-toggle-on" aria-hidden="true"></i>  Contenedor Primario</strong></h3>                                                    
                                                    </div>
                                                    <div class="table-responsive">  
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <tr>
                                                                <td scope="row" width="40%"><strong><?= __('Contenedor 1') ?></strong></td>
                                                                <td scope="row" width="15%"><strong><?= __('Peso') ?></strong></td>
                                                                <td scope="row" width="15%">
                                                                    <?php                                                                    
                                                                    $seeweight = h($bankSeed->seeweight);                                                                   
                                                                    if($seeweight!=''){
                                                                        echo $seeweight = $seeweight.' (g)';
                                                                    }else{
                                                                        echo $seeweight = '';
                                                                    } 
                                                                    ?>
                                                                </td>
                                                                <td scope="row" width="15%"><strong><?= __('Cantidad') ?></strong></td>
                                                                <td scope="row" width="15%">
                                                                    <?php                                                                      
                                                                     $seednumb = h($bankSeed->seednumb);                                                                   
                                                                     if($seednumb!=''){
                                                                         echo $seednumb = $seednumb.' semillas';
                                                                     }else{
                                                                         echo $seednumb = '';
                                                                     } 
                                                                     ?> 
                                                                </td>
                                                            </tr>                                       
                                                        </table>
                                                    </div>
                                                    <div class="box-header with-border">
                                                      <h3 class="box-title"><strong><i class="fa fa-toggle-on" aria-hidden="true"></i>  Contenedor Secundario</strong></h3>                                                    
                                                    </div>
                                                    <div class="table-responsive">  
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <tr>
                                                                <td scope="row" width="40%"><strong><?= __('Contenedor 2') ?></strong></td>
                                                                <td scope="row" width="15%"><strong><?= __('Peso') ?></strong></td>
                                                                <td scope="row" width="15%">
                                                                    <?php                                                                    
                                                                    $p1 = h($bankSeed->p1);                                                                   
                                                                    if($p1!=''){
                                                                        echo $p1 = $p1.' (g)';
                                                                    }else{
                                                                        echo $p1 = '';
                                                                    } 
                                                                    ?>
                                                                </td>
                                                                <td scope="row" width="15%"><strong><?= __('Cantidad') ?></strong></td>
                                                                <td scope="row" width="15%">
                                                                    <?php                                                                      
                                                                     $n1 = h($bankSeed->n1);                                                                   
                                                                     if($n1!=''){
                                                                         echo $n1 = $n1.' semillas';
                                                                     }else{
                                                                         echo $n1 = '';
                                                                     } 
                                                                     ?> 
                                                                </td>
                                                            </tr>  
                                                            <tr>
                                                                <td scope="row" width="40%"><strong><?= __('Contenedor 3') ?></strong></td>
                                                                <td scope="row" width="15%"><strong><?= __('Peso') ?></strong></td>
                                                                <td scope="row" width="15%">
                                                                    <?php                                                                    
                                                                    $p2 = h($bankSeed->p2);                                                                   
                                                                    if($p2!=''){
                                                                        echo $p2 = $p2.' (g)';
                                                                    }else{
                                                                        echo $p2 = '';
                                                                    } 
                                                                    ?>
                                                                </td>
                                                                <td scope="row" width="15%"><strong><?= __('Cantidad') ?></strong></td>
                                                                <td scope="row" width="15%">
                                                                    <?php                                                                      
                                                                     $n2 = h($bankSeed->n2);                                                                   
                                                                     if($n2!=''){
                                                                         echo $n2 = $n2.' semillas';
                                                                     }else{
                                                                         echo $n2 = '';
                                                                     } 
                                                                     ?> 
                                                                </td>
                                                            </tr>  
                                                            <tr>
                                                                <td scope="row" width="40%"><strong><?= __('Contenedor 4') ?></strong></td>
                                                                <td scope="row" width="15%"><strong><?= __('Peso') ?></strong></td>
                                                                <td scope="row" width="15%">
                                                                    <?php                                                                    
                                                                    $p3 = h($bankSeed->p3);                                                                   
                                                                    if($p3!=''){
                                                                        echo $p3 = $p3.' (g)';
                                                                    }else{
                                                                        echo $p3 = '';
                                                                    } 
                                                                    ?>
                                                                </td>
                                                                <td scope="row" width="15%"><strong><?= __('Cantidad') ?></strong></td>
                                                                <td scope="row" width="15%">
                                                                    <?php                                                                      
                                                                     $n3 = h($bankSeed->n3);                                                                   
                                                                     if($n3!=''){
                                                                         echo $n3 = $n3.' semillas';
                                                                     }else{
                                                                         echo $n3 = '';
                                                                     } 
                                                                     ?> 
                                                                </td>
                                                            </tr>   
                                                            <tr>
                                                                <td scope="row" width="40%"><strong><?= __('Contenedor 5') ?></strong></td>
                                                                <td scope="row" width="15%"><strong><?= __('Peso') ?></strong></td>
                                                                <td scope="row" width="15%">
                                                                    <?php                                                                    
                                                                    $p4 = h($bankSeed->p4);                                                                   
                                                                    if($p4!=''){
                                                                        echo $p4 = $p4.' (g)';
                                                                    }else{
                                                                        echo $p4 = '';
                                                                    } 
                                                                    ?>
                                                                </td>
                                                                <td scope="row" width="15%"><strong><?= __('Cantidad') ?></strong></td>
                                                                <td scope="row" width="15%">
                                                                    <?php                                                                      
                                                                     $n4 = h($bankSeed->n4);                                                                   
                                                                     if($n4!=''){
                                                                         echo $n4 = $n4.' semillas';
                                                                     }else{
                                                                         echo $n4 = '';
                                                                     } 
                                                                     ?> 
                                                                </td>
                                                            </tr>  
                                                            <tr>
                                                                <td scope="row" width="40%"><strong><?= __('Contenedor 6') ?></strong></td>
                                                                <td scope="row" width="15%"><strong><?= __('Peso') ?></strong></td>
                                                                <td scope="row" width="15%">
                                                                    <?php                                                                     
                                                                        $p5 = h($bankSeed->p5);                                                                   
                                                                        if($p5!=''){
                                                                            echo $p5 = $p5.' (g)';
                                                                        }else{
                                                                            echo $p5 = '';
                                                                        } 
                                                                     ?>
                                                                </td>
                                                                <td scope="row" width="15%"><strong><?= __('Cantidad') ?></strong></td>
                                                                <td scope="row" width="15%">
                                                                    <?php                                                                        
                                                                       $n5 = h($bankSeed->n5);                                                                   
                                                                       if($n5!=''){
                                                                           echo $n5 = $n5.' semillas';
                                                                       }else{
                                                                           echo $n5 = '';
                                                                       } 
                                                                    ?> 
                                                                </td>
                                                            </tr>                                       
                                                        </table>
                                                    </div>
                                                </div>                                                                                        
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div class="box-header with-border">
                                                    <h3 class="box-title"><i class="fa fa-trash" aria-hidden="true"></i> Descarte de Semilla</h3>
                                                    </div>
                                                    <div class="table-responsive">  
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <tr>
                                                                <td scope="row" width="40%"><strong>Información de Peso y Cantidad descarte</strong></td>
                                                                <td scope="row" width="15%"><strong><?= __('Peso Total') ?></strong></td>
                                                                <td scope="row" width="15%" class="success text-danger">
                                                                    <?php 
                                                                        $descseedp = h($bankSeed->discweight);                                                                   
                                                                        if($descseedp!=''){
                                                                            echo $descseedp = $descseedp.' (g)';
                                                                        }else{
                                                                            echo $descseedp = '';
                                                                        }
                                                                    ?>                                                                    
                                                                </td>
                                                                <td scope="row" width="15%"><strong><?= __('Cantidad Total') ?></strong></td>
                                                                <td scope="row" width="15%" class="success text-danger">
                                                                    <?php  
                                                                        $descseedc = h($bankSeed->discnumb);
                                                                        if($descseedc!=''){
                                                                            echo $descseedc = $descseedc.' semillas';
                                                                        }else{
                                                                            echo $descseedc = '';
                                                                        }
                                                                    ?>                                                                     
                                                                </td>
                                                            </tr>                                     
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>      
                                        </div>
                                </div>                                
                            </div>                            
                        </div>
                        <div class="box box-success box-solid">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12 col-lg-12">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title"><strong><i class="fa fa-viadeo" aria-hidden="true"></i> CARACTERIZACIÓN DE LA SEMILLA</strong></h3>
                                                </div>
                                                <div class="box-header with-border">
                                                    <h3 class="box-title"><i class="fa fa-viadeo" aria-hidden="true"></i> Caracterización de la Semilla</h3>
                                                </div>
                                                <div class="table-responsive">  
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <tr>
                                                            <td scope="row" width="50%"><strong><?= __('Forma de la Semilla') ?></strong></td>
                                                            <td scope="row"><strong><?= h($bankSeed->shape) ?></strong></td>
                                                        </tr> 
                                                        <tr>
                                                            <td scope="row" width="50%"><strong><?= __('Longitud de la Semilla (cm)') ?></strong></td>
                                                            <td scope="row"><?= h($bankSeed->size) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row" width="50%"><strong><?= __('Color Primario de la Semilla') ?></strong></td>
                                                            <td scope="row"><?= h($bankSeed->color) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row" width="50%"><strong><?= __('Rendimiento en Toneladas') ?></strong></td>
                                                            <td scope="row"><?php echo $bankSeed->performance; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row" width="50%"><strong><?= __('Ciclo Vegetativo') ?></strong></td>
                                                            <td scope="row"><?= h($bankSeed->ciclovegetativo==NULL?'':$bankSeed->ciclovegetativo->name) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row" width="50%"><strong><?= __('Tiempo Vegetativo') ?></strong></td>
                                                            <td scope="row"><?= h($bankSeed->time) ?></td>
                                                        </tr>                                                
                                                    </table>
                                                </div>
                                                <div class="box-header with-border">
                                                    <h3 class="box-title"><i class="fa fa-toggle-on" aria-hidden="true"></i> Patogenos</h3>
                                                </div>
                                                <div class="table-responsive">  
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <tr>
                                                            <td scope="row" width="50%"><strong><?= __('Resistencia del material a enfermedades') ?></strong></td>
                                                            <td scope="row"><strong><?= h($bankSeed->resistance) ?></strong></td>
                                                        </tr> 
                                                        <tr>
                                                            <td scope="row" width="50%"><strong><?= __('Tolerancia') ?></strong></td>
                                                            <td scope="row"><?= h($bankSeed->tolerancia) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row" width="50%"><strong><?= __('Susceptibilidad del material') ?></strong></td>
                                                            <td scope="row"><?php echo $bankSeed->susceptibility; ?></td>
                                                        </tr>                                                                                                             
                                                    </table>
                                                </div>
                                            </div>                                        
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><strong><i class="fa fa-photo"></i> FOTOGRAFÍA</strong></h3>
                                        </div>
                                        <div class="col-xs-12 col-md-6 col-lg-6">
                                            <div class="box-body">
                                                <center>
                                                    <?php if($bankSeed->accimag1 == NULL || $bankSeed->accimag1 == '' ){ ?>
                                                        <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                    <?php } else { ?>
                                                        <img src="<?php echo $this->Url->build('/', true).$bankSeed->accimag1 ?>" class="img-responsive"  style="height: 207px">
                                                    <?php } ?>
                                                </center>
                                            </div>
                                            <div class="box-footer">
                                                <center>
                                                    <p><?= h($bankSeed->remarks1) ?></p>
                                                </center>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6 col-lg-6">
                                            <div class="box-body">
                                                <center>
                                                     <?php if($bankSeed->accimag2 == NULL || $bankSeed->accimag2 == '' ){ ?>
                                                        <img src="<?php echo $this->Url->build('/img/noimagen.jpg', true) ?>" class="img-responsive">
                                                    <?php } else { ?>
                                                        <img src="<?php echo $this->Url->build('/', true).$bankSeed->accimag2 ?>" class="img-responsive" style="height: 207px">
                                                    <?php } ?>
                                                </center>
                                            </div>
                                            <div class="box-footer">
                                                <center>
                                                    <p><?= h($bankSeed->remarks2) ?></p>
                                                </center>
                                            </div>
                                        </div>  
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><strong><i class="fa fa-ge"></i> DATOS ADICIONALES</a></strong></h3>
                                        </div> 
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><i class="fa fa-toggle-on" aria-hidden="true"></i> Observaciones o Anotaciones</h3>
                                        </div>
                                        <div class="table-responsive">  
                                            <table class="table table-hover">
                                                <tr>                                                 
                                                    <td scope="row"><strong><?= h($bankSeed->remarks) ?></strong></td>
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
                        <!-- imagen flecha volver: zmdi zmdi-long-arrow-return -->

                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/gestion-inventario/banco-semilla/'.$bankSeed->bank_seed_id, true) ?>"
                           class="btn btn-default"><i class="fa fa-arrow-left" ></i> REGRESAR
                        </a>

                        <?php if($permiso['edit'] && $validar) { ?>

                         <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/gestion-inventario/banco-semilla/editar/'.$bankSeed->id, true) ?>"
                           class="btn btn-primary"> <i class="fa fa-edit" ></i> EDITAR REGISTRO
                        </a>

                        <?php } ?>

                        <?php if($permiso['delete'] && $validar) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i> ELIMINAR', "#",
                                        ['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$bankSeed->id, 'data-toggle' => "tooltip", 'title' => "Eliminar el Banco Semilla."])
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
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/gestion-inventario/banco-semilla/eliminar/', true)?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();
    });
</script>

