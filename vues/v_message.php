<?php
    //default type alert
    if (!isset($messageType)) {
        $messageType = 'secondary';
    }
?>

<div class="m-5 alert alert-<?=htmlspecialchars($messageType)?>" role="alert">
    <?=htmlspecialchars($messageBody)?>
</div>