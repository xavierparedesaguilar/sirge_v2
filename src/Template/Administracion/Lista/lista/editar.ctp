<div class="modal-header"><h4 class="modal-title text-center">Editar registro a la lista
        <strong>"<?php echo $this->Functions->Mayu($titulo) ?>"</strong></h4></div>

<div class="modal-body">
    <?php echo $this->Form->create($lista, [
        'url'          => '/'.$this->request->url,
        'class'        => 'row p-10',
        'autocomplete' => 'off',
        'id'           => "form_listachild",
    ]); ?>
    <?php include 'partials/formlista.ctp' ?>
    <div class="col-sm-12 text-center">
        <button type="submit" class="btn btn-primary" id="btnListaChild">GRABAR</button>
        <button type="button" class="btn btn-default btnDeleteModal" data-dismiss="modal">CANCELAR
        </button>
    </div>
    <?php echo $this->Form->end(); ?>
</div>