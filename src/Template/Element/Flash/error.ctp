<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-danger flash-msg" onclick="this.classList.add('hidden');" style="display: block;     z-index: 1; position:absolute; width:100%; top:0px;"><?= $message ?></div>   
