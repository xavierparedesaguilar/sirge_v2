
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> / <?php echo $titulo ?> - Editar</h1>

    <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Caracterización','/admin/microorganismo/caracterizacion');
        $this->Html->addCrumb('Genotípica', [ 'controller' => 'CaractGenotypicMicro', 'action' => 'index']);
        $this->Html->addCrumb($caractGenotypic->expnumb, [ 'controller' => 'CaractGenotypicMicro', 'action' => 'view', 'id' => $caractGenotypic->id ]);
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
                <?php echo $this->Form->create($caractGenotypic, [
                    'url'          => ['controller' => 'CaractGenotypicMicro', 'action' => 'edit'],
                    'autocomplete' => "off",
                    'id'           => "form_caractGenotypic",
                    'enctype'      => 'multipart/form-data'
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.expnumb',[
                                            'label' => 'N° Experimento',
                                            'class' => 'form-control',
                                            'disabled' => true,
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.colname', [
                                            'label'  => 'Colección <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class'  => 'form-control select2',
                                            'type'   => 'select',
                                            'empty'  => '-- SELECCIONE --',
                                            'options'=> $coleccion,
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.project', [
                                            'label' => 'Nombre del Proyecto <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class' => 'form-control',
                                ]); ?>
                            </div>

                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.molmarker', [
                                            'type'   => 'select',
                                            'label'  => 'Marcador Molecular <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class'  => 'form-control select2',
                                            'options'=> $marcador_molecular,
                                            'empty'  => '-- SELECCIONE --',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.restenzymuse', [
                                            'type'   => 'select',
                                            'label'  => 'Uso Enzima de Restricción <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class'  => 'form-control',
                                            'options'=> $enzima_restriccion,
                                            'empty'  => '-- SELECCIONE --',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.restenzymname', [
                                            'label'=> 'Nombre Enzima de Restricción <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class'=> 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.projcode', [
                                            'label' => 'Código del Proyecto <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.ciclonumb', [
                                            'label' => 'Número de Ciclos <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class'     => 'form-control onlynumbers noPaste',
                                            'maxlength' => "2",
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.accnumb', [
                                            'label' => 'N° Accessión GENEBANK <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.othername', [
                                            'label' => 'Otro Nro. Accesión <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.seqsize', [
                                            'label' => 'Tamaño de Secuencia <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class' => 'form-control',
                                ]); ?>
                            </div>

                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.seqtech', [
                                            'label' => 'Tecnología de Secuenciamiento <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.fragsizemeth', [
                                            'label' => 'Método de Determinación <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.repnumb', [
                                            'label' => 'N° de Repeticiones <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class'     => 'form-control onlynumbers',
                                            'maxlength' => "2",
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.location', [
                                            'label'  => 'Localización <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class'  => 'form-control',
                                            'type'   => 'select',
                                            'options'=> $localizacion,
                                            'empty'  => '-- SELECCIONE --',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.respname', [
                                            'label' => 'Nombre de Responsable <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.markerdescrip', [
                                            'label' => 'Descripción de Marcadores <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.platform', [
                                            'label' => 'Plataforma de Corrida <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.remarks', [
                                            'label' => 'Anotaciones <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('file_1', [
                                            'label'=> 'Lista Accesiones',
                                            'class'=> 'form-control file',
                                            'type' => 'file',
                                ]); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('file_2', [
                                            'label'=> 'Matriz de Datos',
                                            'class'=> 'form-control file',
                                            'type' => 'file',
                                ]); ?>
                            </div>
                        </div><br>

                        <!-- INICIO AGREGAR ADAPTADOR -->
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title"><strong>N° DE ADAPTADORES</strong></h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-success btn-xs add_field_button"><i class="fa fa-plus"></i> AGREGAR ADAPTADOR</button>
                                </div>
                            </div>
                            <div class="box-body input_fields_wrap">
                                <!--  LOS INPUTS SE AGREGAN DINAMICAMENTE  -->
                                <?php
                                    if(!empty($detailAdaptrnum)){

                                        echo $this->Form->control('total_adaptrnum', ['value' => count($detailAdaptrnum), 'type'=>'hidden']);

                                        $item = 1;
                                        foreach ($detailAdaptrnum as $key => $value) {

                                            echo $this->Form->control('DetailAdaptrnum.'.$item.'.item', ['value' => $value->id, 'type'=>'hidden']);

                                            echo '<div class="form-group text">'.
                                                    '<div class="input-group text">'.
                                                        '<label class="control-label" for="adapter_name">Adaptador '.$item.'</label>'.
                                                        '<input type="text" class="form-control" name="DetailAdaptrnum['.$item.'][adapter_name]" id="adapter_name" value="'.$value->adapter_name.'" />'.
                                                        '<span class="input-group-btn">'.
                                                            '<a class="btn btn-danger remove_field" style="margin-top: 25px;" href="#"><i class="fa fa-times"></i> Eliminar</a>'.
                                                        '</span>'.
                                                    '</div>'.
                                                  '</div>';

                                            $item++;
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <!-- FIN AGREGAR ADAPTADOR -->

                         <!-- INICIO AGREGAR PRIMERS -->
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title"><strong>N° DE INICIADORES</strong></h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-success btn-xs add_div_button"><i class="fa fa-plus"></i> AGREGAR INICIADOR</button>
                            </div>
                            </div>
                            <div class="box-body">
                                <div class="div_fields_wrap">
                                    <!--  LOS INPUTS SE VAN AGREGAR DINAMICAMENTE  -->

                                    <?php

                                    if(!empty($detailPrimernum)){

                                        echo $this->Form->control('total_primernum', ['value' => count($detailPrimernum), 'type'=>'hidden' ]);

                                        $item = 1;
                                        foreach ($detailPrimernum as $key => $value) {

                                            echo $this->Form->control('DetailPrimernum.'.$item.'.item', ['value' => $value->id, 'type'=>'hidden']);

                                            echo '<div class="box box-warning">'.
                                                    '<div class="box-header with-border">'.
                                                        '<h3 class="box-title">INICIADOR '.$item.'</h3>'.
                                                        '<div class="box-tools pull-right">'.
                                                            '<button class="btn btn-danger btn-xs remove_div">'.
                                                                '<i class="fa fa-minus"></i></button>'.
                                                        '</div>'.
                                                    '</div>'.
                                                    '<div class="box-body">'.
                                                        '<div class="row">'.
                                                            '<div class="col-lg-3 col-sm-12 col-xs-12">'.
                                                                '<div class="form-group text">'.
                                                                    '<label class="control-label" for="primers_name_one">Par Iniciador '.$item.' - 1</label>'.
                                                                    '<input type="text" class="form-control" name="DetailPrimernum['.$item.'][primers_name_one]" id="primers_name_one" value="'.$value->primers_name_one.'" />'.
                                                                '</div>'.
                                                            '</div>'.
                                                            '<div class="col-lg-3 col-sm-12 col-xs-12">'.
                                                                '<div class="form-group text">'.
                                                                    '<label class="control-label" for="primers_name_two">Par Iniciador '.$item.' - 2</label>'.
                                                                    '<input type="text" class="form-control" name="DetailPrimernum['.$item.'][primers_name_two]" id="primers_name_two" value="'.$value->primers_name_two.'" />'.
                                                                '</div>'.
                                                            '</div>'.
                                                            '<div class="col-lg-3 col-sm-12 col-xs-12">'.
                                                                '<div class="form-group text">'.
                                                                    '<label class="control-label" for="indicator_name">Nombre Iniciador '.$item.'</label>'.
                                                                    '<input type="text" class="form-control" name="DetailPrimernum['.$item.'][indicator_name]" id="indicator_name" value="'.$value->indicator_name.'" />'.
                                                                '</div>'.
                                                            '</div>'.
                                                            '<div class="col-lg-3 col-sm-12 col-xs-12">'.
                                                                '<div class="form-group text">'.
                                                                    '<label class="control-label" for="temperat">Temperatura '.$item.'</label>'.
                                                                    '<input type="text" class="form-control" name="DetailPrimernum['.$item.'][temperat]" id="temperat" value="'.$value->temperat.'" />'.
                                                                '</div>'.
                                                            '</div>'.
                                                        '</div>'.
                                                    '</div>'.
                                                  '</div>';

                                            $item ++;
                                        }
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- FIN AGREGAR PRIMERS -->
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary" id="btnCaractGenotypic">GRABAR</button>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/microorganismo/caracterizacion/Genotipica', true) ?>"
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

    $imagen_1 = '\/sirge/'.$caractGenotypic->accenumb;
    $imagen_2 = '\/sirge/'.$caractGenotypic->datamatrix;

    $title_imagen_1 = explode("/", $imagen_1);
    $title_imagen_2 = explode("/", $imagen_2);

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

    $this->Html->css(['/assets/js/select2/select2.min.css'], ['block' => 'css']);
    $this->Html->script(['/assets/js/select2/select2.js'], ['block' => 'script']);
    $this->Html->scriptBlock('$("#caractgenotypic-colname, #caractgenotypic-molmarker").select2();', ['block' => 'script']);
?>

<script type="text/javascript">

$(document).ready(function() {
    var max_fields      = 10;
    var wrapper         = $(".input_fields_wrap");
    var wrapper_div     = $(".div_fields_wrap");
    var add_button      = $(".add_field_button");
    var add_div         = $(".add_div_button");

    var index = parseFloat($("#total-adaptrnum").val()) + parseFloat(1);
    var x     = index;

    $(add_button).click(function(e){
        e.preventDefault();

        if(x <= max_fields){

            if(x == 0){ index = 1; }
            x++;

            $(wrapper).append('<div class="form-group text">'+
                                '<div class="input-group text">'+
                                    '<label class="control-label" for="adapter_name">Adaptador '+ index +'</label>'+
                                    '<input type="text" class="form-control" name="DetailAdaptrnum['+ index +'][adapter_name]" id="adapter_name" />'+
                                    '<span class="input-group-btn">'+
                                        '<a class="btn btn-danger remove_field" style="margin-top: 25px;" href="#"><i class="fa fa-times"></i> Eliminar</a>'+
                                    '</span>'+
                                '</div>'+
                              '</div>');
            index++;
        }
    });

    var y = parseFloat($("#total-primernum").val())+1;
    var idx = y;

    $(add_div).click(function(e){
        e.preventDefault();

        if(y <= max_fields){

            $(wrapper_div).append('<div class="box box-warning">' +
                                    '<div class="box-header with-border">' +
                                        '<h3 class="box-title">INICIADOR '+ y +'</h3>'+
                                        '<div class="box-tools pull-right">'+
                                            '<button class="btn btn-danger btn-xs remove_div">' +
                                                '<i class="fa fa-minus"></i></button>' +
                                        '</div>'+
                                    '</div>'+
                                    '<div class="box-body">'+
                                        '<div class="row">'+
                                            '<div class="col-lg-3 col-sm-12 col-xs-12">'+
                                                '<div class="form-group text">'+
                                                    '<label class="control-label" for="primers_name_one">Par Iniciador '+ y +' - 1</label>'+
                                                    '<input type="text" class="form-control" name="DetailPrimernum['+ idx +'][primers_name_one]" id="primers_name_one" />'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-lg-3 col-sm-12 col-xs-12">'+
                                                '<div class="form-group text">'+
                                                    '<label class="control-label" for="primers_name_two">Par Iniciador '+ y +' - 2</label>'+
                                                    '<input type="text" class="form-control" name="DetailPrimernum['+ idx +'][primers_name_two]" id="primers_name_two" />'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-lg-3 col-sm-12 col-xs-12">'+
                                                '<div class="form-group text">'+
                                                    '<label class="control-label" for="indicator_name">Nombre Indicador '+ y +'</label>'+
                                                    '<input type="text" class="form-control" name="DetailPrimernum['+ idx +'][indicator_name]" id="indicator_name" />'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-lg-3 col-sm-12 col-xs-12">'+
                                                '<div class="form-group text">'+
                                                    '<label class="control-label" for="temperat">Temperatura '+ y +'</label>'+
                                                    '<input type="text" class="form-control" name="DetailPrimernum['+ idx +'][temperat]" id="temperat" />'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                  '</div>');

            idx ++;
            y++;
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent().parent().parent().remove();
        x--;
    })

    $(wrapper_div).on("click",".remove_div", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent().parent().parent().remove();
        y--;
    })

});

</script>