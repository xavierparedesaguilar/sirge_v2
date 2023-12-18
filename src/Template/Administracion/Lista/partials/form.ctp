
<div class="col-sm-12">
    <div class="alert alert-warning d-none">
        <button type="button" class="close close-toogle">×</button>
        <i class="fa-fw fa fa-warning"></i>
        <strong><span class="message_"></span></strong>
    </div>
</div>
<div class="col-sm-12">
    <!-- <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" class="form-control text-uppercase"
               placeholder="NOMBRE" value="<?php #echo(isset($lista) ? $lista->name : null) ?>">
    </div> -->

    <?php  echo $this->Form->control('name', [
            'label'       => 'Nombre de Valor <b style="color:#dd4b39;">(*)</b>',
            'escape'      => false,
            'class'       => 'form-control text-uppercase',
            'placeholder' => 'Nombre de Valor',
        ])
    ?>
</div>
<!-- <div class="col-lg-12 col-sm-12 col-xs-12">
    <?php /*echo $this->Form->control('resource_id', [
            'type'   => 'select',
            'options'=> $recursos,
            'label'  => __('Tipo de Recurso'),
            'class'  => 'form-control',
            'empty'  => '-- SELECCIONE --' ]);*/
    ?>
</div> -->