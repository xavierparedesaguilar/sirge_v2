<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<br>
<div class="alert alert-info alert-dismissible" style="opacity: 1000; overflow: hidden;">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i> MENSAJE!</h4>
        <?= $message?>
</div>

