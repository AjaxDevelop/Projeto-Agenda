<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message error card blue-grey darken-1 white-text" onclick="this.classList.add('hidden'); this.parentNode.style.display = 'none';" style="cursor: pointer;">
    <div class="card-content white-text">
        <?= $message ?>
    </div>
</div>
