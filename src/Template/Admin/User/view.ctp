
<?php $this->assign('title', $titulo); ?>

<!-- Page Content -->
<section class="content-header">
    <h1>Módulo <?php echo $titulo ?> - <?php echo $user->username ?></h1>

    <?php
        $this->Html->addCrumb('Usuarios', ['controller'=> 'User', 'action' => 'index']);
        $this->Html->addCrumb($user->username, ['controller' => 'User', 'action' => 'view', 'id' => $user->id]);
        $this->Html->addCrumb( 'Ver' );

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
                    <h3 class="box-title"><strong><?= __('DATOS GENERALES') ?></strong></h3>
                    <div class="pull-right box-tools">

                        <?php if($permiso['edit']) { ?>

                        <?php echo $this->Html->link('<i class="fa fa-edit" ></i>', ['controller' => 'User', 'action' => 'edit', $user->id], ['class' => 'btn btn-primary','data-toggle'=> "tooltip",  'title'=> "Editar", 'escape'=>false] ); ?>

                        <?php } ?>

                        <?php if($permiso['delete']) {?>

                        <?php echo $this->Html->link('<i class="fa fa-trash" ></i>', "#",['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$user->id])?>

                        <?php } ?>

                        <?php echo $this->Html->link('<i class="fa fa-arrow-left" ></i>',
                                ['controller' => 'User', 'action' => 'index'],
                                ['class' => 'btn  btn-default', 'data-toggle'=> "tooltip",  'title'=> "Regresar", 'escape'=>false])
                        ?>

                    </div>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="box box-success">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                            <!--DATOS PRINCIPALES-->

                                                <tr>
                                                    <th scope="row"><?php echo __('Rol') ?></th>
                                                    <td><?php echo $user->role->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Usuario') ?></th>
                                                    <td><?php echo h($user->username) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Nombres') ?></th>
                                                    <td><?php echo h($user->names) ?></td>
                                                </tr>
                                             </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                            <!-- DATOS PRINCIPALES -->

                                                <tr>
                                                    <th scope="row"><?php echo __('Apellidos') ?></th>
                                                    <td><?php echo h($user->surnames) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><?php echo __('Email') ?></th>
                                                    <td><?php echo h($user->email) ?></td>
                                                </tr>
                                                <!--FIN DEL MODULO 1-->
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-sm-12 text-center">
                        <?php echo $this->Html->link('EDITAR', ['controller' => 'User', 'action' => 'edit', $user->id], ['class' => 'btn btn-primary'] ); ?>
                        <?php echo $this->Html->link('ELIMINAR', "#",['class' => 'btn btn-danger delete-btn', 'escape' => false, "data-id"=>$user->id])?>
                        <a href = "<?php echo $this->Url->build('/' . $this->Functions->getUrlFirst($this->request->url, 0).'/usuarios', true) ?>"
                           class="btn btn-default"> REGRESAR
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal  -->
<a data-target="#ConfirmDelete" role="button" data-toggle="modal" id="trigger"></a>
<div class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="myModalLabel"><strong>MENSAJE</strong></h4>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el registro actual?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancelar</button>
                <div id="ajax_button"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".delete-btn").click(function(){
        $("#ajax_button").html("<a href='<?php echo $this->Url->build('/admin/usuarios/eliminar/', true) ?>"+ $(this).attr("data-id")+"' class='btn btn-success btn-flat btnEliminar'>Confirmar</a>");
        $("#trigger").click();
    });
</script>
