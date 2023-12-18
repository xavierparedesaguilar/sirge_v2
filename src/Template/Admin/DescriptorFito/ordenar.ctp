
<?php $this->assign('title', $titulo); ?>

<section class="content-header">
    <h1>Módulo <?php echo $titulo?></h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Caracterización','/admin/fitogenetico/caracterizacion');
        $this->Html->addCrumb('Fenotípica', ['controller' => 'FenotipicaFito', 'action' => 'index']);
        $this->Html->addCrumb( ucfirst(mb_strtolower($mod_specie->collection->colname,'UTF-8')).' - '.ucfirst(mb_strtolower($mod_specie->species,'UTF-8')),
                    ['controller' => 'DescriptorFito', 'action' => 'caracterizacion', 'idx' => $mod_specie->id, 'idy' => $mod_specie->collection->id ]);
        $this->Html->addCrumb('Ordenar');

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


  <style>
      #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
      #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
      #sortable li span { position: absolute; margin-left: -1.3em; }
  </style>
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Listado de <?php echo $titulo_lista ?></strong></h3>
                    <div class="pull-right box-tools">
                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                ['controller' => 'DescriptorFito', 'action' => 'caracterizacion', 'idx'=>$idx , 'idy' => $idy],
                                ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false])
                        ?>
                    </div>
                </div>
                <?php echo $this->Form->create(NULL, ['url' => ['controller' => 'DescriptorFito', 'action' => 'ordenar', 'idx'=> $idx, 'idy' => $idy] ]) ?>
                <div class="box-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12" >
                                 <ol class="simple_with_animation vertical">
                                    <?php

                                    $total = count($descriptor_especie)/2;

                                    foreach ($descriptor_especie as $key => $descriptor):
                                        if($key < $total ){
                                    ?>
                                            <li><?php echo $descriptor->name ?>
                                            <?php echo $this->Form->control('descriptor_id[]', ['type' => 'hidden', 'value' => $descriptor->id]) ?>
                                            </li>

                                    <?php
                                        }
                                    endforeach;
                                    ?>
                                  </ol>
                            </div>

                            <div class="col-lg-6 col-sm-12 col-xs-12" >
                                 <ol class="simple_with_animation vertical">
                                    <?php

                                    foreach ($descriptor_especie as $key => $descriptor):
                                        if($key >= $total ){
                                    ?>
                                            <li><?php echo $descriptor->name ?>
                                            <?php echo $this->Form->control('descriptor_id[]', ['type' => 'hidden', 'value' => $descriptor->id]) ?>
                                            </li>

                                    <?php
                                        }
                                    endforeach;
                                    ?>
                                  </ol>
                            </div>

                        </div>

                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success">GRABAR LISTA</button>
                        <?php /*echo $this->Html->link('CANCELAR',
                                ['controller' => 'DescriptorFito', 'action' => 'index', 'id' => $especie->id],
                                ['class' => 'btn btn-default'])*/
                        ?>
                        <?php echo $this->Html->link('REGRESAR',
                                        ['controller' => 'DescriptorFito', 'action' => 'caracterizacion', 'idx'=>$idx , 'idy' => $idy],
                                        ['class' => 'btn btn-default', 'escape'=>false] )
                        ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>



<?php

$this->Html->css('/assets/js/sortable/application.css', ['block' => true]);
$this->Html->script(['/assets/js/sortable/jquery-sortable.js'], ['block' => true]);

?>
