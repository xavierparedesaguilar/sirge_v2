<?php

    $icons = array( '7'  => array('group' => '1', 'position' => 1), '22' => array('group' => '1', 'position' => 3), '31' => array('group' => '1', 'position' => 2), '1'  => array('group' => '3'),
                    '17' => array('group' => '1', 'position' => 4), '42' => array('group' => '2'), '45' => array('group' => '2'), '46' => array('group' => '2'),
                    '47' => array('group' => '3'));

    $list_id = [];
    foreach ($modulos as $key => $value) {
        if($value->resource_id == 1 && ($value->parent_id == '' || $value->parent_id == NULL)){
            array_push($list_id, 7);
            $value->id = 7;
        }
        else if($value->resource_id == 2 && ($value->parent_id == '' || $value->parent_id == NULL)){
            array_push($list_id, 22);
            $value->id = 22;
        }
        else if($value->resource_id == 3 && ($value->parent_id == '' || $value->parent_id == NULL)){
            array_push($list_id, 31);
            $value->id = 31;
        }
        else
            array_push($list_id, $value->id);
    }

    $total_1 = 0;
    foreach ($icons as $key => $value) {
        if($value['group'] == 1)
            if(in_array($key, $list_id))
                $total_1 ++;
    }

    $total_2 = 0;
    foreach ($icons as $key => $value) {
        if($value['group'] == 2)
            if(in_array($key, $list_id))
                $total_2 ++;
    }

    $total_3 = 0;
    foreach ($icons as $key => $value) {
        if($value['group'] == 3)
            if(in_array($key, $list_id))
                $total_3 ++;
    }
?>

<?php if($total_1 > 0){ ?>
    <div class="col-lg-4 col-md-12 col-xs-12">
        <fieldset>
            <legend>RECURSOS GENÉTICOS</legend>
            <?php foreach ($modulos as $modulo): ?>
                <?php
                    switch ($modulo->resource_id) {
                        case 4:
                            $modulo_title = $modulo->title;
                            break;
                        case 3:
                            $modulo_title = 'Recursos Microorganismos';
                            $modulo->icon = 'icons/microorganismo.png';
                            $modulo->slug = 'microorganismo';
                            break;
                        case 2:
                            $modulo_title = 'Recursos Zoogenéticos';
                            $modulo->icon = 'icons/zoogenetico.png';
                            $modulo->slug = 'zoogenetico';
                            break;
                        case 1:
                            $modulo_title = 'Recursos Fitogenéticos';
                            $modulo->icon = 'icons/fitogenetico.png';
                            $modulo->slug = 'fitogenetico';
                            break;
                    }
                ?>

                <?php if($modulo->id == 7 || $modulo->id == 22 || $modulo->id == 31 || $modulo->id == 17){ ?>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <a href="<?php echo $this->Url->build('/'.$this->request->url . '/' . $modulo->slug, true) ?>" class="small-box-footer">
                            <div class="info-box">
                                <span class="info-box-icon bg-green">
                                    <?php echo $this->Html->image($modulo->icon, ['class' => "img-rounded", 'height' => '75']) ?>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-number" style="text-align: center;"><strong><?php echo $modulo_title ?></strong></span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>

            <?php endforeach ?>
        </fieldset>
    </div>
<?php } ?>

<?php if($total_2 > 0){ ?>
    <div class="col-lg-4 col-md-12 col-xs-12">
        <fieldset>
            <legend>SERVICIOS</legend>
            <?php foreach ($modulos as $key => $modulo): ?>
                <?php $modulo_title = $modulo->title; ?>

                <?php if($modulo->id == 42 || $modulo->id == 45 || $modulo->id == 46){ ?>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <a href="<?php echo $this->Url->build('/'.$this->request->url . '/' . $modulo->slug, true) ?>" class="small-box-footer">
                            <div class="info-box">
                                <span class="info-box-icon bg-green">
                                    <?php echo $this->Html->image($modulo->icon, ['class' => "img-rounded", 'height' => '75']) ?>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-number" style="text-align: center;"><strong><?php echo $modulo_title ?></strong></span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            <?php endforeach ?>
        </fieldset>
    </div>
<?php } ?>

<?php if($total_3 > 0){ ?>
    <div class="col-lg-4 col-md-12 col-xs-12">
        <fieldset>
            <legend>CONFIGURACIÓN</legend>
            <?php foreach ($modulos as $key => $modulo): ?>
                <?php $modulo_title = $modulo->title; ?>

                <?php if($modulo->id == 1 || $modulo->id == 47){ ?>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <a href="<?php echo $this->Url->build('/'.$this->request->url . '/' . $modulo->slug, true) ?>" class="small-box-footer">
                            <div class="info-box">
                                <span class="info-box-icon bg-green">
                                    <?php echo $this->Html->image($modulo->icon, ['class' => "img-rounded", 'height' => '75']) ?>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-number" style="text-align: center;"><strong><?php echo $modulo_title ?></strong></span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            <?php endforeach ?>
        </fieldset>
    </div>
<?php } ?>