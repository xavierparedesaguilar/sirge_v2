
<?php $this->assign('title', $mod_padre); ?>

<section class="content-header">
    <h1><?php echo "Estados del Descriptor ".$mod_parent." - Nuevo" ?></h1>

    <?php
        $this->Html->addCrumb('Recursos Microorganismos', '/admin/microorganismo');
        $this->Html->addCrumb('Caracterización','/admin/microorganismo/caracterizacion');
        $this->Html->addCrumb('Bioquímica', ['controller' => 'BioquimicaMicro', 'action' => 'index']);
        $this->Html->addCrumb('Descriptor', ['controller' => 'DescriptorBioquimica', 'action' => 'index', 'id' => $descriptor->specie_id ]);
        $this->Html->addCrumb($descriptor->name, ['controller' => 'DescriptorStateBioquimica', 'action' => 'index', 'idx' => $descriptor->id, 'idy' => $descriptor->specie_id ]);
        $this->Html->addCrumb('Estado '.$descriptorState->label, ['controller' => 'DescriptorStateBioquimica', 'action' => 'edit', 'idx' => $descriptor->id, 'idy' => $descriptor->specie_id, 'id' => $descriptorState->id ]);
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

<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                </div>
                <?= $this->Form->create($descriptorState, ['id' => 'form_descriptorstate', 'autocomplete' => 'off']) ?>
                <div class="box-body">
                    <div class="col-md-offset-3 col-xs-12 col-md-12 col-lg-6">
                        <?php echo $this->Form->control('descriptor', ['type'=>'hidden', 'value'=>$descriptorState->descriptor_id]) ?>
                        <?php echo $this->Form->control('label_hidden',['type' => 'hidden', 'value' => $descriptorState->label]) ?>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                <?php echo $this->Form->control('label', [
                                        'label' => 'Nombre de Estado',
                                        'class' => 'form-control',
                                ]); ?>
                                <?php echo $this->Form->control('code_hidden',['type' => 'hidden', 'value' => $descriptorState->code]) ?>
                                <?php echo $this->Form->control('code', [
                                        'label' => 'Estado',
                                        'class' => 'form-control onlynumbers',
                                        'maxlength' => "1",
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary" id="btnDescriptorState">GRABAR</button>
                        <?php echo $this->Html->link('CANCELAR',
                                ['controller' => 'DescriptorStateBioquimica', 'action' => 'index', 'idy' => $descriptor->specie_id, 'idx' => $descriptor->id],
                                ['class' => 'btn btn-default'])
                        ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
