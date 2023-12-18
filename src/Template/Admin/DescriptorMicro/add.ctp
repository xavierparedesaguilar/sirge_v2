
<?php $this->assign('title', $mod_padre); ?>

<!-- Page Content -->
<section class="content-header">
    <h1><?php echo $mod_padre.' - '.$mod_parent ?> - Nuevo</h1>

    <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Caracterización','/admin/microorganismo/caracterizacion');
        $this->Html->addCrumb('Fenotípica', ['controller' => 'FenotipicaMicro', 'action' => 'index']);
        $this->Html->addCrumb('Descriptor', ['controller' => 'DescriptorMicro', 'action' => 'index', 'id' => $especie->id ]);
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

<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                </div>
                <?= $this->Form->create($descriptor, [
                            'id'           => 'form_descriptor',
                            'autocomplete' => 'off',
                ]) ?>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('resource', ['type' => 'hidden', 'value' => 3]) ?>
                                <?php echo $this->Form->control('name', [
                                            'label' => 'Descriptor <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('title', [
                                            'label' => 'Título <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('flg_catalogue', [
                                            'label'   => 'Catálogo <b style="color:#dd4b39;">(*)</b>', 'escape'=> false ,
                                            'class'   => 'form-control',
                                            'type'    => 'select',
                                            'options' => ['1' => 'SI', '2' => 'NO'],
                                            'empty'   => '[ SELECCIONE ]',
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-xs-12">
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
                        <button type="submit" class="btn btn-success" id="btnDescriptor">GRABAR</button>
                        <?php echo $this->Html->link('CANCELAR',
                                ['controller' => 'DescriptorMicro', 'action' => 'index', 'id' => $especie->id],
                                ['class' => 'btn btn-default'])
                        ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>