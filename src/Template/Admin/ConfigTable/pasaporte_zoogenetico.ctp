
<?php $this->assign('title', $titulo); ?>
<!-- Page Breadcrumb -->
<section class="content-header">
    <h1>Validación Pasaporte Zoogenético</h1>

    <?php
        $this->Html->addCrumb('Utilitarios', ['controller'=> 'Administracion', 'action' => 'index']);
        $this->Html->addCrumb('Validación', ['controller'=> 'ConfigTable', 'action' => 'index']);
        $this->Html->addCrumb('Pasaporte Zoogenético');

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

<!-- Page Body -->
<div class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Validación Tabla <?php echo $titulo ?></strong></h3>
                </div>
                <?php echo $this->Form->create(null, [
                    'url' => ['controller' => 'ConfigTableZoogenetico', 'action' => 'index'],
                    'id' => "form_validar_pasaporte"
                ]); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="callout callout-info">
                                <p>Debe seleccionar dos opciones como mínimo del Formulario.</p>
                            </div>
                            <div class="col-sm-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="checkAll">
                                        <span class="text">Seleccionar todos los campos</span>
                                    </label>
                                </div>
                            </div>
                            <?php $exclude = ['id', 'passport_id'/*, 'ubigeo_id'*/, 'collection_name', 'created', 'modified','resource_id', 'accenumb', 'status', 'accimag1', 'accimag2', 'accimag3', 'accimag4', 'remarks1', 'remarks2', 'remarks3', 'remarks4','eea','eeaproc','genus','commonname','colname','husbname','collsrcdet']; ?>
                            <?php foreach ($columns_passport as $key => $column_): ?>
                                <?php if (!in_array($columns_passport[$key], $exclude)): ?>
                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label>
                                                <input <?php echo (in_array($column_, $validar)) ? 'checked="checked"' : ''; ?>
                                                    type="checkbox" name="passport[]" class="colored-success" value="<?php echo $column_ ?>">
                                                <span class="text"><?php echo $lista_final[$column_] ?></span>
                                            </label>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php foreach ($columns as $key => $column): ?>
                                <?php if (!in_array($columns[$key], $exclude)): ?>
                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label>
                                                <input <?php echo (in_array($column, $validar)) ? 'checked="checked"' : ''; ?>
                                                    type="checkbox" name="<?php echo $table_?>[]" class="colored-success" value="<?php echo $column ?>">
                                                <span class="text"><?php echo $lista_final[$column] ?></span>
                                            </label>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success">GRABAR</button>
                        <a href="<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 1).'/validacion', true) ?>"
                           class="btn btn-default">CANCELAR</a>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });
</script>