
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center"><strong>Cambiar contraseña</strong></h4>
    </div>
    <div class="modal-body">
        <?php echo $this->Form->create($user, [
            'url' => ['controller' => 'Clients', 'action' => 'changePass'],
            'class' => 'row p-10',
            'autocomplete' => 'off',
            'id' => "form_change_password"
        ]); ?>
        <p class="text-center">Usuario: <strong><?php echo $user->username ?></strong></p>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="nombre">Nueva Clave (*)</label>
                <input type="password" id="password" name="password" class="form-control" >
            </div>
            <div class="form-group">
                <label for="nombre">Reingrese nueva clave</label>
                <input type="password" id="password_again" name="password_again" class="form-control">
            </div>
        </div>

        <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-primary" id="btnChangeClave">CAMBIAR CLAVE</button>
            <button type="button" class="btn btn-default  btnDeleteModal" data-dismiss="modal">CANCELAR</button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>