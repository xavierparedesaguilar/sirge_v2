<!--Basic Scripts-->
<script src="<?php echo $this->Url->build('/', true) ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo $this->Url->build('/', true) ?>assets/js/slimscroll/jquery.slimscroll.min.js"></script>

<!--Notificación push-->
<?php
use Cake\Core\Configure;
?>
<script src="<?php echo $this->Url->build('/', true) ?>assets/packages/moment/min/moment-with-locales.min.js"></script>
<!--<script src="--><?php #echo $this->Url->build('/', true) ?><!--assets/packages/push.js/push.min.js"></script>-->
<!--<script src="https://js.pusher.com/3.2/pusher.min.js"></script>-->
<script>

</script>

<!--Beyond Scripts-->
<script src="<?php echo $this->Url->build('/', true) ?>assets/js/beyond.min.js"></script>
<script src="<?php echo $this->Url->build('/', true) ?>assets/js/toastr/toastr.js"></script>
<script src="<?php echo $this->Url->build('/', true) ?>assets/js/global.js"></script>
<script src="<?php echo $this->Url->build('/', true) ?>js/scripts.js"></script>
<?php if (isset($scripts) && count($scripts) > 0): ?>
    <?php foreach ($scripts as $script): ?>
        <script src="<?php echo $this->Url->build('/' . $script . '.js', true) ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

<?php echo $this->fetch('script') ?>