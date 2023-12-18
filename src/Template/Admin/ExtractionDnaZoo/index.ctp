<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $titulo ?></h1>

    <ol class="breadcrumb">
        <?php
            $count_ = count($this->Functions->generate_nav());
            $i = 1;
            $temp_url = 'admin/';
        ?>
        <?php foreach ($this->Functions->generate_nav() as $key => $value): ?>
            <?php if ($i==1): ?>
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo $this->Url->build('/'.$key, true) ?>">Inicio</a>
                </li>
            <?php else: ?>
                <?php $temp_url = $temp_url.$key.'/'; ?>
                <?php if ($i==($count_)): ?>
                    <li class="active"><?php echo $value ?></li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo $this->Url->build('/'.$temp_url, true) ?>"><?php echo $value ?></a>
                    </li>
                <?php endif ?>
            <?php endif ?>
            <?php $i++; ?>
        <?php endforeach ?>
    </ol>
</section>
<!-- /Page Breadcrumb -->
<!-- Page Header -->

<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Listado de <?php echo $titulo_lista ?></strong></h3>
                    <div class="pull-right box-tools">
                        <?php echo $this->Html->link('Nueva Extraccion de ADN', $this->Url->build('/' . $this->request->url . '/crear', true), ['class' => 'btn btn-success pull-right'] ); ?>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tablaListado" class="table table-striped table-bordered table-hover">
                            <thead class="headTablaListado">
                                <tr class="text-uppercase text-center th-head-inputs">
                  <th style="min-width: 40px;">#</th>
                  <th style="min-width: 150px;">METODO DE EXTRACCIÓN</th>
                  <th style="min-width: 150px;">FECHA DE EXTRACCIÓN</th>
                  <th style="min-width: 170px;">COLECCIÓN</th>
                  <th style="min-width: 165px;">INVESTIGADOR RESPONSIBLE</th>
                  <th style="min-width: 165px;">BUFFER DE DILUCIÓN</th>
                  <th style="min-width: 165px;">VOLUMEN DE RESUSPENSIÓN (ul)</th>
                  <th style="min-width: 165px;">CANTIDAD DE ADN</th>
                  <th style="min-width: 120px;">OPCIONES</th>
            </tr>
        </thead>
        <tfoot class="footTablaListado">
                            <tr class="text-uppercase">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <td></td>
                            </tr>
        </tfoot>
        <tbody>
            <?php $item = 1; ?>
            <?php foreach ($extractionDna as $extractionDna): ?>
            <tr>

                <td><?php echo $this->Number->format($item) ?></td>
                <td><?php echo $extractionDna->extmethod ?></td>
                <td><?php echo ($extractionDna->extdate == NULL || $extractionDna->extdate=='')? '' : date("d-m-Y", strtotime($extractionDna->extdate))  ?></td>
                <td><?php echo $extractionDna->extres?></td>
                <td><?php echo $extractionDna->buffer?></td>
                <td><?php echo $extractionDna->volumen?></td>
                <td><?php echo $extractionDna->dnaqty?></td>


            </tr>
             <?php $item++; ?>
             <?php endforeach; ?>
        </tbody>
        </table>
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
                <h4 class="modal-title" id="myModalLabel">MENSAJE</h4>
            </div>
            <div class="modal-body">
                ¿DESEA ELIMINAR EL REGISTRO ACTUAL?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left " data-dismiss="modal">Cancelar</button>
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
            <?php echo $this->Form->create(NULL, ['url' => ['action' => 'exportartabla']]); ?>
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
    $(".delete-btn").click(function(){
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/'.$this->request->url.'/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat'>Confirmar</a>");
        $("#trigger").click();
    });
</script>