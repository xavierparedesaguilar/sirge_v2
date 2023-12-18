<?php ?>
<div class="modal-header"><h4 class="modal-title text-center">Crear <?php echo $titulo ?></h4></div>

<div class="modal-body">
    <?php echo $this->Form->create(null, [
        'url' => ['controller' => 'Lista', 'action' => 'crear'],
        'class' => 'row p-10',
        'autocomplete' => 'off',
        'id' => "form_lista",
    ]); ?>
    <?php include 'partials/form.ctp' ?>
    <div class="col-sm-12 text-center">
        <button type="submit" class="btn btn-success" id="btnLista">CREAR</button>
        <button type="button" class="btn btn-default  btnDeleteModal" data-dismiss="modal">CANCELAR
        </button>
    </div>
    <?php echo $this->Form->end(); ?>
</div>