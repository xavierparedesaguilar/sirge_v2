
<?php $this->assign('title', $titulo); ?>

<section class="content-header">
    <h1><?php echo $mod_child ?></h1>

    <?php
        $this->Html->addCrumb('Utilitarios', ['controller'=> 'Administracion', 'action' => 'index']);
        $this->Html->addCrumb('Lista', ['controller'=> 'Lista', 'action' => 'index']);
        $this->Html->addCrumb( ucwords(mb_strtolower($lista->name,'UTF-8')) );
        $this->Html->addCrumb( ucwords(mb_strtolower($titulo,'UTF-8')) );

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
                    <h3 class="box-title">Registros de la categoría <strong><?php echo  ucwords($this->Functions->Minu($lista->name)) . " - " . ucwords($this->Functions->Minu($titulo)) ?></strong></h3>
                    <div class="pull-right box-tools">


                        <?php if($permiso['add']) { ?>

                            <a data-tamanio="md" class="btn btn-success" href="<?php echo $this->Url->build('/' . $this->request->url . '/crear', true) ?>" data-toggle="tooltip" title="Nuevo Registro" data-target="#openModal"><i class="fa fa-plus"></i></a>

                        <?php } ?>

                        <?php if($permiso['export']) { ?>

                             <button type="button" data-toggle="tooltip"  title="Exportar Listado de <?php echo ucwords($this->Functions->Minu($titulo)) ?>" id="export" class="btn btn-info waves-effect m-r-5" >
                                     <i class="fa fa-download" ></i>
                            </button>

                        <?php } ?>


                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive" id="resultado_filtro">
                        <table id="tablaListado" class="table table-striped table-bordered table-hover ">
                            <thead class="headTablaListado">
                            <tr class="text-uppercase text-center th-head-inputs">
                                <th scope="col">#</th>
                                <th style="min-width: 100px;">NOMBRE</th>
                                <th style="min-width: 100px;">TIPO RECURSO</th>
                                <th style="min-width: 100px;">DISPONIBILIDAD</th>
                                <th style="min-width: 100px;">OPCIONES</th>
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
                            foreach ($categorias as $categoria) : ?>
                                <tr>
                                    <td class="text-center"><?php echo $n++; ?></td>
                                    <td><?php echo strtoupper($this->Functions->letterAccent($categoria->name)) ?></td>
                                    <td class="text-center"><?php echo strtoupper($this->Functions->letterAccent($lista->tiporecurso->name)) ?></td>
                                    <td class="text-center"><?php echo ($categoria->status == 1)? 'SI' : 'NO' ?></td>
                                    <td class="text-center">
                                        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>', '/'.$this->request->url . '/editar/' . $categoria->id, [
                                                'class'        => 'btn btn-primary btn-xs',
                                                'data-toggle'  => 'modal',
                                                'data-target'  => "#openModal",
                                                'data-tamanio' => 'md',
                                                'escape'       => false,
                                                'data-toggle'  => "tooltip",
                                                'title'        => "Editar el registro.",
                                        ]); ?>
                                        <?php echo $this->Html->link('<i class="fa fa-trash-o"></i>', "#", [
                                                'class'       => 'btn btn-danger btn-xs delete-btn',
                                                'escape'      => false,
                                                "data-name"   => $categoria->name,
                                                "data-id"     => $categoria->id,
                                                'data-toggle' => "tooltip",
                                                'title'       => "Eliminar Lista de Información.",
                                        ]); ?>
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

<!-- Modal  Eliminar -->
<a data-target="#ConfirmDelete" role="button" data-toggle="modal" id="trigger"></a>
<div class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="myModalLabel"><strong>MENSAJE</strong></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancelar</button>
                <div id="ajax_button"></div>
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
            <?php echo $this->Form->create(NULL, ['url' => '/'.$this->request->url.'/exportar' ]); ?>
            <div class="modal-body">
                <p id="mensaje"></p>
                <?php echo $this->Form->control('filename', ['type' => 'hidden', 'id' => 'filename']) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" id="btnReportesTabla">Aceptar</button>
            </div>
            <?php echo $this->Form->end() ?>
        </div>
    </div>
</div>


<script>
    $(function () {
        tablaListadoDataTable();
    });

    $(".delete-btn").click(function(){
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/'.$this->request->url.'/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();

        $(".modal-body").html('¿Desea eliminar el registro actual?');
    });

</script>