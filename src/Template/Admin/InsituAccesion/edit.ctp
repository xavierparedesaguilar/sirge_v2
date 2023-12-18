
<?php $this->assign('title', $mod_title); ?>

<section class="content-header">
    <h1>Módulo <?php echo $mod_modulo.' - '.$mod_title ?> - Editar</h1>

    <?php
        $this->Html->addCrumb('Conservación In Situ', ['controller' => 'Insitu', 'action' => 'index']);
        $this->Html->addCrumb($insitu->code_insitu, ['controller' => 'InsituAccesion', 'action' => 'index', 'idx' => $insitu->id]);
        $this->Html->addCrumb('Accesiones', ['controller' => 'InsituAccesion', 'action' => 'index', 'idx' => $insitu->id]);
        $this->Html->addCrumb($insituAccesion->id, ['controller' => 'InsituAccesion', 'action' => 'edit', 'idx' => $insitu->id, 'id' => $insituAccesion->id]);
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
                <?php echo $this->Form->create($insituAccesion, [
                    'autocomplete' => "off",
                    'id' => "form_insitu_accesion"
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-6">
                                <?php echo $this->Form->control('passport_id', [
                                        'label'   => 'Código PER',
                                        'class'   => 'form-control select2',
                                        'type'    => 'select',
                                        'options' => $passport,
                                        'empty'   => '[ SELECCIONE ]',
                                ]); ?>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-6">
                                <?php echo $this->Form->control('othenumb', [
                                        'label'    => 'Código Accesión',
                                        'class'    => 'form-control',
                                        'disabled' => true,
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-6">
                                <?php echo $this->Form->control('common_name', [
                                        'label'    => 'Nombre Común',
                                        'class'    => 'form-control',
                                        'disabled' => true,
                                ]); ?>
                            </div>

                            <!--   <div class="col-xs-12 col-md-12 col-lg-6">
                                <div class="callout callout-success" style="margin-top: 10px">Parientes Silvestres</div>
                            </div> -->


                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <?php echo $this->Form->control('wild_relatives', [
                                            'label'   => 'Parientes Silvestres',
                                            'type'    => 'select',
                                            'options' => ['1' => 'SI', '2' => 'NO'],
                                            'class'   => 'form-control',
                                            'empty'  => '-- SELECCIONE --',
                                    ]); ?>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-6">
                                <?php echo $this->Form->control('manifold', [
                                        'label' => 'Colector <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-6">
                                <?php echo $this->Form->control('scientific_name', [
                                        'label' => 'Nombre Científico <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-6">
                                <?php echo $this->Form->control('reported_usage', [
                                        'label' => 'Uso Reportado <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-6">
                                <?php echo $this->Form->control('uso', [
                                        'label' => 'Usos <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-6">
                                <?php echo $this->Form->control('extension', [
                                        'label' => 'Extensión <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-6">
                                <?php echo $this->Form->control('local_name', [
                                        'label' => 'Nombre Local (*9',
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-6">
                                <?php echo $this->Form->control('area_cultivation', [
                                        'label' => 'Área Cultivo (m2) <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-6">
                                <?php echo $this->Form->control('habitat', [
                                        'label' => 'Habitat <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-6">
                                <?php echo $this->Form->control('others', [
                                        'label' => 'Otros <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-6">
                                <?php echo $this->Form->control('reference', [
                                        'label' => 'Referencias <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                        'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <?php echo $this->Form->button('GRABAR',['class'=>'btn btn-primary', 'id'=>'btnInsituAccesion']) ?>
                        <?php echo $this->Html->link('CANCELAR', ['controller'=>'InsituAccesion', 'action' =>'index', 'idx' => $insitu->id],['class'=>'btn btn-default', ]) ?>
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
$this->Html->scriptBlock('$("#passport-id").select2();', ['block' => 'script']);

?>

