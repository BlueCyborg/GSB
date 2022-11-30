<?php
    //default type alert
    if (!isset($messageType)) {
        $messageType = 'secondary';
    }
?>

<div class="m-3 alert alert-<?=htmlspecialchars($messageType)?>" role="alert">
    <?=htmlspecialchars($messageBody)?>
</div>