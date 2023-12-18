
<?php $this->assign('title', $mod_title); ?>

<section class="content-header">
    <h1>Módulo <?php echo $mod_modulo.' - '.$mod_title ?> - Editar</h1>

    <?php
        $this->Html->addCrumb('Conservación In Situ', ['controller' => 'Insitu', 'action' => 'index']);
        $this->Html->addCrumb($insitu->code_insitu, ['controller' => 'InsituFarmerActivity', 'action' => 'index', 'idx' => $insitu->id]);
        $this->Html->addCrumb('Prácticas Agrícolas', ['controller' => 'InsituFarmerActivity', 'action' => 'index', 'idx' => $insitu->id]);
        $this->Html->addCrumb($insituFarmerActivity->id, ['controller' => 'InsituFarmerActivity', 'action' => 'edit', 'idx' => $insitu->id, 'id' => $insituFarmerActivity->id]);
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


<!-- Page Body -->
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                </div>
                <?php echo $this->Form->create($insituFarmerActivity, [
                    'autocomplete' => "off",
                    'id' => "form_insitu_farmer_activity"
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <?php echo $this->Form->control('technical_category', [
                                        'label' => 'Técnica / Categoría <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                        'type'    => 'select',
                                        'options' => $tecnica_categoria,
                                        'empty'   => '[ SELECCIONE ]',
                                ]); ?>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <?php echo $this->Form->control('practice_know', [
                                        'label'   => 'Práctica / Saber <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control',
                                        'type'    => 'select',
                                        'options' => $practica_saber,
                                        'empty'   => '[ SELECCIONE ]',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <?php echo $this->Form->control('purpose', [
                                        'label' => 'Finalidad <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <?php echo $this->Form->control('origin', [
                                        'label'   => 'Origen <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control',
                                        'type'    => 'select',
                                        'options' => $origen,
                                        'empty'   => '[ SELECCIONE ]',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <?php echo $this->Form->control('input_tools', [
                                        'label'   => 'Insumo / Herramienta <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class'   => 'form-control',
                                        'type'    => 'select',
                                        'options' => $insumo_tools,
                                        'empty'   => '[ SELECCIONE ]',
                                ]); ?>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <?php echo $this->Form->control('common_name', [
                                        'label' => 'Nombre Común <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <?php echo $this->Form->control('comunities', [
                                        'label' => 'Comunidades <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <?php echo $this->Form->control('description', [
                                        'label' => 'Descripción <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <?php echo $this->Form->button('GRABAR',['class'=>'btn btn-primary', 'id'=>'btnInsituFarmerActivity']) ?>
                        <?php echo $this->Html->link('CANCELAR', ['controller'=>'InsituFarmerActivity', 'action' =>'index', 'idx' => $insitu->id],['class'=>'btn btn-default', ]) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
