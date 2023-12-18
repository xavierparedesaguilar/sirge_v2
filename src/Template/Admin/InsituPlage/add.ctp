
<?php $this->assign('title', $mod_title); ?>

<section class="content-header">
    <h1>Módulo <?php echo $mod_modulo.' - '.$mod_title ?> - Nuevo</h1>

    <?php
        $this->Html->addCrumb('Conservación In Situ', ['controller' => 'Insitu', 'action' => 'index']);
        $this->Html->addCrumb($insitu->code_insitu, ['controller' => 'InsituPlage', 'action' => 'index', 'idx' => $insitu->id]);
        $this->Html->addCrumb('Plagas Patógenos', ['controller' => 'InsituPlage', 'action' => 'index', 'idx' => $insitu->id]);
        $this->Html->addCrumb('crear');

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
                <?php echo $this->Form->create($insituPlage, [
                    'url' => ['controller' => 'InsituPlage', 'action' => 'add', 'idx' => $insitu->id],
                    'autocomplete' => "off",
                    'id' => "form_insitu_plage"
                ]); ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                            <?php echo $this->Form->control('scientific_name', [
                                    'label' => 'Nombre Científico <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                    'class' => 'form-control',
                            ]); ?>
                            <?php echo $this->Form->control('common_name', [
                                    'label' => 'Nombre Común <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                    'class' => 'form-control',
                            ]); ?>
                            <?php echo $this->Form->control('reported_damage', [
                                    'label' => 'Daño Reportado <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                    'class' => 'form-control',
                            ]); ?>
                            <?php echo $this->Form->control('severity', [
                                    'label'   => 'Severidad <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                    'class'   => 'form-control',
                                    'type'    => 'select',
                                    'options' => $severidad,
                                    'empty'   => '[ SELECCIONE ]',
                            ]); ?>
                            <?php echo $this->Form->control('culture', [
                                    'label' => 'Cultivo <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                    'class' => 'form-control',
                            ]); ?>

                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <?php echo $this->Form->button('GRABAR',['class'=>'btn btn-success', 'id'=>'btnInsituPlage']) ?>
                        <?php echo $this->Html->link('CANCELAR', ['controller'=>'InsituPlage', 'action' =>'index', 'idx' => $insitu->id],['class'=>'btn btn-default', ]) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
