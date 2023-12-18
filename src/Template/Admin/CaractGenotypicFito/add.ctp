
<?php $this->assign('title', $modulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $modulo ?> / <?php echo $titulo ?> - Nuevo</h1>

    <?php
        $this->Html->addCrumb('Recursos Fitogenéticos', '/admin/fitogenetico');
        $this->Html->addCrumb('Caracterización','/admin/fitogenetico/caracterizacion');
        $this->Html->addCrumb('Genotípica', [ 'controller' => 'CaractGenotypicFito', 'action' => 'index']);
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
                <?php echo $this->Form->create($caractGenotypic, [
                    'url'          => ['controller' => 'CaractGenotypicFito', 'action' => 'add'],
                    'autocomplete' => "off",
                    'id'           => "form_caractGenotypic",
                    'enctype'      => 'multipart/form-data'
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
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
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.respname', [
                                            'label' => 'Nombre de Responsable <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class' => 'form-control',
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
                                            'label'   => 'Nombre Enzima de Restricción <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class'   => 'form-control',
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
                                            'class' => 'form-control onlynumbers noPaste',
                                ]); ?>
                            </div>
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('CaractGenotypic.othername', [
                                            'label' => 'Otro Nro. Accesión <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class' => 'form-control onlynumbers noPaste',
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
                                            'class'     => 'form-control onlynumbers noPaste',
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
                                <?php echo $this->Form->control('CaractGenotypic.markerdescrip', [
                                            'label' => 'Descripción de Marcadores <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
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
                                            'label'=> 'Lista de Accesiones',
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
                        </div>

                        <br>

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
                                </div>
                            </div>
                        </div>
                        <!-- FIN AGREGAR PRIMERS -->
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success" id="btnCaractGenotypic">GRABAR</button>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/fitogenetico/caracterizacion/Genotipica', true) ?>"
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
    $this->Html->scriptBlock('$("#file-1, #file-2").fileinput({ showUpload: false, language: "es", allowedFileExtensions: ["csv", "txt"] });', ['block' => 'script']);
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

    var x     = 0;
    var index = 1;
    var temp  = 1;

    $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){

            if(x == 0){ index = 1; }
            x++;

            // console.log(temp);
            // console.log(index);
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

            // var _temp_index = index;
            // var result = parseFloat(index) - parseFloat(temp);
            // if(result > 1){ index = parseFloat(temp) + 1; }

            // temp = index;
        }
    });

    var y = 0;
    var idx = 1;
    $(add_div).click(function(e){
        e.preventDefault();
        if(y < max_fields){
            y++;

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
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent().parent().parent().remove();
        x--; temp--;
    })

    $(wrapper_div).on("click",".remove_div", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent().parent().parent().remove();
        y--;
    })

});

</script>


