
<?php

    $icons = array( '7'  => array('group' => '1', 'position' => 1), '22' => array('group' => '1', 'position' => 3), '31' => array('group' => '1', 'position' => 2), '1'  => array('group' => '3'),
                    '17' => array('group' => '1', 'position' => 4), '42' => array('group' => '2'), '45' => array('group' => '2'), '46' => array('group' => '2'),
                    '47' => array('group' => '3'));

    $list_id = [];
    foreach ($modulos as $key => $value) {
        if($value->resource_id == 1 && ($value->parent_id == '' || $value->parent_id == NULL)){
            array_push($list_id, '7');
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
<li class="header"><i class="fa fa-toggle-on" aria-hidden="true"></i>  <b>RECURSOS GENÉTICOS</b></li>
<?php } ?>
<?php foreach ($modulos as $modulo):?>
	<?php
        switch ($modulo->resource_id) {
            case 4:
                $modulo_title = $modulo->title;
                $modulo->icon = $modulo->icon;
                break;
            case 3:
                $modulo_title = 'Recursos Microorganismos';
                $modulo->icon = 'fa fa-bug';
                $modulo->slug = 'microorganismo';
                break;
            case 2:
                $modulo_title = 'Recursos Zoogenéticos';
                $modulo->icon = 'fa fa-twitter';
                $modulo->slug = 'zoogenetico';
                break;
            case 1:
                $modulo_title = 'Recursos Fitogenéticos';
                $modulo->icon = 'fa fa-leaf';
                $modulo->slug = 'fitogenetico';
                break;
        }
    ?>
    <?php if($modulo->id==7 || $modulo->id==22 || $modulo->id==31 || $modulo->id==17){ ?>
    	<li class="treeview">
    	    <a href="<?php echo $this->Url->build('/admin/'.$modulo->slug) ?>">
    	        <i class="fa <?php echo $modulo->icon?>"></i><span> <?php echo $modulo_title?></span>
    	    </a>
    	</li>
    <?php } ?>
<?php endforeach;?>

<?php if($total_2 > 0){ ?>
<li class="header"><i class="fa fa-toggle-on" aria-hidden="true"></i>  <b>SERVICIOS</b></li>
<?php } ?>
<?php foreach ($modulos as $modulo):?>
    <?php $modulo_title = $modulo->title; ?>
    <?php if($modulo->id==46 || $modulo->id==45 || $modulo->id==42){ ?>
        <li class="treeview">
            <a href="<?php echo $this->Url->build('/admin/'.$modulo->slug) ?>">
                <i class="<?php echo $modulo->icon?>"></i><span> <?php echo $modulo_title?></span>
            </a>
        </li>
    <?php } ?>
<?php endforeach;?>

<?php if($total_3 > 0){ ?>
<li class="header"><i class="fa fa-cogs" aria-hidden="true"></i>  <b>CONFIGURACIÓN</b></li>
<?php } ?>
<?php foreach ($modulos as $modulo):?>
    <?php $modulo_title = $modulo->title; ?>
    <?php if($modulo->id==1 || $modulo->id==47){ ?>
        <li class="treeview">
            <a href="<?php echo $this->Url->build('/admin/'.$modulo->slug) ?>">
                <i class="<?php echo $modulo->icon?>"></i><span>  <?php echo $modulo_title?></span>
            </a>
        </li>
    <?php } ?>
<?php endforeach;?>