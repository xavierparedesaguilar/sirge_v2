
<?php $this->assign('title', $mod_padre); ?>

<section class="content-header">
    <h1>Módulo <?php echo $mod_padre . " - " . $mod_parent ?></h1>

    <?php
        $this->Html->addCrumb('Recursos Zoogenéticos', '/admin/zoogenetico');
        $this->Html->addCrumb('Caracterización','/admin/zoogenetico/caracterizacion');
        $this->Html->addCrumb('Fenotípica');

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

<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
			<div class="box box-success">
				<div class="box-header with-border">
			  		<h3 class="box-title"><strong>Lista de Caracterización</strong></h3>
			  		<div class="box-tools pull-right">

                        <?php if($permiso['import']) { ?>

                            <?php echo $this->Html->link('<i class="fa fa-cloud-upload"></i>', $this->Url->build('/' . $this->request->url . '/importar-caracterizacion', true),
                                                    ['class' => 'btn btn-warning', 'data-toggle' => "tooltip",
                                                    'title' => "Importar Caracterización.", 'escape' => false] );
                            ?>
                        <?php } ?>

                        <?php if($permiso['import']) { ?>

			    		    <?php echo $this->Html->link('<i class="fa fa-cloud-upload"></i>', $this->Url->build('/' . $this->request->url . '/importar', true),
                                                   ['class' => 'btn btn-success', 'data-toggle' => "tooltip",
                                                   'title' => "Importar Descriptores y Estados.", 'escape' => false] );
                            ?>
                        <?php } ?>
			  		</div>
				</div>
                <?php echo $this->Form->create(NULL, [
                            'url' => ['controller' => 'FenotipicaZoo', 'action' => 'index'],
                            'id'  => 'form_fenotipica',
                ]); ?>
				<div class="box-body">
			  		<div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('coleccion_id',[
                                        'type'    => 'select',
                                        'options' => $colecciones,
                                        'label'   => 'Colección <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control select2',
                                        'empty'   => '-- SELECCIONE --',
                                        'id'      => 'feno_coleccion',
                                ]); ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('nombre_comun', [
                                        'type'    => 'select',
                                        'options' => (!empty($especies))? $especies : [],
                                        'default' => (!empty($especie_idx))? $especie_idx->cropname : '',
                                        'label'   => __('Nombre Científico <b style="color:#dd4b39;">(*)</b>'),
                                        'escape'  => false,
                                        'class'   => 'form-control select2',
                                        'empty'   => '-- SELECCIONE --',
                                        'id'      => 'feno_especie',
                                ]); ?>
                            </div>

                            <div class="col-lg-4 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('feno_cropname', [
                                                'label'    => 'Nombre Común',
                                                'class'    => 'form-control text-uppercase',
                                                'disabled' => true,
                                                'id'       => 'feno_cropname',
                                ]) ?>
                            </div>
                        </div>
                   	</div>
				</div>
				<div class="box-footer">
                    <div class="col-sm-12 text-center">

                            <button type="submit" class="btn btn-success" id="btnFenotipica">BUSCAR</button>

                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/zoogenetico/caracterizacion/', true) ?>"
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

$this->Html->css(['/assets/js/select2/select2.min.css'], ['block' => 'css']);
$this->Html->script(['/assets/js/select2/select2.js'], ['block' => 'script']);
$this->Html->scriptBlock('$("select").select2();', ['block' => 'script']);

?>

<script>
            $("#feno_coleccion").val("");
            $("#feno_especie").val("");
            $("#feno_cropname").val("");
</script>