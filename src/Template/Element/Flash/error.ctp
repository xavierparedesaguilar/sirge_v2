<?php if (isset($key) && $key == "auth") {?>
    <script>
        $(function () {
            Notify("<?php echo $message ?>", 'top-right', '5000', 'danger', 'fa-times', true);
        });
    </script>
<?php } else {
    if (!isset($params['escape']) || $params['escape'] !== false) {
        $message = h($message);
    }
    ?>
    <div class="message error" onclick="this.classList.add('hidden');"><?php echo $message ?></div>
<?php } ?>



