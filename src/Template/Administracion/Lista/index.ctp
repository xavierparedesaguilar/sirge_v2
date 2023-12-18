<?php
$this->assign('title', $titulo);
?>
<!-- Page Header -->
<section class="content-header">
    <h1><?php echo 'Módulo '.$titulo ?></h1>

    <?php
        $this->Html->addCrumb('Utilitarios', ['controller'=> 'Administracion', 'action' => 'index']);
        $this->Html->addCrumb('Lista');

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
<div class="col-xs-12 col-md-12 col-lg-12" id="mensaje_info">

</div>
<!-- Page Body -->
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Relación de <?php echo $titulo ?></strong></h3>
                    <div class="pull-right box-tools">

                    <?php if($permiso['add']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>',['controller'=>'Lista','action'=>'crear'],['class'=>'btn btn-success','data-tamanio'=>"md", 'data-toggle'=>"modal", 'data-toggle'=>"tooltip",'title'=>"Nueva Lista", 'data-target'=>"#openModal",'escape'=>false]) ?>

                    <?php } ?>



                    <?php if($permiso['export']) { ?>

                             <button type="button" data-toggle="tooltip"  title="Exportar Listado de <?php echo $titulo ?>" id="export" class="btn btn-info waves-effect m-r-5" >
                                     <i class="fa fa-download" ></i>
                            </button>

                    <?php } ?>


                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive" id="resultado_filtro">
                        <table id="tablaListado" class="table table-striped table-bordered table-hover">
                            <thead class="headTablaListado">
                                <tr class="text-uppercase text-center th-head-inputs">
                                    <th>#</th>
                                    <th>NOMBRE</th>
                                    <th>CANTIDAD/VALORES</th>
                                    <th>TIPO RECURSO</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tfoot class="footTablaListado">
                                <tr class="text-uppercase">
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <td></td>

                                </tr>
                            </tfoot>
                            <tbody>
                            <?php $n = 1;
                            foreach ($listas as $lista) : ?>
                                <tr>
                                    <td class="text-center"><?php echo $n++; ?></td>
                                    <td><?php echo strtoupper($this->Functions->letterAccent($lista->name)) ?></td>
                                    <td class="text-center"><?php echo $lista->count ?></td>
                                    <td class="text-center"><?php  echo strtoupper($this->Functions->letterAccent($lista->tiporecurso->name)) ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo $this->Url->build('/' . $this->request->url . '/informacion/' . $lista->id, true) ?>"
                                           class="btn btn-info btn-xs" data-toggle="tooltip" title = "Ver información de la lista."><i class="fa  fa-search-plus"></i>
                                        </a>
                                        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>','/'.$this->request->url . '/editar/' . $lista->id,
                                            ['class'       => 'btn btn-primary btn-xs',
                                             'data-toggle' => 'modal',
                                             'data-target' => "#openModal",
                                             'data-tamanio'=> 'md',
                                             'escape'      => false,
                                             'data-toggle' => "tooltip",
                                             'title'       => "Editar el registro."
                                            ]);
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal de exportar archivo excel  -->
<div class="modal fade" id="exportar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="myModalLabel"><strong>MENSAJE</strong></h4>
            </div>
            <?php echo $this->Form->create(NULL, ['url' => ['action' => 'exportartablalista']]); ?>
            <div class="modal-body">
                <p id="mensaje"></p>
                <?php echo $this->Form->control('filename', ['type' => 'hidden', 'id' => 'filename']) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" id="btnReportesTabla">Aceptar</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    $(function () {
        tablaListadoDataTable();
    });
</script>