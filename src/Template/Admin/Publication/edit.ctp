
<?php $this->assign('title', $mod_modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $mod_modulo ?> - Editar</h1>

    <?php
        $this->Html->addCrumb('Publicación Catálogo Virtual', ['controller' => 'GestionPublicacionCatalogo', 'action' => 'index']);
        $this->Html->addCrumb('Publicaciones', ['controller' => 'Publication', 'action' => 'index']);
        $this->Html->addCrumb($publication->id, ['controller' => 'Publication', 'action' => 'edit', 'id' => $publication->id]);
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
                <?php echo $this->Form->create($publication, [
                    'url' => ['controller' => 'Publication', 'action' => 'edit'],
                    'autocomplete' => "off",
                    'enctype'      => 'multipart/form-data',
                    'id' => "form_publication"
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('title', [
                                        'label' => 'Título <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('author', [
                                        'label' => 'Autor <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('editorial', [
                                        'label' => 'Editorial <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('languages', [
                                        'label' => 'Idioma <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('edition', [
                                        'label' => 'Nro. Edición <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control onlynumbers',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('volume', [
                                        'label' => 'Nro. de Volumen <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control onlynumbers',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('public_place', [
                                        'label' => 'Lugar Publicación <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('country_id', [
                                        'label'   => 'País <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control select2',
                                        'type'    => 'select',
                                        'options' => $paises,
                                        'empty'   => '[ SELECCIONE ]',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('copy', [
                                        'label' => 'Cantidad de Ejemplares <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control onlynumbers',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('numpag', [
                                        'label' => 'Número Páginas <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control onlynumbers',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('collection_id', [
                                        'label'   => 'Colección <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control select2',
                                        'type'    => 'select',
                                        'options' => $colecciones,
                                        'empty'   => '[ SELECCIONE ]',
                                ]); ?>
                            </div>

                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('public_type', [
                                        'label'   => 'Tipo Publicación <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control select2',
                                        'type'    => 'select',
                                        'options' => $tipo_public,
                                        'empty'   => '[ SELECCIONE ]',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('category', [
                                        'label'   => 'Categoría <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control select2',
                                        'type'    => 'select',
                                        'options' => $categoria_public,
                                        'empty'   => '[ SELECCIONE ]',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('institution', [
                                        'label' => 'Institución <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('descriptors', [
                                        'label' => 'Descriptores <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('availability', [
                                        'label'   => 'Disponibilidad <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control',
                                        'type'    => 'select',
                                        'options' => ['1' => 'SI', '2' => 'NO'],
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('note', [
                                        'label' => 'Nota <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('summary', [
                                        'label' => 'Resumen <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control ckeditor',
                                ]); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('file_1', [
                                        'label' => 'Imagen Principal <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control file-input',
                                        'type'  => 'file',
                                ]); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('file_2', [
                                        'label' => 'Documento <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control file-input',
                                        'type'  => 'file',
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <?php echo $this->Form->button('GRABAR',['class'=>'btn btn-primary', 'id'=>'btnEditPublication']) ?>
                        <?php echo $this->Html->link('CANCELAR', ['controller'=>'Publication', 'action' =>'index'],['class'=>'btn btn-default', ]) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<?php

$imagen   = '\/sirge/'.$publication->principal_image;
$imagen_2 = '\/sirge/'.$publication->second_image;
$document = '\/sirge/'.$publication->documents;

//***************** fileinput  *****************//
$this->Html->css(['/assets/js/fileinput/css/fileinput.min.css'], ['block' => 'css']);
$this->Html->script(['/assets/js/fileinput/js/fileinput.min.js', '/assets/js/fileinput/js/locales/es.js'], ['block' => 'script']);
$this->Html->scriptBlock('$("#file-1").fileinput({ initialPreview: ["'.$imagen.'"], initialPreviewAsData: true,
                            initialPreviewConfig: [
                                {caption: "'.$publication->title.'.jpg", showDelete: false}
                            ], overwriteInitial: true, showUpload: false, language: "es", allowedFileExtensions: ["jpg", "png"] });', ['block' => 'script']);

$this->Html->scriptBlock('$("#file-2").fileinput({ initialPreview: ["'.$document.'"], initialPreviewAsData: true,
                            initialPreviewConfig: [
                                {type: "pdf", caption: "'.$publication->title.'.pdf", showDelete: false}
                            ], overwriteInitial: true, showUpload: false, language: "es", maxFileSize: 20480, allowedFileExtensions: ["pdf"] });', ['block' => 'script']);

$this->Html->scriptBlock('$("#file-3").fileinput({ initialPreview: ["'.$imagen_2.'"], initialPreviewAsData: true,
                            initialPreviewConfig: [
                                {caption: "'.$publication->title.'.jpg", showDelete: false}
                            ], overwriteInitial: true, showUpload: false, language: "es", allowedFileExtensions: ["jpg", "png"] });', ['block' => 'script']);


//************************ CK Editors ***********************//
$this->Html->script(['/assets/js/editors/ckeditor/ckeditor.js'], ['block' => 'script']);
$this->Html->scriptBlock('CKEDITOR.replace("summary");', ['block' => 'script']);

//***************************** select 2 *****************************//
$this->Html->css(['/assets/js/select2/select2.min.css'], ['block' => 'css']);
$this->Html->script(['/assets/js/select2/select2.js'], ['block' => 'script']);
$this->Html->scriptBlock('$("#country-id, #collection-id, #public-type, #category").select2();', ['block' => 'script']);

?>
