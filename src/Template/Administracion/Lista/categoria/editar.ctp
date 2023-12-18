<?php ?>
<div class="modal-header"><h4 class="modal-title text-center">Editar registro en <strong>"<?php echo $titulo ?>"</strong></h4></div>

<div class="modal-body">
    <?php echo $this->Form->create($categoria, [
        'url' => '/'.$this->request->url,
        'class' => 'row p-10',
        'autocomplete' => 'off',
        'id' => "form_listacategoria",
    ]); ?>
    <?php include 'partials/formcat.ctp' ?>
    <div class="col-sm-12 text-center">
        <button type="submit" class="btn btn-primary", id="btnListaCategoria">GRABAR</button>
        <button type="button" class="btn btn-default btnDeleteModal" data-dismiss="modal">CANCELAR
        </button>
    </div>
    <?php echo $this->Form->end(); ?>
</div>