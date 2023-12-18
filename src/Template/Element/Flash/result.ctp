<?php
    if (!isset($params['escape']) || $params['escape'] !== false) {
        $message = h($message);
    }
    if (isset($params['alert'])) {
        switch ($params['alert']) {
            case 'error':
                $type_ = 'danger';
                break;
            case 'success':
                $type_ = 'success';
                break;
            case 'warning':
                $type_ = 'warning';
                break;
        }
    ?>
    <div class="alert alert-<?php echo $type_ ?> fade in">
        <button class="close" data-dismiss="alert">×</button>
        <i class="fa-fw fa fa-check"></i>
        <strong>Mensaje</strong> <?php echo $message ?>
    </div>
<?php } ?>