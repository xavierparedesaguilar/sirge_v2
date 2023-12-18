
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> / <?php echo $titulo ?> - Editar</h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Caracterización','/admin/fitogenetico/caracterizacion');
        $this->Html->addCrumb('FisicoQuímica', ['controller' => 'CaractPhysicalChemistry', 'action' => 'index']);
        $this->Html->addCrumb($caractPhysicalChemistry->expnumb, ['controller' => 'CaractPhysicalChemistry', 'action' => 'edit', 'id' => $caractPhysicalChemistry->id]);
        $this->Html->addCrumb('Editar');

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
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                </div>
                <?php echo $this->Form->create($caractPhysicalChemistry, [
                    'url'          => ['controller' => 'CaractPhysicalChemistry', 'action' => 'edit'],
                    'autocomplete' => "off",
                    'id'           => "form_edit_fisicoquimica",
                    'enctype'      => 'multipart/form-data'
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('expnumb', [
                                        'label'    => 'Nro. Experimento',
                                        'class'    => 'form-control',
                                        'disabled' => true,
                                ]); ?>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('colname', [
                                        'label'   => 'Colección <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control select2',
                                        'type'    => 'select',
                                        'options' => $coleccion,
                                        'empty'   => ['0' => '-- SELECCIONE --']
                                ]); ?>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('respname', [
                                        'label' => 'Nombre del Responsable <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control'
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('project', [
                                        'label' => 'Nombre del Proyecto <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control'
                                ]); ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('projcode', [
                                        'label' => 'Código del Proyecto <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control'
                                ]); ?>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('remarks', [
                                        'label' => 'Anotaciones <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control'
                                ]); ?>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('file_1', [ #traitlist
                                        'label' => 'Lista de Variables Evaluadas <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control file file-input',
                                        'type' => 'file',
                                ]); ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('file_2', [ #samplelist
                                        'label' => 'Lista de Accesiones <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control file file-input',
                                        'type' => 'file',
                                ]); ?>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('file_3', [ #datamatrix
                                        'label' => 'Matriz de Datos <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control file file-input',
                                        'type' => 'file',
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary" id="btnEditFisicoQuimica">GRABAR</button>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/caracterizacion/Fisicoquimica', true) ?>"
                           class="btn btn-default"> CANCELAR
                        </a>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<?php

    $imagen_1 = '\/sirge/'.$caractPhysicalChemistry->traitlist;
    $imagen_2 = '\/sirge/'.$caractPhysicalChemistry->samplelist;
    $imagen_3 = '\/sirge/'.$caractPhysicalChemistry->datamatrix;

    $title_imagen_1 = explode("/", $imagen_1);
    $title_imagen_2 = explode("/", $imagen_2);
    $title_imagen_3 = explode("/", $imagen_3);

    $this->Html->css(['/assets/js/fileinput/css/fileinput.min.css'], ['block' => 'css']);
    $this->Html->script(['/assets/js/fileinput/js/fileinput.min.js', '/assets/js/fileinput/js/locales/es.js'], ['block' => 'script']);

    if(count($title_imagen_1) > 3){

        $this->Html->scriptBlock('$("#file-1").fileinput({ initialPreview: ["'.$imagen_1.'"], initialPreviewAsData: true,
                                    initialPreviewConfig: [
                                        { caption: "'.$title_imagen_1[(count($title_imagen_1)-1)].'", showDelete: false, showZoom: false}
                                    ], overwriteInitial: true, showUpload: false, language: "es", allowedFileExtensions: ["csv", "txt"] });', ['block' => 'script']);
    } else {

        $this->Html->scriptBlock('$("#file-1").fileinput({ showUpload: false, language: "es", allowedFileExtensions: ["csv", "txt"] });', ['block' => 'script']);
    }

    if(count($title_imagen_2) > 3){

        $this->Html->scriptBlock('$("#file-2").fileinput({ initialPreview: ["'.$imagen_2.'"], initialPreviewAsData: true,
                                    initialPreviewConfig: [
                                        { caption: "'.$title_imagen_2[(count($title_imagen_2)-1)].'", showDelete: false, showZoom: false}
                                    ], overwriteInitial: true,showUpload: false, language: "es", allowedFileExtensions: ["csv", "txt"] });', ['block' => 'script']);

    } else {

        $this->Html->scriptBlock('$("#file-2").fileinput({ showUpload: false, language: "es", allowedFileExtensions: ["csv", "txt"] });', ['block' => 'script']);
    }

    if(count($title_imagen_3) > 3){

        $this->Html->scriptBlock('$("#file-3").fileinput({ initialPreview: ["'.$imagen_3.'"], initialPreviewAsData: true,
                                    initialPreviewConfig: [
                                        { caption: "'.$title_imagen_3[(count($title_imagen_3)-1)].'", showDelete: false, showZoom: false}
                                    ], overwriteInitial: true,showUpload: false, language: "es", allowedFileExtensions: ["csv", "txt"] });', ['block' => 'script']);

    } else {

        $this->Html->scriptBlock('$("#file-3").fileinput({ showUpload: false, language: "es", allowedFileExtensions: ["csv", "txt"] });', ['block' => 'script']);
    }

    $this->Html->css(['/assets/js/select2/select2.min.css'], ['block' => 'css']);
    $this->Html->script(['/assets/js/select2/select2.js'], ['block' => 'script']);
    $this->Html->scriptBlock('$("#colname").select2();', ['block' => 'script']);
?>
