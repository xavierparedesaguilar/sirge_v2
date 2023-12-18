<?php
$this->assign('title', $titulo);
//pr($this->request->action);
?>
<section class="content-header">
    <h1>CONTENIDO</h1>

    <ol class="breadcrumb">
        <?php
            $count_ = count($this->Functions->generate_nav());
            $i = 1;
            $temp_url = 'admin/';
        ?>
        <?php foreach ($this->Functions->generate_nav() as $key => $value): ?>
            <?php if ($i==1): ?>
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo $this->Url->build('/'.$key, true) ?>">Inicio</a>
                </li>
            <?php else: ?>
                <?php $temp_url = $temp_url.$key.'/'; ?>
                <?php if ($i==($count_)): ?>
                    <li class="active"><?php echo $value ?></li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo $this->Url->build('/'.$temp_url, true) ?>"><?php echo $value ?></a>
                    </li>
                <?php endif ?>
            <?php endif ?>
            <?php $i++; ?>
        <?php endforeach ?>
    </ol>
</section>
<!-- /Page Breadcrumb -->
<!-- Page Body -->

<div class="content">
    <div class="row">
        <?php echo $this->cell('Menu::portada');?>
    </div>
</div>