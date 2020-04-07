<?php

use Tumic\Lib\FlashMessages;

foreach (FlashMessages::getInstance()->getMessages() as $type => $messages) { ?>
    <?php foreach ($messages as $message) { ?>
        <div class="alert alert-<?php echo $type; ?> alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
<?php } ?>