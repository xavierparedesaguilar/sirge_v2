
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> / <?php echo $titulo ?> - Nuevo</h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Caracterización','/admin/fitogenetico/caracterizacion');
        $this->Html->addCrumb('FisicoQuímica', ['controller' => 'CaractPhysicalChemistry', 'action' => 'index']);
        $this->Html->addCrumb('Crear');

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
                    'url'          => ['controller' => 'CaractPhysicalChemistry', 'action' => 'add'],
                    'autocomplete' => "off",
                    'id'           => "form_fisicoquimica",
                    'enctype'      => 'multipart/form-data'
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
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
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('project', [
                                        'label' => 'Nombre del Proyecto <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control'
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
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
                        <button type="submit" class="btn btn-success" id="btnFisicoQuimica">GRABAR</button>
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

    $this->Html->css(['/assets/js/fileinput/css/fileinput.min.css'], ['block' => 'css']);
    $this->Html->script(['/assets/js/fileinput/js/fileinput.min.js', '/assets/js/fileinput/js/locales/es.js'], ['block' => 'script']);
    $this->Html->scriptBlock('$("#file-1, #file-2, #file-3").fileinput({ showUpload: false, language: "es", allowedFileExtensions: ["csv", "txt"] });', ['block' => 'script']);
    $this->Html->css(['/assets/js/select2/select2.min.css'], ['block' => 'css']);
    $this->Html->script(['/assets/js/select2/select2.js'], ['block' => 'script']);
    $this->Html->scriptBlock('$("#colname").select2();', ['block' => 'script']);
?>
