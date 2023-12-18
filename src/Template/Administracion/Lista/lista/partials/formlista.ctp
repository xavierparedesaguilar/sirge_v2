<div class="col-sm-12">
    <div class="alert alert-warning d-none">
        <button type="button" class="close close-toogle">×</button>
        <i class="fa-fw fa fa-warning"></i>
        <strong><span class="message_"></span></strong>
    </div>
</div>
<div class="col-sm-12">
    <?php echo $this->Form->control('name', [
            'label'       => ['text' => __('Nombre <b style="color:#dd4b39;">(*)</b>'), 'escape' => false],
            'class'       => 'form-control text-uppercase',
            'placeholder' => 'NOMBRE',
    ]); ?>
    <?php echo $this->Form->control('parent_id', ['type' => 'hidden', 'value' => $id]) ?>
</div>

<div class="col-lg-12 col-sm-12 col-xs-12">
    <?php echo $this->Form->control('resource_id', [
            'type'    => 'select',
            'options' => $recursos,
            'label'   => __('Tipo de Recurso <b style="color:#dd4b39;">(*)</b>'),
            'escape'  => false ,
            'class'   => 'form-control',
            'empty'   => '-- SELECCIONE --'
    ]); ?>
</div>

<?php if(isset($lista)){ ?>
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <?php echo $this->Form->control('status', [
                'type'     => 'select',
                'options'  => ['1' => 'SI', '2' => 'NO'],
                'label'    => ['text' => 'Disponibilidad'],
                'class'    => 'form-control',
                'disabled' => ($total_item > 0)? true : false,
        ]) ?>
    </div>
<?php } ?>