<?php ?>
<div class="modal-header"><h4 class="modal-title text-center">Editar <?php echo $titulo ?></h4></div>

<div class="modal-body">
    <?php echo $this->Form->create($lista, [
        'url'         => '/'.$this->request->url,
        'autocomplete'=> 'off',
        'id'          => "form_lista",
        'class' => 'row p-10',
    ]); ?>
    <?php include 'partials/form.ctp' ?>
    <div class="col-sm-12 text-center">
        <button type="submit" class="btn btn-primary" id="btnLista">GRABAR</button>
        <button type="button" class="btn btn-default  btnDeleteModal" data-dismiss="modal">CANCELAR
        </button>
    </div>
    <?php echo $this->Form->end(); ?>
</div>